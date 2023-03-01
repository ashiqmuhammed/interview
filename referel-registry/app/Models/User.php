<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'referel_id'
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
    ];

    public static function createReferalIds($user)
    {
        try {
            if(is_null($user->referel_id)) {
                $user->referel_id = strtoupper(Str::random(4, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')).'-'.mt_rand(1000, 9999);
            }
            return $user->save();
        } catch (\Exception $th) {
            return User::createReferalIds($user);
        }
    }
    public function getReferalPointsAttribute()
    {
        $user_id = $this->id;
        $counts = User::whereHas('refered_users', function($query) use($user_id) {
            $query->where('refered_user_id', $user_id);
        })->count();
        if($counts == 0) {
            return 10;
        } elseif($counts == 1) {
            return 9;
        } elseif($counts == 2) {
            return 8;
        } elseif($counts == 3) {
            return 7;
        } elseif($counts == 4) {
            return 6;
        } elseif($counts == 5) {
            return 5;
        } elseif($counts == 6) {
            return 4;
        } elseif($counts == 7) {
            return 3;
        } elseif($counts == 8) {
            return 2;
        } elseif($counts == 9) {
            return 1;
        } else {
            return 0;
        }
    }

    public function user()
    {
        return $this->hasOne(UserReferals::class, 'user_id');
    }

    /**
     * Get all of the users for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refered_users()
    {
        return $this->hasMany(UserReferals::class, 'refered_user_id');
    }
}
