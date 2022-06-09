<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class MinistryRequest extends FormRequest
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
                 Rule::unique('ministries')->ignore($request->id, 'id'),
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
