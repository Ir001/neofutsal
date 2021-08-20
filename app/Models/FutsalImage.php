<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FutsalImage extends Model
{
    use HasFactory;

    protected $table = 'futsal_images';

    protected $fillable = ['futsal_field_id', 'image'];
}
