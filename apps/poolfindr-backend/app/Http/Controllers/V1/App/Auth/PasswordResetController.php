<?php

namespace App\Http\Controllers\V1\App\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Auth\PasswordResetRequest;
use App\Http\Requests\App\Auth\VerifyTokenRequest;
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
     * @param \App\Models\User $user
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestPasswordReset(User $user): JsonResponse
    {
        $status = Password::sendResetLink(['email' => $user->email]);

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
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

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
        $user = Password::getUser(['email' => $request->email]);

        if (is_null($user) || !Password::tokenExists($user, $request->token)) {
            return $this->respondWithError(422, 422, 'Invalid credentials.');
        }

        return $this->respondWithMessage('Valid credentials.');
    }
}
