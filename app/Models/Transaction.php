<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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
        return $this->belongsTo(TransactionType::class,'transaction_type_id');
    }
    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }

    // Helper 
    /**
     * Upload Proof Payment
     *
     * @param [Illuminate\Http\UploadedFile] $file
     * @param integer $paymentType
     * @return string|null
     */
    public static function uploadPayment($file,$paymentType=1){
        try{
            $ext = $file->extension();
            $type = ($paymentType == 1 ? 'down-payment':'full');
            $filename = auth()->user()->id."-".Str::random(30).".".$ext;
            $fullPath = "payment/{$type}/{$filename}";
            $file->storeAs("public",$fullPath);
            return $fullPath;
        }catch(Exception $e){
            return null;
        }
    }
}
