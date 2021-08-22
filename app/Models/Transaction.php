<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
    public function transaction_type()
    {
        return $this->belongsTo(TransactionType::class);
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
    public function uploadPayment($file){
        try{
            $paymentType = $this->attributes['transaction_type_id'];
            $oldFile = $this->attributes['proof_file'];
            if (Storage::exists("public/$oldFile")) {
                Storage::delete("public/$oldFile");
            }
            $ext = $file->extension();
            $type = ($paymentType == 1 ? 'down-payment':'full');
            $filename = auth()->user()->id."-".Str::random(30).".".$ext;
            $fullPath = "payment/{$type}/{$filename}";
            $file->storeAs("public",$fullPath);
            $this->update(['proof_file' => "storage/$fullPath"]);
            $this->touch();
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}
