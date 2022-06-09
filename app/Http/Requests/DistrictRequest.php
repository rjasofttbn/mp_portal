<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class DistrictRequest extends FormRequest
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

           // 'name' =>'required',
             'name' =>[
                 'required',
                 Rule::unique('districts')->ignore($request->id, 'id'),
             ],
            'bn_name' =>'required',
            'division_id' =>'required',
            'status' =>'required',

        ];
    }

    public function messages() {
        return [
            'name.required' => 'English Name is required!',
            'bn_name.required' => 'Bangla Name is required!',
            'name.unique' => 'Name already exists!',
            'division_id.required' => 'Division is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
