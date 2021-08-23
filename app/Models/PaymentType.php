<?php

namespace App\Models;

use App\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory, SearchTrait;

    protected $table = 'payment_types';

    protected $fillable = ['name', 'bank_name', 'bank_code', 'bank_account','holder_name', 'instruction', 'is_active'];

    // Helper method
    public static function getActive()
    {
        return PaymentType::where('is_active', '1')->get();
    }
}
