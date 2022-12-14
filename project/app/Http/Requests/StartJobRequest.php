<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartJobRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'vehicle_id' => 'required',
            'start_localization' => 'required',
            'end_localization' => 'required',
            'start_odometer' => 'required',
            'start_time' => 'required'
        ];
    }
}
