<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name',
    ];

    public function blogs()
    {
        return $this->hasMany('App\Blog', 'genre_id');
    }
}
