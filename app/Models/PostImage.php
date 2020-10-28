<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable = ["post_id", "file"];

    public function getFileAttribute($value)
    {
        return !empty($value) ? asset($value) : null;
    }
}
