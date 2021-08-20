<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTransaction extends Model
{
    use HasFactory;

    protected $table = 'status_transactions';

    protected $fillable = ['name_user', 'name_admin','color'];
}
