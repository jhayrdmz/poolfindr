<?php

namespace App\Http\Controllers\V1\Host\Auth;

use App\Models\Host;
use App\Http\Controllers\Controller;
use App\Http\Requests\Host\Auth\PasswordResetRequest;
use App\Http\Requests\Host\Auth\VerifyTokenRequest;
// use Illuminate\Auth\Events\PasswordReset as PasswordResetEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Request for password reset link
     * 
     * @param \App\Models\Host $host
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestPasswordReset(Host $host): JsonResponse
    {
        $status = Password::sendResetLink(['email' => $host->email]);

        return $status === Password::RESET_LINK_SENT
            ? $this->respondWithMessage('Password reset link sent successfully!')
            : $this->respondWithError($status, 422, 'Error in password reset. Please try again.');
    }

    /**
     * Handle password reset request form
     * 
     * @param \App\Http\Requests\Auth\PasswordResetRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordReset(PasswordResetRequest $request): JsonResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Host $host, string $password) {
                $host->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $host->save();

                // event(new PasswordResetEvent($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? $this->respondWithMessage('Password has been successfully reset.')
            : $this->respondWithError($status, 422, __($status));
    }

    /**
     * Verify token with provided email
     * 
     * @param \App\Http\Requests\Auth\VerifyTokenRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyToken(VerifyTokenRequest $request): JsonResponse
    {
        $host = Password::getUser(['email' => $request->email]);

        if (is_null($host) || !Password::tokenExists($host, $request->token)) {
            return $this->respondWithError(422, 422, 'Invalid credentials.');
        }

        return $this->respondWithMessage('Valid credentials.');
    }
}
