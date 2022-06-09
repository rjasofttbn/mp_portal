<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


/*
Crated By : Rajan Bhatta,
    Created Date: 28-01-2021

*/


class NoticeRulesRequest extends FormRequest
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

            'rule_number' =>'required',
            'name' =>'required',
            'department_id' =>'required',

        ];
    }

    public function messages() {
        return [
            'rule_number.required' => 'Rule number is required!',
            'name.required' => 'Name is required!',
            'department_id.required' => 'Department is required!',
        ];
    }
}
