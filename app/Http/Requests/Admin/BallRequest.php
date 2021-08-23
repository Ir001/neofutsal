<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BallRequest extends FormRequest
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
            'name' => 'required',
            'amount' => 'required|numeric',
            'is_available' => 'required|numeric',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Jenis bola wajib diisi!',
            'amount.required' => 'Jumlah bola wajib diisi!',
            'amount.numeric' => 'Invalid format status bola!',
            'is_available.required' => 'Status bola wajib dipilih!',
            'is_available.numeric' => 'Invalid format status bola!',
        ];
    }
}
