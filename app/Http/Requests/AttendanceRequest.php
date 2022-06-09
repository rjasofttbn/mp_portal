<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class AttendanceRequest extends FormRequest
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
            'user_id' =>'required',
           'parliament_id' =>'required',
            'session_id' =>'required',
            'date' =>'required',
            'status' =>'required',


        ];
    }

    public function messages() {
        return [
            'user_id.required' => 'MP name is required!',
            'parliament_id.required' => 'Parliament is required!',
            'session_id.required' => 'Session is required!',
            'date.required' => 'Date is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
