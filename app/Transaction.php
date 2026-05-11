<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model 
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'member_id',
        'payment_id',
        'payment_proof',
        'account_number',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Status constant 
    const STATUS_PENDING = 'PENDING';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_REJECT = 'REJECTED';
    const STATUS_CANCELLED = 'CANCELLED';

    // Relationships 
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function member()
    {
        return $this->belongsTo('App\Member', 'member_id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment', 'payment_id');
    }

    // Helper methods 
}