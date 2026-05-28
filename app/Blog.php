<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\AccessHelper;

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

    public function access()
    {
        return $this->hasOne('App\AccessBlog', 'blog_id');
    }

    // Check if user can access this blog 
    public function userCanAccess($user)
    {
        return AccessHelper::canAccessBlog($user, $this);
    }

    // Get required access level 
    public function getRequiredAccessLevel()
    {
        return AccessHelper::getRequiredLevel($this);
    }

}