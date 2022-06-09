<?php
/**
 * Author M. Atoar Rahman
 * Date: 07/02/2021
 * Time: 11:40 AM
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NoticeRequest extends FormRequest
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
            'subject' =>'required',
            'notice_from' =>'required',
            'notice_to' =>'required',

        ];
    }

    public function messages() {
        return [
            'date.required' => 'Date is required!',
            'subject.required' => 'Subject is required!',
            'notice_from.required' => 'Notice From is required!',
            'notice_to.required' => 'Notice To is required!',
        ];
    }
}
