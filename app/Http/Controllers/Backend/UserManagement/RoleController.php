<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Controllers\Controller;
use App\Model\Role;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;

class RoleController extends Controller
{
    public function list()
    {
        $data['roles'] = Role::where('id','!=',1)->orderBy('sort','asc')->get();
        if (isApi()) {
            $response['status'] = 'success';
            $response['message'] = '';
            $response['api_info']    = $data;
            return response()->json($response);
        }
        return view('backend.user-management.role-info.list',$data);
    }

    public function sorting(Request $request){
        $jsonData = json_decode($request->jsondata);

        DB::beginTransaction();
        try {            
            foreach ($jsonData as $key => $data) {
                if($data->id !=null){
                    Role::where('id',$data->id)->update(['sort' => $key+1]);
                }
            }
            DB::commit();
            if (isApi()) {
                $response['status'] = 'success';
                $response['message'] = Lang::get('Data Successfully Insert');
            }
            return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);
        } catch (\Exception $e) {
            DB::rollback();

            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = $e;
            }
            return response()->json(['status'=>'error','message'=>$e]);
        }
    }

    public function add()
    {
        return view('backend.user-management.role-info.add');
    }

    public function duplicateNameCheck(Request $request){
        $exist = Role::where('name',$request->name)->where('name','!=',$request->edit_data)->first();
        if($exist){            
            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = Lang::get('This name already exist');
            }
            return response()->json(Lang::get('This name already exist'));
        }else{
            if (isApi()) {
                $response['status'] = 'success';
                $response['message'] = '';
            }
            return response()->json(true);
        }
    }

    public function duplicateNameBnCheck(Request $request){
        $exist = Role::where('name_bn',$request->name_bn)->where('name','!=',$request->edit_data)->first();
        // dd($exist);
        if($exist){
            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = Lang::get('This name already exist');
            }
            return response()->json(Lang::get('This name already exist'));
        }else{
            if (isApi()) {
                $response['status'] = 'success';
                $response['message'] = '';
            }
            return response()->json(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'name'     => ['required', 'unique:roles'],
                'name_bn'     => ['required', 'unique:roles']
            ]
        );

        if ($validator->fails()) {
            if (isApi()) {
                $response['validator']    = $validator;
                return response()->json($response);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $store = new Role();
            $store->name = $request->name;
            $store->name_bn = $request->name_bn;
            $store->description = $request->description;
            $store->mail_status = $request->mail_status;
            $store->status = $request->status;
            $store->save();
            // $params               = $request->all();
            // $params['created_by'] = Auth::id();
            // $createrole = Role::create($params);
            DB::commit();
            if (isApi()) {
                $response['status'] = 'success';
                $response['message'] = Lang::get('Data Successfully Insert');
            }
            return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert'),'reload_url'=>route('admin.user-management.role-info.list')]);
        } catch (\Exception $e) {
            DB::rollback();
            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = $e;
            }
            return response()->json(['status'=>'error','message'=>$e]);
        }
    }

    public function edit(Role $editData)
    {
        $data['editData'] = $editData;

        if (isApi()) {
            $response['status'] = 'success';
            $response['message'] = '';
            $response['api_info'] = $data;
        }
        return view('backend.user-management.role-info.add',$data);
    }

    public function update(Role $editData, Request $request)
    {

        $validator = Validator::make($request->all(), 
            [
                'name'     => ['required', 'unique:roles,name,'.$editData->id],
                'name_bn'     => ['required', 'unique:roles,name_bn,'.$editData->id]
            ]
        );

        if ($validator->fails()) {
            if (isApi()) {
                $response['validator']    = $validator;
                return response()->json($response);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $update = Role::find($editData->id);
            $update->name = $request->name;
            $update->name_bn = $request->name_bn;
            $update->description = $request->description;
            $update->mail_status = $request->mail_status;
            $update->status = $request->status;
            $update->save();

            // $params               = $request->all();
            // $params['updated_by'] = Auth::id();
            // $editData->update($params);
            DB::commit();

            if (isApi()) {
                $response['status'] = 'success';
                $response['message'] = Lang::get('Data Successfully Updated');
            }
            return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Updated'),'reload_url'=>route('admin.user-management.role-info.list')]);
        } catch (\Exception $e) {
            DB::rollback();
            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = $e;
            }
            return response()->json(['status'=>'error','message'=>$e]);
        }
    }
    
}
