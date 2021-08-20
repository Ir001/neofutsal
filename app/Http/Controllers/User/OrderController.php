<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\checkScheduleRequest;
use App\Models\BallType;
use App\Models\FutsalField;
use App\Models\FutsalImage;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Transaction;
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
        $images = FutsalImage::where(['futsal_field_id'=>$field->id]);
        $imageExist = $images->exists();
        $images = $images->get();
        return view('user.order.detail', compact('field', 'ball_types','images','imageExist'));
    }

    public function order(FutsalField $field)
    {
        try {
            $base64 = request()->schedule;
            $schedule = json_decode(base64_decode($base64));
            if (empty($schedule)) {
                return redirect()->back()->with('error', 'Invalid!');
            }
            $date = $schedule->day;
            $dateReadable = Carbon::parse($date)->locale('id')->translatedFormat('l, d F Y');
            $hours = Carbon::parse($schedule->start_at)->diffInHours($schedule->end_at);
            $priceTotal = $hours * $field->price;
            $downPayment = $priceTotal * 0.5;
            $paymentTypes = PaymentType::select(['id', 'bank_name'])->where('is_active', '1')->get();
            return view('user.order.order', compact('schedule', 'hours', 'field', 'dateReadable', 'priceTotal', 'downPayment', 'paymentTypes'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function booking(FutsalField $field, Request $request)
    {
        if (!$field->available()) {
            abort(404);
        }
        $validator = Validator::make($request->all(), [
            'schedule' => 'required',
            'transaction_type_id' => 'required|numeric',
            'payment_type_id' => 'required|numeric',
        ], [
            'schedule.required' => 'Invalid Schedule, Try Again Later!',
            'transaction_type_id.required' => 'Jenis Pembayaran Wajib Dipilih',
            'payment_type_id.required' => 'Metode Pembayaran Wajib Dipilih',
        ]);
        if ($validator->fails()) {
            $errors = Helpers::setErrors($validator->errors()->messages());
            return response()->json(['success' => false, 'error' => true, 'message' => $errors]);
        }
        try {
            $req = $validator->validated();
            $schedule = json_decode(base64_decode($req['schedule']));
            $diff = (new Carbon($schedule->start_at))->diff($schedule->end_at);
            $isScheduleExist = Order::isScheduleExist($field->id, $schedule->day, $schedule->start_at, $schedule->end_at);
            if ($diff->invert > 0) {
                return response()->json(['success' => false, 'error' => true, 'message' => 'Mohon periksa jam mulai dan selesai!']);
            }
            if ($isScheduleExist) {
                return response()->json(['success' => false, 'error' => true, 'message' => 'Lapangan telah dibooking pada waktu tersebut!']);
            }

            $totalPrice = ($field->price * $diff->h);
            $downPayment = (0.5 * $totalPrice);
            $expiredPayment = Carbon::now()->addHour(2)->format('Y-m-d H:i:s');

            $order = Order::create([
                'user_id' => auth()->user()->id,
                'futsal_field_id' => $field->id,
                'hours' => $diff->h,
                'price' => $totalPrice,
                'play_date' => $schedule->day,
                'start_at' => Carbon::parse($schedule->start_at)->format('Y-m-d H:i:s'),
                'end_at' => Carbon::parse($schedule->end_at)->format('Y-m-d H:i:s'),
            ]);
            $orderId = $order->id;
            $trx = Transaction::create([
                'order_id' => $orderId,
                'transaction_type_id' => $req['transaction_type_id'],
                'payment_type_id' => $req['payment_type_id'],
                'code' => rand(100, 999),
                'amount' => ($req['payment_type_id'] == 1 ? $downPayment : $totalPrice),
                'expired_payment' => $expiredPayment
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Lapangan berhasil dipesan. Segera lakukan pembayaran',
                'data' => ['orderId' => $orderId, 'expired_at' => $expiredPayment, 'transactionId' => $trx->id],
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Check Schedule Playing Futsal function
     *
     * @param FutsalField $field
     * @return json
     */
    public function checkSchedule(FutsalField $field)
    {
        if (!$field->available()) {
            abort(404);
        }
        $request = new checkScheduleRequest();
        $validator = Validator::make(request()->all(), $request->rules(), $request->messages());
        if ($validator->fails()) {
            $errors = Helpers::setErrors($validator->errors()->messages());
            return response()->json(['success' => false, 'error' => true, 'message' => $errors]);
        }
        try {
            $req = $validator->validated();
            $req['start_at'] = Carbon::parse($req['start_at'])->format('Y-m-d H:i:s');
            $req['end_at'] = Carbon::parse($req['end_at'])->format('Y-m-d H:i:s');
            $diff = (new Carbon($req['start_at']))->diff($req['end_at']);
            $isScheduleExist = Order::isScheduleExist($field->id, $req['day'], $req['start_at'], $req['end_at']);
            if ($isScheduleExist) {
                return response()->json(['success' => false, 'error' => true, 'message' => 'Lapangan telah dibooking pada waktu tersebut!']);
            }
            $isScheduleExist = Order::isScheduleExist($field->id, $req['day'], $req['start_at'], $req['end_at']);
            if ($diff->invert > 0 || $diff->h < 1) {
                return response()->json(['success' => false, 'error' => true, 'message' => 'Mohon periksa jam mulai dan selesai!']);
            }
            if ($diff->h > 0 && $diff->i == 0 && !$isScheduleExist) {
                $data = base64_encode(json_encode($req));
                return response()->json(['success' => true, 'message' => 'Jadwal Tersedia!', 'data' => $data]);
            }
            return response()->json(['success' => false, 'message' => 'Jadwal tidak tersedia!']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
