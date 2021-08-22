<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'img' => 'required|file|mimes:png,jpg',
            'detail.*' => 'nullable|file|mimes:png,jpg',
            'field_type_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'img.required' => 'Gambar sampul lapangan wajib ada!',
            'img.mimes' => 'Format gambar sampul salah!',
            'detail.*.file' => 'Format gambar detail salah!',
            'detail.*.mimes' => 'Format gambar detail salah!',
            'field_type_id.required' => 'Jenis lapangan wajib dipilih!',
            'name.required' => 'Nama lapangan wajib diisi!',
            'price.required' => 'Harga sewa per jam wajib diisi!',
            'price.numeric' => 'Harga sewa per jam harus berupa angka!',
            'width.required' => 'Panjang lapangan wajib diisi!',
            'height.required' => 'Lebar lapangan wajib diisi!',
        ];
    }

    
}
