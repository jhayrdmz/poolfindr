<?php

namespace App\Models;

use App\Models\Traits\HasAvatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;

class Host extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasAvatar;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the full name
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return implode(' ', [
                    $attributes['first_name'],
                    $attributes['last_name']
                ]);
            }
        );
    }
}
