<?php

namespace App\Http\Controllers\V1\Host\Auth;

use App\Enums\ErrorCodes;
use App\Models\Host;
use App\Http\Controllers\Controller;
use App\Http\Requests\Host\Auth\LoginRequest;
use App\Http\Resources\Host\HostResource;
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
        // $this->middleware('auth:host', ['except' => ['login']]);
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
        $host = Host::where('email', $request->input('email'))->first();

        if (!$host) {
            return $this->respondWithError(ErrorCodes::AUTH_USER_NOT_FOUND, 401);
        }

        if (Hash::check($request->input('password'), $host->password)) {
            RateLimiter::clear('login-attempt:' . $host->id);

            $token = $host->createToken($request->header('user-agent'), ['*']);

            return response()->json(['data' => [
                'access_token' => $token->plainTextToken,
                'expires_at' => $token->accessToken->expires_at,
                'token_type' => 'bearer',
                'user' => new HostResource($host)
            ]], 200)->header('Authorization', $token->plainTextToken);
        }

        $executed = RateLimiter::attempt('login-attempt:' . $host->id, 10, function () {
            return;
        }, 3600);

        if (!$executed) {
            // DISABLE USER HERE...

            return $this->respondWithError(ErrorCodes::AUTH_FAILED_LOGIN_ATTEMPTS, 401);
        }

        return $this->respondWithError(ErrorCodes::AUTH_INVALID_CREDENTIALS, 401, null, [
            'attempts' => RateLimiter::attempts('login-attempt:' . $host->id)
        ]);
    }

    /**
     * Get the authenticated user details
     * 
     * @return \App\Http\Resources\Host\HostResource
     */
    public function me(): HostResource
    {
        /** @var \App\Models\Host */
        $host = auth('host')->user();

        return new HostResource($host);
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
        $request->user('host')->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successfully.']);
    }
}
