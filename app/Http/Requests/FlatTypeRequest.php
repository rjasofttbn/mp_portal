<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use app\model\AccommodationBuilding;

class FlatTypeRequest extends FormRequest
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
                Rule::unique('flat_types')->ignore($request->id, 'id'),
            ],
           'accommodationbuilding_id' =>'required',
           'service_charge' =>'required|numeric',
           'status' =>'required',

       ];
    }
    public function messages() {
        return [
            'name.required' => 'Name is required!',
            'name.unique' => 'name already exists!',
            'building_id.required' => 'Building is required!',
            'service_charge.required' => 'Service charge is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
