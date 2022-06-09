<?php
/**
 * Author M. Atoar Rahman
 * Date: 01/02/2021
 * Time: 09:30 AM
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParliamentRequest extends FormRequest
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
            'parliament_number' =>'required',
            'date_from' =>'required',
            'date_to' =>'required',

        ];
    }

    public function messages() {
        return [
            'parliament_number.required' => 'Parliament Number is required!',
            'date_from.required' => 'From is required!',
            'date_to.required' => 'To is required!',
        ];
    }
}
