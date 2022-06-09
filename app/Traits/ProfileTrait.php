<?php

namespace App\Traits;

use App\User;
use App\Model\Profile;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

trait ProfileTrait
{
    public function all()
    {
        return Profile::all();
    }

    public function getProfile($id)
    {
        return Profile::find($id);
    }

    public function creationProfile_old($request, $id = null)
    {
        if ($id) {
            $profile = Profile::find($id);
        }
        //dd($profile);
        $this->validateProfile($request, $profile = null);
        $returnResult = [];

        DB::beginTransaction();
        try {
            if ($profile) {
                $user = User::find($profile->user_id);
            } else {
                $user = new User;
            }
            $user->email = $request->email;
            $user->name = $request->name_eng;
            $user->password = bcrypt($request->password);
            if ($profile) {
                $user->update();
            } else {
                $user->save();
            }
            if ($user) {
                $params = $request->except('password');
                $params['user_id'] = $user->id;
                if ($profile) {
                    $profile->update($params);
                } else {
                    $profile = Profile::create($params);
                }
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

    public function creationProfile($request, $id = null)
    {
        
        $returnResult = [];
        if ($id) {
            $profile = Profile::find($id);
            //$this->validateProfile($request, $profile);
            //echo '<pre>'.var_export($profile,true).'</pre>';
            //die();
            DB::beginTransaction();
            try {
                if ($profile) {
                    $user = User::find($profile->user_id);
                } else {
                    $user = new User;
                }
                $user->email = $request->email;
                $user->name = $request->name_eng;
                $user->password = bcrypt($request->password);
                if ($profile) {
                    $user->update();
                } else {
                    $user->save();
                }
                if ($user) {
                    $params = $request->except('password');
                    $params['user_id'] = $user->id;
                    if ($profile) {
                        $profile->update($params);
                    } else {
                        $profile = Profile::create($params);
                    }
                }

                DB::commit();
                $returnResult['status'] = true;
                $returnResult['data']   = $profile;
            } catch (\Throwable $th) {
                DB::rollback();
                $returnResult['status']  = false;
                $returnResult['message'] = $th->getMessage();
            }
        }
        else {
            $profile = null;
            $this->validateProfile($request);
            DB::beginTransaction();
            try {
                if ($profile) {
                    $user = User::find($profile->user_id);
                } else {
                    $user = new User;
                }
                $user->email = $request->email;
                $user->name = $request->name_eng;
                $user->password = bcrypt($request->password);
                if ($profile) {
                    $user->update();
                } else {
                    $user->save();
                }
                if ($user) {
                    $params = $request->except('password');
                    $params['user_id'] = $user->id;
                    if ($profile) {
                        $profile->update($params);
                    } else {
                        $profile = Profile::create($params);
                    }
                }

                DB::commit();
                $returnResult['status'] = true;
                $returnResult['data']   = $profile;
            } catch (\Throwable $th) {
                DB::rollback();
                $returnResult['status']  = false;
                $returnResult['message'] = $th->getMessage();
            }
        }
        // dd($profile);
        return $returnResult;
    }

    protected function validateProfile($request, $profile = null)
    {
        $rules = [
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
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }
        if ($request->isMethod('PUT')) {
             $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($profile->user_id)];
        }

        return $this->validate($request, $rules);
    }
}
