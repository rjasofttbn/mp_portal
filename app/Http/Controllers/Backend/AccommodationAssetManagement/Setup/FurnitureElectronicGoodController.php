<?php

namespace App\Http\Controllers\Backend\AccommodationAssetManagement\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccommodationBuilding;
use App\Model\AccommodationAssetType;
use App\Model\AccommodationAsset;
use App\Model\AccommodationType;
use App\Model\Area;
use App\Model\FurnitureElectronicGood;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class FurnitureElectronicGoodController extends Controller
{
  public function index(Request $request)
  {
  $where_array = [];
  if($request->accommodation_type_id){
    $where_array[] = ['accommodation_type_id','=',$request->accommodation_type_id];
  }
  if($request->accommodation_building_id){
    $where_array[] = ['accommodation_building_id','=',$request->accommodation_building_id];
  }
  if($request->accommodation_asset_type_id){
    $where_array[] = ['accommodation_asset_type_id','=',$request->accommodation_asset_type_id];
  }
  if($request->accommodation_asset_id){
    $where_array[] = ['accommodation_asset_id','=',$request->accommodation_asset_id];
  }
  $data['furniture_electronic_goods'] = FurnitureElectronicGood::with(['area','accommodation_type','accommodation_building','accommodation_asset_type','accommodation_asset'])->where($where_array)->get();


    $data['acc_type_list'] = AccommodationType::orderBy('name', 'asc')->get();
// dd($data['acc_type_list']);
    $data['acc_ass_type_list'] = AccommodationAssetType::orderBy('name', 'asc')->get();

    $data['acc_buil_list'] = AccommodationBuilding::orderBy('name', 'asc')->get();
    $data['acc_ass'] = AccommodationAsset::orderBy('name', 'asc')->get();
// dd($data);
    return view('backend.accommodation-asset-management.setup.furniture-electronic-goods.index', $data);
  }

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
  $area_list = Area::orderBy('name', 'asc')->get();
  $acc_type_list = AccommodationType::orderBy('name', 'asc')->get();
  $acc_ass_type_list = AccommodationAssetType::orderBy('name', 'asc')->get();
  $acc_buil_list = AccommodationBuilding::orderBy('name', 'asc')->get();
  $acc_ass = AccommodationAsset::orderBy('name', 'asc')->get();
// dd($data);
  return view('backend.accommodation-asset-management.setup.furniture-electronic-goods.create', compact('area_list',  'acc_buil_list', 'acc_ass','acc_ass_type_list','acc_type_list'));
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{

// $area_id = $request->input('area_id');
// $accommodation_type_id = $request->input('accommodation_type_id');
// $accommodation_building_id = $request->input('accommodation_building_id');
// $accommodation_asset_type_id= $request->input('accommodation_asset_type_id');

// validation
  $rules = [
    'accommodation_type_id' => 'required',
    // 'accommodation_building_id' => 'required',
  ];
  $message = [
    'accommodation_type_id.required' => 'The accommodation type field is required.',
    // 'accommodation_building_id.required' => 'The accommodation building field is required.',
  ];
  $validator = Validator::make($request->all(), $rules, $message);
  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
  }
  DB::beginTransaction();
  try {
    extract($_REQUEST);
    $allData = [];
    $data['area_id'] = $request['area_id'];
    $data['accommodation_type_id'] = $request['accommodation_type_id'];
    // dd($request);
    if($request['accommodation_building_id'] != ''){
      $data['accommodation_building_id'] = $request['accommodation_building_id'];
    }
    
    $k=0;

    foreach($request['accommodation_asset_type_id'] as $k=>$value){
      $allData[] =  $data;            
      $ff = count($request['accommodation_asset_id']);

      for ($i = 0; $i < $ff; $i++) {
        $data['accommodation_asset_type_id'] = $value;
        $data['created_by'] = authInfo()['id'];
        $data['accommodation_asset_id'] = $request['accommodation_asset_id'][$k];
        $data['total_no'] = $request['total_no'][$k];
      }
      $result= FurnitureElectronicGood::insert($data);
    }
    if($result) {
      DB::commit();
      return redirect()->route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index')->with('success','Data successfully')->withInput(); 
    } else {
      return redirect()->route('admin.accommodation-asset-management.setup.furniture_electronic_goods.create')->with('error', 'Data does not save successfully')->withInput();
    }

  } catch (\Exception $e) {
    DB::rollback();
    $errorMessage = $e->getMessage();
    $customMessage = "Exception! Something went wrong please try again!";

    \Session::flash('error', $errorMessage, true);
return redirect()->back()->withInput(); //If you want to go back
}
}

public function findTotal(Request $request)
{
// dd($request->all());
 // no needed this function
  $where_array = [];
  if($request->accommodation_type_id){
    $where_array[] = ['accommodation_type_id','=',$request->accommodation_type_id];
  }
  if($request->accommodation_building_id){
    $where_array[] = ['accommodation_building_id','=',$request->accommodation_building_id];
  }
  if($request->accommodation_asset_type_id){
    $where_array[] = ['accommodation_asset_type_id','=',$request->accommodation_asset_type_id];
  }
  if($request->accommodation_asset_id){
    $where_array[] = ['accommodation_asset_id','=',$request->accommodation_asset_id];
  }
  $data['furniture_electronic_goods'] = FurnitureElectronicGood::with(['area','accommodation_type','accommodation_building','accommodation_asset_type','accommodation_asset'])->where($where_array)->get();

  return view('backend.accommodation-asset-management.setup.furniture-electronic-goods.find-total', $data);
}


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
  $area_list = Area::orderBy('name', 'asc')->get();
  $acc_type_list = AccommodationType::orderBy('name', 'asc')->get();
  $acc_ass_type_list = AccommodationAssetType::orderBy('name', 'asc')->get();
  $acc_buil_list = AccommodationBuilding::orderBy('name', 'asc')->get();
  $acc_ass = AccommodationAsset::orderBy('name', 'asc')->get();
  $data = FurnitureElectronicGood::findOrFail($id);
// dd($data);
  return view('backend.accommodation-asset-management.setup.furniture-electronic-goods.edit', compact('area_list', 'data', 'acc_type_list', 'acc_ass_type_list', 'acc_buil_list', 'acc_ass'));
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
    'accommodation_building_id' => 'required',
  ];
  $message = [
    'accommodation_type_id.required' => 'The accommodation type field is required.',
    'accommodation_building_id.required' => 'The accommodation building field is required.',
  ];
  $validator = Validator::make($request->all(), $rules, $message);
  if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
  }
  DB::beginTransaction();
  try {

    $fur_ele_god = FurnitureElectronicGood::find($id);
    $data = $request->all();
// $data['status']= $request->status ?? 0;
    $result = $fur_ele_god->update($data);
    if ($result) {
      DB::commit();
      return response()->json(['status' => 'success', 'message' => \Lang::get('Data Saved successfully')]);
    } else {
      return response()->json(['status' => 'error', 'message' => \Lang::get('Data Successfully not Insert_Insert')]);
    }
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
