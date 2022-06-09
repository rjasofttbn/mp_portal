<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentialBuildingRequest extends FormRequest
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
             'name' =>[
                 'required',
                 Rule::unique('residential_buildings')->ignore($request->id, 'id'),
             ],
            'number' =>'required',
            'total_floor' =>'required',
            'total_flat' =>'required',
            'status' =>'required',

        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name is required!',
            'name.unique' => 'Name already exists!',
            'number.required' => 'Number is required!',
            'total_floor.required' => 'Total Floor is required!',
            'total_flat.required' => 'Total Flat is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
