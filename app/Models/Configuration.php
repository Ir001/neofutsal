<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $table = "configurations";
    protected $fillable = [
        'name',
        'content'
    ];

    // Helper Method
    public static function getConfig($name)
    {
        try {
            return Configuration::where('name', $name)->first();
        } catch (Exception $e) {
            return null;
        }
    }
}
