<?php

namespace App\Http\Controllers\V1\App\Auth;

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
        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? $this->respondWithMessage('Successfully sent reset link.')
            : $this->respondWithError('UNKNOWN_ERROR', 422, 'Something went wrong.');
    }
}
