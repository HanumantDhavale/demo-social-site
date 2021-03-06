<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];

    protected $appends = ['like_by_me', 'profile_url'];

    public function getCreatedAtAttribute($val)
    {
        return !empty($val) ? Carbon::create($val)->format('D jS, M Y, h:iA') : null;
    }

    public function getLikeByMeAttribute()
    {
        if (!auth()->check())
            return false;
        $liked_by_me = $this->likes()->where('user_id', auth()->user()->id)->first();
        return !empty($liked_by_me) ? true : false;
    }

    public function getProfileUrlAttribute()
    {
        if (!auth()->check()) {
            $profile_url = route('user.profile', $this->owner->id);;
        } else {
            if ($this->owner->id === auth()->user()->id) {
                $profile_url = route('account.profile');
            } else {
                $profile_url = route('user.profile', $this->owner->id);;
            }
        }
        return $profile_url;
    }

    public function scopeUserIs($query, $user_id)
    {
        if (!empty($user_id)) {
            $query->where(['user_id' => $user_id]);
        }
        return $query;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes_pivot', 'post_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

}
