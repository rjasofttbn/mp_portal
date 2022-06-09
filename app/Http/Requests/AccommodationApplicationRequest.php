<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccommodationApplicationRequest extends FormRequest
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
            'date' =>'required',
            'subject' =>'required',

        ];
    }

    public function messages() {
        return [
            'date.required' => 'Date is required!',
            'subject.required' => 'Subject is required!',
            
        ];
    }
}
