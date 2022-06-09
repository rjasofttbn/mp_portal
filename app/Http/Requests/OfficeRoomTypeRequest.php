<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OfficeRoomTypeRequest extends FormRequest
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
            'number' =>[
                'required',
                Rule::unique('office_room_types')->ignore($request->id, 'id'),
            ],
           'service_charge' =>'required|numeric',
           'status' =>'required',

       ];
    }
    public function messages() {
        return [
            'name.required' => 'Name is required!',
            'name.unique' => 'name already exists!',
            'service_charge.required' => 'Service charge is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
