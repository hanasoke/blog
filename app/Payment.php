<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{
    protected $table = 'payments';

    protected $fillable = [
        'name',
    ];

    // public function transactions()
    // {
    //     return $this->hasMany('App\Transaction', 'payment_id');
    // }

}