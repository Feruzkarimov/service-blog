<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'password'
    ];
    
    public function setPasswordAttribute($password)
    {
        $this->password = Hash::make($password);
    }

    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function post () 
    {
        return $this->hasMany(Post::class);
    }

    public function comment () 
    {
        return $this->hasMany(Comment::class);
    }
}
