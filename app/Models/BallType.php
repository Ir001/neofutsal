<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BallType extends Model
{
    use HasFactory;

    protected $table = 'ball_types';

    protected $fillable = ['name', 'amount', 'is_available'];
}
