<?php

namespace App\Models;

use App\Notifications\MainResetPassword;
use App\Notifications\MainVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'lastname',
        'name',
        'patronymic',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lectures(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Lecture::class);
    }

    public function createDir($userId): void
    {
        Storage::deleteDirectory("avatars/{$userId}");
        Storage::makeDirectory("avatars/{$userId}");
    }

    public function saveAvatar($avatar, $name, $userId): void
    {
        $path = '/'.storage_path('app/public/avatars/').$userId.'/'.$name.'.webp';
        $image = Image::make($avatar);
        $height = $image->height();
        $width = $image->width();

        if ($width > $height) {
            $image->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $x = (int) ($image->width() / 2) - 100;
            $image->crop(200, 200, $x, 0);
        } else {
            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $y = (int) ($image->height() / 2) - 100;
            $image->crop(200, 200, 0, $y);
        }

        $image->save($path, 75, 'webp');
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new MainVerifyEmail);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MainResetPassword($token));
    }
}
