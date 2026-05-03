<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    public function accessBlog()
    {
        return $this->hasMany('App\AccessBlog', 'member_id');
    }
}