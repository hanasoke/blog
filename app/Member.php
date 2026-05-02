<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    public function blogs()
    {
        return $this->hasMany('App\Blog', 'genre_id');
    }
}