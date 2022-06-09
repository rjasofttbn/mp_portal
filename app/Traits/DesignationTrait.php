<?php

namespace App\Traits;

use App\Model\Designation;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

trait DesignationTrait
{
    public function all()
    {
        return Designation::orderBy('id', 'desc')->get();;
    }

    public function getDesignation($id)
    {
        return Designation::find($id);
    }

    protected function validateDesignation($request){
        $rules = [
            'name' => 'required|string',
            'name_bn' => 'required|string',
        ];

        $this->validate($request, $rules);
    }

    public function creationDesignation($request, $id = null){
        $this->validateDesignation($request);
        $returnResult = [];

        DB::beginTransaction();
        try {
            $params = $request->all();
            if ($id) {
                $designation = Designation::find($id);
                $params['status'] = $request->status ?? 0;
                $designation->update($params);
            }else{
                $designation = Designation::create($params);
            }

            DB::commit();
            $returnResult['status'] = true;
            $returnResult['data']   = $designation;
        } catch (\Throwable $th) {
            DB::rollback();
            $returnResult['status']  = false;
            $returnResult['message'] = $th->getMessage();
        }

        return $returnResult;
    }

}
