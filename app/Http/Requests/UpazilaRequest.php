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


class UpazilaRequest extends FormRequest
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
                 Rule::unique('upazilas')->ignore($request->id, 'id'),
             ],
            'bn_name' =>'required',
            'district_id' =>'required',
            'division_id' =>'required',
            'status' =>'required',

        ];
    }

    public function messages() {
        return [
            'name.required' => 'English Name is required!',
            'bn_name.required' => 'Bangla Name is required!',
            'name.unique' => 'Name already exists!',
            'district_id.required' => 'Division is required!',
            'division_id.required' => 'Division is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
