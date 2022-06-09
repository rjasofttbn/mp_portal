<?php
/**
 * Author: Rajan Bhatta.
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HostelRoomRequest extends FormRequest
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
            'number' =>'required',
            'floor_id' =>'required',
            'building_id' =>'required',
            'room_type_id' =>'required',
            'status' =>'required',

        ];
    }

    public function messages() {
        return [
            'number.required' => 'Room Number is required!',
            'floor_id.required' => 'Floor is required!',
            'building_id.required' => 'Building is required!',
            'room_type_id.required' => 'Room Type is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
