<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.profile.index', compact('user'));
    }
    public function edit()
    {
        $user = auth()->user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required|min:11',
            ],[
                'name.required' => 'Nama lengkap wajib diisi!',
                'phone.required' => 'Nomor WhatsApp wajib diisi!',
                'phone.min' => 'Nomor WhatsApp minimal 11 digit!',
            ]);
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->with("errors",$errors)->withInput();
            }
            $data = $validator->validated();
            $user = User::find(auth()->user()->id);
            $user->update($data);
            return redirect()->back()->withSuccess("Profile berhasil diperbarui!");
        }catch(Exception $e){
            return redirect()->back()->with("errors",$e->getMessage())->withInput();
        }
    }

    public function password()
    {
        return view('user.profile.password');
    }

    public function updatePassword(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ],[
                'old_password.required' => 'Password lama wajib diisi!',
                'password.required' => 'Password baru wajib diisi!',
                'password.min' => 'Password baru minimal 6 karakter atau lebih!',
                'password.confirmed' => 'Konfirmasi password baru salah!',
            ]);
            if($validator->fails()){
                $errors = Helpers::setErrors($validator->errors()->messages());
                return redirect()->back()->with("errors",$errors)->withInput();
            }
            $data = $validator->validated();
            $data['password'] = Hash::make($data['password']);
            if(!Hash::check($data['old_password'], auth()->user()->password)){
                return redirect()->back()->with("errors","Password sekarang salah!")->withInput();
            }
            $user = User::find(auth()->user()->id);
            $user->update($data);
            return redirect()->back()->withSuccess("Password berhasil diperbarui!");
        }catch(Exception $e){
            return redirect()->back()->with("errors",$e->getMessage())->withInput();
        }
    }
}
