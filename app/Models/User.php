<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
    
    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Hash::make($value)
        );
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
