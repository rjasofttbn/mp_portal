<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class AccommodationTypeRequest extends FormRequest
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
            
            'name' =>[
                'required',
               
            ],
            'name_bn' =>'required',

        ];
    }
    
    public function messages() {
        return [
            'name.required' => 'Name is required!',
            'name.unique' => 'Name already exists!',
            'name_bn.required' => 'Name Bangla is required!',
        ];
    }
}
