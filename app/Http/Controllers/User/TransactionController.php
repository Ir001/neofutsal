<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::where([
            'user_id' => auth()->user()->id
        ])->paginate(10);
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
    public function repayment(Order $order)
    {
        return view('user.transaction.repayment');
    }
}
