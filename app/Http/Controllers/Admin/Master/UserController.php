<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = request()->q;
        $users = User::when($q,function($query) use ($q){
            return $query->search($q);
        })->orderByDesc('id')->paginate(12)->withQueryString();
        return view('admin.master.user.index',compact('users'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        try{
            $request = new RegisterRequest();
            $validator = Validator::make(request()->all(),$request->rules(),$request->messages());
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->with('errors',$errors)->withInput();
            }
            $user = $validator->validated();
            $user['password'] = Hash::make($user['password']);
            User::create($user);
            return redirect()->back()->withSuccess('User berhasil ditambah!');
        }catch(Exception $e){
            return redirect()->back()->with('errors',$e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user,Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required|numeric|min:12',
                'password' => 'nullable|min:6|confirmed',
            ],[
                'name.required' => 'Nama lengkap wajib diisi!',
                'phone.required' => 'Nomor WhatsApp wajib diisi!',
                'phone.numeric' => 'Format nomor WhatsApp salah!',
                'phone.min' => 'Nomor WhatsApp minimal 11 karakter!',
                'password.min' => 'Password baru minimal 6 karakter!',
                'password.confirmed' => 'Konfirmasi password salah!'
            ]);
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->with('errors',$errors);
            }
            $data = $validator->validated();
            if(empty($data['password'])){
                unset($data['password']);
            }else{
                $data['password'] = Hash::make($data['password']);
            }
            $user->update($data);
            return redirect()->back()->withSuccess('Data user telah diperbarui!');
        }catch(Exception $e){
            return redirect()->back()->with('errors',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try{
            $user->delete();
            return response()->json(['success'=>true,'message'=>'User berhasil dihapus!']);
        }catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
    /**
     * Show Detail User Return JSON
     *
     * @param User $user
     * @return json
     */
    public function json(User $user){
        return response()->json(['success'=>true,'data'=>$user]);
    }
}
