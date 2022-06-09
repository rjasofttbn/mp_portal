<?php

namespace App\Http\Controllers\Backend\AccommodationAssetManagement\Setup;

use Illuminate\Http\Request;
use App\Http\Requests\AccommodationAssetPackagRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Model\AccommodationAsset;
use App\Model\AccommodationAssetPackage;
use App\model\AccommodationAssetType;
use App\model\AccommodationType;
use App\model\FlatType;
use App\User;
use App\Model\MpPs;
use App\Model\Profile;

use Auth;


use Illuminate\Support\Facades\Validator;

class AccommodationAssetPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AccommodationAssetPackage::orderBy('id', 'desc')->get();
        $data = DB::table('accommodation_asset_packages As asp')
        ->join('accommodation_types As at', 'at.id', '=', 'asp.accommodation_type_id')
        ->join('flat_types As ft', 'ft.id', '=', 'asp.flat_type_id')
        ->join('accommodation_asset_types As ast', 'ast.id', '=', 'asp.accommodation_asset_type_id')
        ->join('accommodation_assets As ass', 'ass.id', '=', 'asp.accommodation_asset_id')
        ->select('asp.*', 'at.name_bn as at_bn', 'at.name as at_name', 'ast.name_bn as ast_bn', 'ast.name as ast_name', 'ft.name_bn as ft_name_bn','ass.name_bn as ass_name_bn')
        ->where('asp.deleted_at', '=', null)
        ->get();
        // dd(($data));
        return view('backend.accommodation-asset-management.setup.accommodation-asset-package.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new AccommodationAssetPackage();        
        $acc_type_list = AccommodationType::orderBy('name', 'asc')->get();
        $flat_type_list = FlatType::orderBy('name', 'asc')->get();
        $acc_ass_type_list = AccommodationAssetType::orderBy('name', 'asc')->get();
        $acc_ass_list = AccommodationAsset::orderBy('name', 'asc')->get();
        // dd($acc_type_list);
        return view('backend.accommodation-asset-management.setup.accommodation-asset-package.create', compact('data','acc_type_list','acc_ass_type_list','flat_type_list','acc_ass_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // validation
     $rules = [
        'accommodation_type_id' => 'required',
        'flat_type_id' => 'required',
    ];
    $message = [
        'accommodation_type_id.required' => 'Accommodation type field is required.',
        'flat_type_id.required' => 'Flat type field is required.',
    ];
    $validator = Validator::make($request->all(), $rules, $message);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
        try {
            extract($_REQUEST);
            $allData = [];
            $data['accommodation_type_id'] = $request['accommodation_type_id'];
            $data['flat_type_id'] = $request['flat_type_id'];
            $k=0;

        foreach($request['accommodation_asset_type_id'] as $k=>$value){
            $allData[] =  $data;            
            $ff = count($request['accommodation_asset_id']);

        for ($i = 0; $i < $ff; $i++) {
            $data['accommodation_asset_type_id'] = $value;

            $data['accommodation_asset_type_id'] = $request['accommodation_asset_type_id'][$k];
            $data['accommodation_asset_id'] = $request['accommodation_asset_id'][$k];
            $data['total_no'] = $request['total_no'][$k];
            $data['created_by'] = authInfo()['id'];
        }
        $result= AccommodationAssetPackage::insert($data);
      }

        if($result){
        DB::commit();
        return redirect()->route('admin.accommodation-asset-management.setup.accommodation-asset-package.index')->with('success','Flat added successfully');
        }else{
            return redirect()->route('admin.accommodation-asset-management.setup.accommodation-asset-package.create')->with('error','Data does not save successfully')->withInput();
        }

        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = AccommodationAssetPackage::findOrFail($id);
        $acc_type_list = AccommodationType::orderBy('name', 'asc')->get();
        $flat_type_list = FlatType::orderBy('name', 'asc')->get();
        $acc_ass_type_list = AccommodationAssetType::orderBy('name', 'asc')->get();
        $acc_ass = AccommodationAsset::orderBy('name', 'asc')->get();
        return view('backend.accommodation-asset-management.setup.accommodation-asset-package.edit', compact('data', 'acc_type_list', 'acc_ass_type_list', 'flat_type_list', 'acc_ass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
       // validation
       $rules = [
        'accommodation_type_id' => 'required',
        'flat_type_id' => 'required',
    ];
    $message = [
        'accommodation_type_id.required' => 'The accommodation type field is required.',
        'flat_type_id.required' => 'The flat type field is required.',
    ];
    $validator = Validator::make($request->all(), $rules, $message);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    DB::beginTransaction();
    // dd($request);
    try {

        $acc_ass_pac = AccommodationAssetPackage::find($id);
        $data = $request->all();
        $result = $acc_ass_pac->update($data);

        if($result){
            DB::commit();
            return redirect()->route('admin.accommodation-asset-management.setup.accommodation-asset-package.index')->with('success','Flat added successfully');
            }else{
                return redirect()->route('admin.accommodation-asset-management.setup.accommodation-asset-package.index')->with('error','Data does not save successfully')->withInput();
            }
    
         
        // if ($result) {
        //     DB::commit();
        //     return response()->json(['status' => 'success', 'message' => \Lang::get('Data Saved successfully')]);
        // } else {
        //     return response()->json(['status' => 'error', 'message' => \Lang::get('Data Successfully not Insert_Insert')]);
        // }
    } catch (\Exception $e) {
        DB::rollback();
        $errorMessage = $e->getMessage();
        $customMessage = "Exception! Something went wrong please try again!";

        \Session::flash('error', $errorMessage, true);
        return redirect()->back()->withInput(); //If you want to go back
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $building = FurnitureElectronicGood::find($id);
            $building->delete();
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }
}
