<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentTypeRequest;
use App\Models\PaymentType;
use Exception;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = request()->q;
        $paymentTypes = PaymentType::when($q,function($query) use($q){
            return $query->search($q);
        })->orderByDesc("created_at")->paginate(6)->withQueryString();
        return view('admin.master.payment-type.index', compact('paymentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $paymentTypeRequest = new PaymentTypeRequest();
            $validator = Validator::make($request->all(),$paymentTypeRequest->rules(),$paymentTypeRequest->messages());
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->with("errors",$errors)->withInput();
            }
            $data = $validator->validated();
            PaymentType::create($data);
            return redirect(route("admin.paymentType.index"))->withSuccess("Metode pembayaran baru berhasil ditambah!");
        }catch(Exception $e){
            return redirect()->back()->with("errors",$e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PaymentType  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentType $payment)
    {
        try{
            $paymentTypeRequest = new PaymentTypeRequest();
            $validator = Validator::make($request->all(),$paymentTypeRequest->rules(),$paymentTypeRequest->messages());
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->with("errors",$errors)->withInput();
            }
            $data = $validator->validated();
            $payment->update($data);
            return redirect(route("admin.paymentType.index"))->withSuccess("Metode pembayaran berhasil diubah!");
        }catch(Exception $e){
            return redirect()->back()->with("errors",$e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PaymentType  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentType $payment)
    {
        $payment->delete();
        return response()->json(['success'=>true,'message'=>'Metode pembayaran berhasil dihapus!']);
    }

    public function json(PaymentType $payment){
        return response()->json(['success' => true,'data' => $payment]);
    }
}
