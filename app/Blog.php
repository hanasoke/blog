<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model 
{
    protected $fillable = [
        'title',
        'genre_id',
        'source_id',
        'thumbnail',
        'image_2',
        'image_3',
        'description',
        'user_id',
    ];

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function source()
    {
        return $this->belongsTo('App\Source');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}