<?php

namespace App\Http\Controllers\V1\Host\Auth;

use App\Models\Host;
use App\Http\Resources\Host\HostResource;
use App\Http\Requests\Host\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $host = Host::create($request->validated());

        // todo: send email verification

        $token = $host->createToken($request->header('user-agent'), ['*']);

        return response()->json(['data' => [
            'access_token' => $token->plainTextToken,
            'expires_at' => $token->accessToken->expires_at,
            'token_type' => 'bearer',
            'user' => new HostResource($host)
        ]], 200)->header('Authorization', $token->plainTextToken);
    }
}
