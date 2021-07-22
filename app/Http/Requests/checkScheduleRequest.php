<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class checkScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'day' => 'required|date|date_format:Y-m-d',
            'start_at' => 'required|date_format:H:i',
            'end_at' => 'required|date_format:H:i',
        ];
    }
    public function messages()
    {
        return [
            'day.required' => 'Hari / Tanggal wajib dipilih!',
            'start_at.required' => 'Jam Mulai wajib dipilih!',
            'end_at.required' => 'Jam Selesai wajib dipilih!',
            'day.date' => 'Hari / Tanggal harus berupa tanggal!',
            'day.date_format' => 'Hari / Tanggal harus berupa tanggal!',
            'start_at.date_format' => 'Jam Mulai harus berupa jam!',
            'end_at.date_format' => 'Jam Selesai harus berupa jam!',
        ];
    }
}
