<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\checkScheduleRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function checkSchedule()
    {
        $request = new checkScheduleRequest();
        $validator = Validator::make(request()->all(), $request->rules(), $request->messages());
        if ($validator->fails()) {
            $errors = "<ul class='text-left font-sm list-inside list-decimal'>";
            foreach ($validator->errors()->messages() as $error) {
                $x = count($error);
                for ($i = 0; $i < $x; $i++) {
                    $errors .= "<li>{$error[$i]}</li>";
                }
            }
            $errors .= "</ul>";
            return response()->json(['success' => false, 'error' => true, 'message' => $errors]);
        }
        try {
            $validated = $validator->validated();
            $diff = (new Carbon($validated['start_at']))->diff($validated['end_at']);
            if ($diff->invert > 0) {
                return response()->json(['success' => false, 'error' => true, 'message' => 'Mohon periksa jam mulai dan selesai!']);
            }
            if ($diff->h > 0 && $diff->i == 0) {
                $data = base64_encode(json_encode($validated));
                return response()->json(['success' => true, 'message' => 'Jadwal Tersedia!', 'data' => $data]);
            }
            return response()->json(['success' => false, 'message' => 'Jadwal tidak tersedia!']);
        } catch (Exception $e) {
        }
    }
    public function transaction()
    {
        return view('transaction.index');
    }
    public function transactionHistory()
    {
        return view('transaction.history');
    }
}
