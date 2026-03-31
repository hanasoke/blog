<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model 
{
    protected $fillable = ['name'];

    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }
}