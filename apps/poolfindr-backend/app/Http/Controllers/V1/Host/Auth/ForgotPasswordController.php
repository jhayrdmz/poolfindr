<?php

namespace App\Http\Controllers\V1\Host\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Send password reset email to user
     */
    public function forgotPassword(Request $request)
    {
        $status = Password::broker('hosts')->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_THROTTLED) {
            return $this->respondWithError(
                'RESET_THROTTLED',
                422,
                'Max request reached, please try again later.'
            );
        }

        return $status === Password::RESET_LINK_SENT
            ? $this->respondWithMessage('Successfully sent reset link.')
            : $this->respondWithError('UNKNOWN_ERROR', 422, 'Something went wrong.');
    }
}
