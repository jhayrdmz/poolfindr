<?php

namespace App\Models\Traits;

// use App\Notifications\EmailVerificationNotification;
use App\Notifications\ResetPasswordNotification;

trait UserNotificationsTrait
{
    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $params = http_build_query(['token' => $token, 'email' => $this->email]);

        $url = rtrim(config('app.url'), '/') . '/password-reset?' . $params;

        $this->notify(new ResetPasswordNotification($url, config('auth.passwords.users.expire')));
    }
}
