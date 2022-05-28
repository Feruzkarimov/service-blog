<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =[
        'id', 
        'name',
        'user_id',
        'body',
        'cover'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function comment () {
        return $this->hasMany(Comment::class);
    }

    public function Image () {
        return $this->hasMany(Image::class);
    }
}
