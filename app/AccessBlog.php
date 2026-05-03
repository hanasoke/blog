<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessBlog extends Model 
{
    protected $table = 'access_blogs';

    protected $fillable = [
        'blog_id',
        'member_id',
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function blog()
    {
        return $this->belongsTo('App\Blog', 'blog_id');
    }
}
