<?php

namespace App\Http\Controllers\Backend\AccommodationAssetManagement\Setup;


use Illuminate\Http\Request;
use App\Http\Requests\AccommodationAssetRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Model\AccommodationAsset;
use App\Model\AccommodationAssetType;
use App\Model\AccommodationType;
use App\User;
use App\Model\MpPs;
use App\Model\Profile;

use Auth;


use Illuminate\Support\Facades\Validator;

class AccommodationAssetController extends Controller
{

    public function index()
    {
        $data = AccommodationAsset::orderBy('id', 'desc')->get();
        $data = DB::table('accommodation_assets As ass')
        ->join('accommodation_types As at', 'at.id', '=', 'ass.accommodation_type_id')
        ->join('accommodation_asset_types As ast', 'ast.id', '=', 'ass.accommodation_asset_type_id')
        ->select('ass.*', 'at.name_bn as at_bn', 'at.name as at_name', 'ast.name_bn as ast_bn', 'ast.name as ast_name')
        ->get();
        return view('backend.accommodation-asset-management.setup.accommodation-assets.index', compact('data'));
    }


    public function create()
    {
      
        $data = new AccommodationAsset();        
        $acc_type_list = AccommodationType::orderBy('name', 'asc')->get();
        $acc_ass_type_list = AccommodationAssetType::orderBy('name', 'asc')->get();
        return view('backend.accommodation-asset-management.setup.accommodation-assets.form', compact('data','acc_type_list','acc_ass_type_list'));
    }

 
    public function store(Request $request)
    {
         // validation
     $rules = [
        'name' => 'required',
        'name_bn' => 'required',
    ];
    $message = [
        'name.required' => 'The name english field is required.',
        'name_bn.required' => 'The name bangla field is required.',
    ];
    $validator = Validator::make($request->all(), $rules, $message);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    DB::beginTransaction();
        try {
            extract($_REQUEST);
            $result=DB::table('accommodation_assets')->insert(
        [
        "name" =>"$name", 
        "name_bn" =>"$name_bn", 
        "accommodation_type_id" =>"$accommodation_type_id", 
        "accommodation_asset_type_id" =>"$accommodation_asset_type_id", 
        "created_by"=>authInfo()['id'],
        ]
    );
    if($result){
        DB::commit();
        return response()->json(['status'=>'success','message'=>\Lang::get('Data Saved successfully')]);
    }else{
        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert_Insert')]);
    }

        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }


    public function edit($id)
    {
        $data=AccommodationAsset::findOrFail($id);
        $acc_type_list = AccommodationType::orderBy('name', 'asc')->get();
        $acc_ass_type_list = AccommodationAssetType::orderBy('name', 'asc')->get();
       return view('backend.accommodation-asset-management.setup.accommodation-assets.form', compact('data','acc_ass_type_list','acc_type_list'));

    }

    public function update(Request $request, $id) {

            $created_by = authInfo()->id;
            $id = $request['id'];
              // validation
            $rules = [
                'name' => 'required',
                'name_bn' => 'required',
            ];
            $message = [
                'name.required' => 'The name english field is required.',
                'name_bn.required' => 'The name bangla field is required.',
            ];
            $validator = Validator::make($request->all(), $rules, $message);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
                DB::beginTransaction();
                try {   
                    $status = $request->status ?? 0;
                    extract($_REQUEST);
                    $result = DB::table('accommodation_assets')
                        ->where('id', $id)
                        ->update(
                            [
                                "name" => "$name",
                                "name_bn" => "$name_bn",
                                "accommodation_type_id" => "$accommodation_type_id",
                                "accommodation_asset_type_id" => "$accommodation_asset_type_id",
                                "updated_by" => "$created_by",
                                "status" => "$status"
                            ]
                        );
                        if($result){
                            DB::commit();
                            return response()->json(['status'=>'success','message'=>\Lang::get('Data Saved successfully')]);
                        }else{
                            return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert_Insert')]);
                        }
      
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    public function destroy($id)
    {
        try {
            $accommodationasset = AccommodationAsset::find($id);

            $accommodationasset->delete();

            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }
}
