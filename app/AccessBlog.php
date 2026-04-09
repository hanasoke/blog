<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model 
{
    protected $table = 'access_blogs';

    protected $fillable = [
        'blog_id',
        'access',
    ];

    public function blog()
    {
        return $this->belongsTo('App\Blog', 'blog_id');
    }
}
