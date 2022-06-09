<?php

namespace App\Http\Controllers\Backend\MenuManagement;

use App\Http\Controllers\Controller;
use App\Model\Module;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ModuleController extends Controller
{
    public function list()
    {
        $data['modules'] = Module::orderBy('sort','asc')->get();
        return view('backend.menu-management.module-info.list',$data);
    }

    public function sorting(Request $request){
        $jsonData = json_decode($request->jsondata);
        foreach ($jsonData as $key => $val) {
            if($val->id !=null){
                Module::where('id',$val->id)->update(['sort' => $key+1]);
            }
        }
    }

    public function add()
    {
        return view('backend.menu-management.module-info.add');
    }

    public function duplicateNameCheck(Request $request){
        $exist = Module::where('name',$request->name)->where('name','!=',$request->edit_data)->first();
        if($exist){
            return response()->json(Lang::get('This name already exist'));
        }else{
            return response()->json(true);
        }
    }

    public function duplicateNameBnCheck(Request $request){
        $exist = Module::where('name_bn',$request->name_bn)->where('name','!=',$request->edit_data)->first();
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
                'name'     => ['required', 'unique:modules'],
                'name_bn'     => ['required', 'unique:modules'],
            ]
        );

        DB::beginTransaction();
        try {
            $params               = $request->all();
            $params['created_by'] = Auth::id();
            $createmodule = Module::create($params);
            DB::commit();
            return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function edit(module $editData)
    {
        $data['editData'] = $editData;
        return view('backend.menu-management.module-info.add',$data);
    }

    public function update(module $editData, Request $request)
    {

        $validatedData = $request->validate(
            [
                'name'     => ['required', 'unique:modules,name,'.$editData->id],
                'name_bn'     => ['required', 'unique:modules,name_bn,'.$editData->id],
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
        }
    }
    
}
