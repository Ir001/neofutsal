<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    protected $table = 'transaction_types';

    protected $fillable = ['name'];

    public function transactions(){
        return $this->hasMany(Transaction::class,'transaction_type_id','id');
    }
}
