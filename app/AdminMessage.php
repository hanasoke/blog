<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model 
{
    protected $table = 'admin_messages';

    protected $fillable = [
        'user_id',
        'transaction_id',
        'message'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Transaction', 'transaction_id');
    }
}