<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class DepartmentRequest extends FormRequest
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
                 Rule::unique('departments')->ignore($request->id, 'id'),
             ],
            'status' =>'required',

        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name is required!',
            'name.unique' => 'Name already exists!',
            'status.required' => 'Status is required!',
        ];
    }
}
