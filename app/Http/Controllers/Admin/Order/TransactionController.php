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
            $transaction->payment_type = $transaction->payment_type;
            return response()->json(['success'=>true,'data'=>$transaction]);
        }catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function update(Transaction $transaction, Request $request){
        try{
            $validator = Validator::make($request->all(),
            [
                'is_valid'=>'required|numeric'
            ],[
                'is_valid.required' => 'Status wajib dipilih!',
                'is_valid.numeric' => 'Invalid status!',
            ]);
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->withErrors($errors);
            }
            $data = $validator->validated();
            $transaction->update($data);
            $repayment = Transaction::where(['order_id'=>$transaction->order_id,'transaction_type_id'=>2]);
            if($transaction->transaction_type_id == 1){
                if(!$repayment->exists()){
                    Transaction::create([
                        'order_id' => $transaction->order->id,
                        'transaction_type_id' => 2,
                        'code' => rand(100,999),
                        'amount' => (($transaction->order->price*$transaction->order->hours) * 0.5),
                        'expired_payment' => Carbon::parse($transaction->order->end_at)->addHours(2)->format('Y-m-d H:i:s')
                    ]);
                }else{
                    $repayment->delete();
                }                
            }
            return redirect()->back()->withSuccess('Data transaksi telah diubah!');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());

        }
    }
}
