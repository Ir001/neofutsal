<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BallRequest;
use App\Models\BallType;
use Exception;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = request()->q;
        $balls = BallType::when($q,function($query) use ($q){
            return $query->search($q);
        })->orderByDesc("updated_at")->paginate(6);
        return view('admin.master.ball.index',compact('balls'));
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
            $ballRequest = new BallRequest();
            $validator =Validator::make($request->all(), $ballRequest->rules(),$ballRequest->messages());
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->with("errors",$errors)->withInput();
            }
            $data = $validator->validated();
            BallType::create($data);
            return redirect()->back()->withSuccess("Jenis bola berhasil ditambah!");
        }catch(Exception $e){
            return redirect()->back()->with("errors",$e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  BallType $ball
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BallType $ball)
    {
        try{
            $ballRequest = new BallRequest();
            $validator =Validator::make($request->all(), $ballRequest->rules(),$ballRequest->messages());
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->with("errors",$errors)->withInput();
            }
            $data = $validator->validated();
            $ball->update($data);
            return redirect()->back()->withSuccess("Jenis bola telah diperbarui!");
        }catch(Exception $e){
            return redirect()->back()->with("errors",$e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  BallType $ball
     * @return \Illuminate\Http\Response
     */
    public function destroy(BallType $ball)
    {
        $ball->delete();
        return response()->json(['success'=>true,'message'=>'Jenis bola berhasil dihapus!']);
    }

    public function json(BallType $ball){
        return response()->json(['success'=>true,'data'=>$ball]);
    }
}
