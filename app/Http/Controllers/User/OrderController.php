<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\checkScheduleRequest;
use App\Models\BallType;
use App\Models\FutsalField;
use Carbon\Carbon;
use Exception;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function detail(FutsalField $field)
    {
        $ball_types = BallType::select("name")->where('is_available', '1')->get();
        return view('user.order.detail', compact('field', 'ball_types'));
    }

    // Helper
    public function checkSchedule($field_id)
    {
        $field = FutsalField::where('is_available', '1')->findOrFail($field_id);
        $request = new checkScheduleRequest();
        $validator = Validator::make(request()->all(), $request->rules(), $request->messages());
        if ($validator->fails()) {
            $errors = Helpers::setErrors($validator->errors()->messages());
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
}
