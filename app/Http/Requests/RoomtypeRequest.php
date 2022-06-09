<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class RoomtypeRequest extends FormRequest
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
                 Rule::unique('room_types')->ignore($request->id, 'id'),
             ],
            'rent' =>'required|numeric',
            'service_charge' =>'required|numeric',
            'size' =>'required|numeric',
            'status' =>'required',

        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name is required!',
            'name.unique' => 'Name already exists!',
            'rent.required' => 'Rent is required!',
            'service_charge.required' => 'Service charge is required!',
            'size.required' => 'Size is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
