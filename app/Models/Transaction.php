<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'order_id',
        'transaction_type_id',
        'payment_type_id',
        'proof_file',
        'code',
        'amount',
        'is_valid',
        'expired_payment',
    ];

    // Relation Method

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function trancation_type()
    {
        return $this->belongsTo(TransactionType::class);
    }
    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
