<?php

namespace App\Http\Controllers\V1\App\Auth;

use App\Models\User;
use App\Http\Resources\App\UserResource;
use App\Http\Requests\App\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        // todo: send email verification

        $token = $user->createToken($request->header('user-agent'), ['*']);

        return response()->json(['data' => [
            'access_token' => $token->plainTextToken,
            'expires_at' => $token->accessToken->expires_at,
            'token_type' => 'bearer',
            'user' => new UserResource($user)
        ]], 200)->header('Authorization', $token->plainTextToken);
    }
}
