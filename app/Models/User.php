<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'birthdate',
        'profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function resetPassword()
    {
        return $this->hasOne(ResetPassword::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function liked()
    {
        return $this->belongsToMany(Post::class, 'post_likes_pivot', 'user_id', 'post_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers_pivot', 'follower_id', 'following_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers_pivot', 'following_id', 'follower_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

}
