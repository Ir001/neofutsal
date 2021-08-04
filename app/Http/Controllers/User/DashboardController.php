<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FutsalField;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $futsal_fields = FutsalField::where('is_available', '1')->paginate(10);
        return view('user.dashboard', compact('futsal_fields'));
    }
}
