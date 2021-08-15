<?php

namespace App\Models;

use Exception;
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

    // Helper
    /**
     * Chek schedule by field_id, play date, time_start & time_end
     *
     * @param [int] $field_id
     * @param [string] $date
     * @param [string] $time_start
     * @param [string] $time_end
     * @return boolean
     */
    public static function isScheduleExist($field_id, $date, $time_start, $time_end)
    {
        try {
            $exist = Order::where([
                ['field_id', '=', $field_id],
                ['play_date', '=', $date],
                ['start_at', '>=', $time_start], //Cek Jam Mulai Lebih dari jam mulai
                ['end_at', '<=', $time_start], // Cek Jam Selesai Kurang dari jam mulai
                ['start_at', '>=', $time_end], // Cek Jam Mulai Kurang dari jam selesai
                ['end_at', '<=', $time_end], // Cek Jam Selesai kurang dari jam selesai
                ['status_transaction_id', '>=', 3]
            ])->exist();
            return $exist;
        } catch (Exception $e) {
            return false;
        }
    }
}
