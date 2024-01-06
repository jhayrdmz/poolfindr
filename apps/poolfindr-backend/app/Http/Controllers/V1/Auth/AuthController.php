<?php

namespace App\Http\Controllers\V1\Auth;

use App\Enums\ErrorCodes;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login']]);
        $this->middleware('throttle:60,1', ['except' => ['me']]);
    }

    /**
     * Authenticate user using email and password
     * 
     * @param \App\Http\Requests\Auth\LoginRequest
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return $this->respondWithError(ErrorCodes::AUTH_USER_NOT_FOUND, 401);
        }

        if (Hash::check($request->input('password'), $user->password)) {
            RateLimiter::clear('login-attempt:' . $user->id);

            $token = $user->createToken($request->header('user-agent'), ['*']);

            return response()->json(['data' => [
                'access_token' => $token->plainTextToken,
                'expires_at' => $token->accessToken->expires_at,
                'token_type' => 'bearer',
                'user' => new UserResource($user->load('accessLevel', 'avatar'))
            ]], 200)->header('Authorization', $token->plainTextToken);
        }

        $executed = RateLimiter::attempt('login-attempt:' . $user->id, 10, function () {
            return;
        }, 3600);

        if (!$executed) {
            // DISABLE USER HERE...

            return $this->respondWithError(ErrorCodes::AUTH_FAILED_LOGIN_ATTEMPTS, 401);
        }

        return $this->respondWithError(ErrorCodes::AUTH_INVALID_CREDENTIALS, 401, null, [
            'attempts' => RateLimiter::attempts('login-attempt:' . $user->id)
        ]);
    }

    /**
     * Get the authenticated user details
     * 
     * @return \App\Http\Resources\UserResource
     */
    public function me(): UserResource
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        return new UserResource($user->load('accessLevel', 'avatar'));
    }

    /**
     * Logout authenticated user and revoke token
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successfully.']);
    }
}
