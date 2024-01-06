<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class ErrorCodes extends Enum implements LocalizedEnum
{
    /**
     * Error code for generic or unknown error
     */
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';

    /**
     * Error code for login user not found
     */
    const AUTH_USER_NOT_FOUND = 'auth.login.user_not_found';

    /**
     * Error code for invalid account credentials
     */
    const AUTH_INVALID_CREDENTIALS = 'auth.login.invalid_credentials';

    /**
     * Error code for blocked user
     */
    const AUTH_USER_BLOCKED = 'auth.login.blocked';

    /**
     * Error code for user with too many login attempts
     */
    const AUTH_FAILED_LOGIN_ATTEMPTS = 'auth.login.failed_login_attempts';

    /**
     * Error code for resend email but user has already verified email
     */
    const AUTH_USER_ALREADY_VERIFIED = 'auth.login.user_already_verified';
}
