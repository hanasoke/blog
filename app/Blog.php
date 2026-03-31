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
    ];

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function source()
    {
        return $this->belongsTo('App\Source');
    }

}