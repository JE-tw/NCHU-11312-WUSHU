<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // 用 hasOne 關聯來表示用戶有一個可能存在的資料
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name; // 直接返回 users 表格中的 name
    }
    protected static function booted()
    {
        static::updated(function ($user) {
            // 當用戶資料更新時，同步更新 user_infos 表格中的 name
            if ($user->userInfo) {
                $user->userInfo->update(['name' => $user->name]);
            }
        });
    }
}
