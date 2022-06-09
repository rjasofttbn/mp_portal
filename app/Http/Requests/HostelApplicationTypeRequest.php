<?php

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HostelApplicationTypeRequest extends FormRequest
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

   
    public function rules(Request $request)
    {
        return [
             'subject' =>[
                 'required',
                 Rule::unique('hostel_application_types')->ignore($request->id, 'id'),
             ],
            'type_name' =>'required',

        ];
    }

    public function messages() {
        return [
            'subject.required' => 'English subject is required!',
            'subject.unique' => 'Subject already exists!',
            'type_name.required' => 'Type Name is required!',
        ];
    }
}
