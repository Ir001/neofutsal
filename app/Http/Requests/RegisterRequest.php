<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required_with:password',
            'phone' => 'required|min:10|numeric',
            'is_aggree' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi!',
            'name.max' => 'Nama lengkap tidak boleh melebihi 255 karakter!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password setidaknya lebih dari 6 karakter!',
            'password.confirmed' => 'Konfirmasi password salah!',
            'password_confirmation.required_with' => 'Konfirmasi Password wajib diisi!',
            'phone.required' => 'Nomor WhatsApp wajib diisi!',
            'phone.min' => 'Nomor WhatsApp tidak valid!',
            'phone.numeric' => 'Nomor WhatsApp tidak valid!',
            'is_aggree.required' => 'Anda wajib menyetujui S&K yang berlaku!',
        ];
    }
}
