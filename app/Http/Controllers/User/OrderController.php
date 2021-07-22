<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkSchedule()
    {
        try {
            $diff = (new Carbon(request()->start_at))->diff(request()->end_at)->format("%H:%I");
            return response()->json(['success' => true, 'message' => 'Jadwal Tersedia!']);
        } catch (Exception $e) {
        }
    }
}
