<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentTypeRequest extends FormRequest
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
            'bank_name' => 'required',
            'bank_code' => 'required',
            'bank_account' => 'required',
            'holder_name' => 'required',
            'is_active' => 'required|numeric',
            'instruction' => 'required',
        ];
    }
    public function messages(){
        return [
            'bank_name.required' => 'Nama BANK / metode pembayaran wajib diisi!',
            'bank_code.required' => 'Kode BANK wajib diisi!',
            'bank_account.required' => 'Nomor rekening wajib diisi!',
            'holder_name.required' => 'Atas nama pembayaran wajib diisi!',
            'is_active.required' => 'Status pembayaran wajib dipilih!',
            'is_active.numeric' => 'Invalid format status pembayaran!',
            'instruction.required' => 'Instruksi pembayaran wajib diisi!',
        ];
    }
}
