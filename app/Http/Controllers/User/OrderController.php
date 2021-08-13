<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\checkScheduleRequest;
use App\Models\BallType;
use App\Models\FutsalField;
use App\Models\PaymentType;
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

    public function order(FutsalField $field)
    {
        $base64 = request()->schedule;
        $schedule = json_decode(base64_decode($base64));
        if (empty($schedule)) {
            return redirect()->back()->with('error', 'Invalid!');
        }
        $date = $schedule->day;
        $start_at = "{$date} " . $schedule->start_at;
        $end_at = "{$date} " . $schedule->end_at;
        $dateReadable = Carbon::parse($date)->locale('id')->translatedFormat('l, d F Y');
        $hours = Carbon::parse($start_at)->diffInHours($end_at);
        $priceTotal = $hours * $field->price;
        $downPayment = $priceTotal * 0.5;
        $paymentTypes = PaymentType::select(['id', 'bank_name'])->where('is_active', '1')->get();
        return view('user.order.order', compact('schedule', 'hours', 'field', 'dateReadable', 'priceTotal', 'downPayment', 'paymentTypes'));
    }

    // Helper
    public function checkSchedule(FutsalField $field)
    {
        if ($field->is_available < 1) {
            abort(404);
        }
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
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
