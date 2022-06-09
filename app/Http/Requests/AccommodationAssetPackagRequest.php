<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationAssetPackagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'accommodation_type_id' =>[
                'required',
            ],
            'flat_type_id' =>'required',
        ];
    }
    
    public function messages() {
        return [
            'accommodation_type_id.required' => 'Accommodation type is required!',
            'flat_type_id.required' => 'Flat type is required!',
        ];
    }
}
