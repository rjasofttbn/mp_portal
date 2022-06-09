<?php

namespace App\Traits;

use App\User;
use App\Model\Profile;
use Illuminate\Support\Facades\DB;

trait ProfileCreationTrait
{
    public function storeProfile($request)
    {
        $this->validateProfile($request);
        $returnResult = [];

        DB::beginTransaction();
        try {
            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name_eng;
            $user->password = bcrypt($request->password);
            if ($user->save()) {
                $params = $request->except('password');
                $params['user_id'] = $user->id;
                $profile = Profile::create($params);
            }

            DB::commit();
            $returnResult['status'] = true;
            $returnResult['data']   = $profile;
        } catch (\Throwable $th) {
            DB::rollback();
            $returnResult['status']  = false;
            $returnResult['message'] = $th->getMessage();
        }

        return $returnResult;
    }

    protected function validateProfile($request){
        $rules = [
            'email' => 'required|string|email|max:255|unique:users',
            'name_bn' => 'required|string',
            'name_eng' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'nid_no' => 'required|string',
            'religion' => 'required|string',
            'designation_id' => 'required|string',
            'parliament_id' => 'required|string',
            'political_parties_id' => 'required|string',
            'birth_district_id' => 'required|string',
            'constituency_id' => 'required|string',
        ];

        if ($request->isMethod('post')) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        $this->validate($request, $rules);
    }
}