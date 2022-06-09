<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FurnitureElectronicGoodsRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'accommodation_type_id' =>[
                'required',
               
            ],
        ];
    }

    public function messages() {
        return [
            'accommodation_type_id.required' => 'Select Accommodation Type!',
        ];
    }
}
