<?php
/**
 * Author M. Atoar Rahman
 * Date: 25/01/2021
 * Time: 11:40 AM
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HostelBuildingRequest extends FormRequest
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
                Rule::unique('hostel_buildings')->ignore($request->id, 'id'),
            ],
            'number' =>'required'

        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name is required!',
            'name.unique' => 'Name already exists!'
        ];
    }
}
