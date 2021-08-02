<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'futsal_field_id',
        'status_transaction_id',
        'hours',
        'price',
        'play_date',
        'start_at',
        'end_at',
    ];

    // Relation Method

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function futsal_field()
    {
        return $this->belongsTo(FutsalField::class);
    }
    public function status_transaction()
    {
        return $this->belongsTo(StatusTransaction::class);
    }
    public function transactions()
    {
        return $this->hasMany(Relation::class, 'order_id', 'id');
    }
}
