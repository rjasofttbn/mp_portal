<?php
/**
 * Author M. Atoar Rahman
 * Date: 02/02/2021
 * Time: 09:30 AM
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
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
            'date' =>'required',
            'time_from' =>'required',
            'time_to' =>'required',
            'topics' =>'required',
            'status' =>'required',

        ];
    }

    public function messages() {
        return [
            'date.required' => 'Date is required!',
            'time_from.required' => 'Time is required!',
            'time_to.required' => 'Time is required!',
            'topics.required' => 'Topics is required!',
            'status.required' => 'Status is required!',
        ];
    }
}
