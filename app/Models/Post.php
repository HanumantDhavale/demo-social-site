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

    protected $appends = ['like_by_me'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function getCreatedAtAttribute($val)
    {
        return !empty($val) ? Carbon::create($val)->format('D jS, M Y, h:iA') : null;
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes_pivot', 'post_id', 'user_id');
    }

    public function getLikeByMeAttribute()
    {
        if (!auth()->check())
            return false;
        $liked_by_me = $this->likes()->where('user_id', auth()->user()->id)->first();
        return !empty($liked_by_me) ? true : false;
    }

}
