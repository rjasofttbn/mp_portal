<?php

namespace App\Traits;

use App\Model\AccommodationApplicationType;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

trait AccommodationApplicationTypeTrait
{
    public function all()
    {
        return AccommodationApplicationType::orderBy('id', 'desc')->get();;
    }

    public function getAccommodationApplicationType($id)
    {
        return AccommodationApplicationType::find($id);
    }

    protected function validateAccommodationApplicationType($request){
        $rules = [
            'name' => 'required|string',
            'name_bn' => 'required|string',
        ];

        $this->validate($request, $rules);
    }

    public function creationAccommodationApplicationType($request, $id = null){
        $this->validateDesignation($request);
        $returnResult = [];

        DB::beginTransaction();
        try {
            $params = $request->all();
            if ($id) {
                $accommodationapplicationtype = AccommodationApplicationType::find($id);
                $params['status'] = $request->status ?? 0;
                $accommodationapplicationtype->update($params);
            }else{
                $accommodationapplicationtype = AccommodationApplicationType::create($params);
            }

            DB::commit();
            $returnResult['status'] = true;
            $returnResult['data']   = $accommodationapplicationtype;
        } catch (\Throwable $th) {
            DB::rollback();
            $returnResult['status']  = false;
            $returnResult['message'] = $th->getMessage();
        }

        return $returnResult;
    }

}
