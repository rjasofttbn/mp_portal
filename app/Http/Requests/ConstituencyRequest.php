<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ConstituencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [

           'name' =>'required',
           'bn_name' =>'required',
            'number' =>'required|numeric',
            'upazila_id' =>'required',
            'district_id' =>'required',
            'division_id' =>'required',
            'status' =>'required',

        ];
    }

    public function messages() {
        return [
            'name.required' => 'English Name is required!',
            'bn_name.required' => 'Bangla Name is required!',
            'number.required' => 'Number is required!',
            'upazila_id.required' => 'Upazila is required!',
            'district_id.required' => 'District is required!',
            'division_id.required' => 'Division is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
