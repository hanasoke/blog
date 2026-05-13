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
    const STATUS_REJECTED = 'REJECTED';
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
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function getStatusBadgeClass()
    {
        switch($this->status) {
            case self::STATUS_PENDING:
                return 'badge-warning';
            case self::STATUS_APPROVED:
                return 'badge-success';
            case self::STATUS_REJECTED:
                return 'badge-danger';
            case self::STATUS_CANCELLED:
                return 'badge-secondary';
            default:
                return 'badge-secondary';
        }
    }
}