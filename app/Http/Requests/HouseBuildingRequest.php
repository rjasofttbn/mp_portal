<?php

/* 
Author: Naziur Rahman
Date: 22/03/2021
 */


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HouseBuildingRequest extends FormRequest
{
    


    public function rules(Request $request)
    {
        return [
            'name' => 'required',
            'name_bn' => 'required',
            'building_no' =>[
                'required',
                Rule::unique('house_buildings')->ignore($request->id, 'id'),
            ],
            'area_id' => 'required',

        ];
    }

    public function messages() {
        return [
            'name.required' => 'The name english field is required.',
            'name_bn.required' => 'The name bangla field is required.',
            'building_no.required' => 'The building no field is required.',
            'building_no.unique' => 'Building No already exists!',
            'area_id.required' => 'The area field is required.',
        ];
    }


}
