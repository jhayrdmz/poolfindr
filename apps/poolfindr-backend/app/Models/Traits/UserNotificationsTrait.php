<?php

namespace App\Models\Traits;

// use App\Notifications\EmailVerificationNotification;
// use App\Notifications\ResetPasswordNotification;

trait UserNotificationsTrait
{
    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token): void
    {
        // $this->notify(new ResetPasswordNotification($this->buildResetPasswordLink($token)));
    }

    /**
     * Send an email verification notification to the user.
     * 
     * @param string $token
     */
    public function sendEmailVerifyNotification($token): void
    {
        // $this->notify(new EmailVerificationNotification($this->buildResetPasswordLink($token)));
    }

    private function buildResetPasswordLink($token)
    {
        $params = http_build_query(['token' => $token, 'email' => $this->email]);

        return rtrim(config('app.url'), '/') . '/password-reset?' . $params;
    }
}
