<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Controllers\Controller;
use App\Model\Role;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class RoleController extends Controller
{
    public function list()
    {
        $data['roles'] = Role::where('id','!=',1)->orderBy('sort','asc')->get();
        return view('backend.user-management.role-info.list',$data);
    }

    public function sorting(Request $request){
        $jsonData = json_decode($request->jsondata);
        foreach ($jsonData as $key => $val) {
            if($val->id !=null){
                Role::where('id',$val->id)->update(['sort' => $key+1]);
            }
        }
    }

    public function add()
    {
        return view('backend.user-management.role-info.add');
    }

    public function duplicateNameCheck(Request $request){
        $exist = Role::where('name',$request->name)->where('name','!=',$request->edit_data)->first();
        if($exist){
            return response()->json(Lang::get('This name already exist'));
        }else{
            return response()->json(true);
        }
    }

    public function duplicateNameBnCheck(Request $request){
        $exist = Role::where('name_bn',$request->name_bn)->where('name','!=',$request->edit_data)->first();
        // dd($exist);
        if($exist){
            return response()->json(Lang::get('This name already exist'));
        }else{
            return response()->json(true);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name'     => ['required', 'unique:roles'],
                'name_bn'     => ['required', 'unique:roles'],
            ]
        );

        DB::beginTransaction();
        try {
            $params               = $request->all();
            $params['created_by'] = Auth::id();
            $createrole = Role::create($params);
            DB::commit();
            return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function edit(Role $editData)
    {
        $data['editData'] = $editData;
        return view('backend.user-management.role-info.add',$data);
    }

    public function update(Role $editData, Request $request)
    {

        $validatedData = $request->validate(
            [
                'name'     => ['required', 'unique:roles,name,'.$editData->id],
                'name_bn'     => ['required', 'unique:roles,name_bn,'.$editData->id],
            ]
        );

        DB::beginTransaction();
        try {
            $params               = $request->all();
            $params['updated_by'] = Auth::id();
            $editData->update($params);
            DB::commit();
            return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Updated')]);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }
    
}
