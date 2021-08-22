<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function json(Transaction $transaction){
        try{
            return response()->json(['success'=>true,'data'=>$transaction->with('payment_type')->first()]);
        }catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function update(Transaction $transaction, Request $request){
        try{
            $validator = Validator::make($request->all(),
            [
                'status'=>'required|numeric'
            ],[
                'status.required' => 'Status wajib dipilih!',
                'status.numeric' => 'Invalid status!',
            ]);
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->withErrors($errors);
            }
            $data = $validator->validated();
            $transaction->update($data);
            if($transaction->transaction_type_id == 1){
                Transaction::create([
                    'order_id' => $transaction->order->id,
                    'transaction_type_id' => 2,
                    'code' => rand(100,999),
                    'amount' => (($transaction->order->price*$transaction->order->hours) * 0.5),
                    'expired_payment' => Carbon::parse($transaction->order->end_at)->addHours(2)->format('Y-m-d H:i:s')
                ]);
            }
            return redirect()->back()->withSuccess('Data transaksi telah diubah!');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());

        }
    }
}
