<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::where([
            'user_id' => auth()->user()->id
        ])->orderByDesc("id")->paginate(5);
        return view('user.transaction.index', compact('orders')); 
    }
    public function history()
    {
        return view('user.transaction.history');
    }
    public function order(Order $order){
        if($order->user_id == auth()->user()->id){
            $transactions = Transaction::where(['order_id'=>$order->id])->get();
            $schedule = Carbon::make($order->play_date)->locale('id')->translatedFormat('l, d F Y');
            $timeStart = Carbon::make($order->start_at)->format('H:i');
            $timeEnd = Carbon::make($order->end_at)->format('H:i');
            return view('user.transaction.order',compact('order','transactions','schedule','timeStart','timeEnd'));
        }
        return redirect()->back()->withError('Invalid data!');

    }
    public function detail(Transaction $transaction)
    {
        if($transaction->order->user_id == auth()->user()->id){
            $schedule = Carbon::make($transaction->order->play_date)->locale('id')->translatedFormat('l, d F Y');
            $timeStart = Carbon::make($transaction->order->start_at)->format('H:i');
            $timeEnd = Carbon::make($transaction->order->end_at)->format('H:i');
            return view('user.transaction.detail',compact('transaction','schedule','timeStart','timeEnd'));
        }
        return redirect()->back()->withError('Invalid data!');
    }

    public function pay(Transaction $transaction){
        try{
            if($transaction->order->user_id == auth()->user()->id){
                $validator = Validator::make(request()->all(),[
                    'proof_file' => 'required|file|max:5120|mimes:png,jpg,docx,pdf'
                ],[
                    'proof_file.required' => 'Bukti pembayaran wajib diupload!',
                    'proof_file.file' => 'Bukti pembayaran harus berupa file!',
                    'proof_file.max' => 'Ukuran file bukti pembayaran terlalu besar. Max: 5MB!',
                    'proof_file.mimes' => 'Format file tidak didukung!'
                ]);
                if($validator->fails()){
                    $errors = Helpers::setErrors($validator->errors()->messages());
                    return redirect()->back()->with('errors',$errors);
                }
                $request = $validator->validated();
                $trxTypeId = $transaction->transaction_type_id;
                $transaction->uploadPayment($request['proof_file']);
                $status = ($trxTypeId == 1 ? 3 : 4);
                $transaction->order->update(['status_transaction_id'=>$status]);
                return redirect()->back()->withSuccess('Pembayaran sedang diproses!');
            }
            return redirect()->back()->with('errors','Forbidden!');
        }catch(Exception $e){
            return redirect()->back()->with('errors',$e->getMessage());
        }
        
    }

    public function repayment(Order $order)
    {
        return view('user.transaction.repayment');
    }

}
