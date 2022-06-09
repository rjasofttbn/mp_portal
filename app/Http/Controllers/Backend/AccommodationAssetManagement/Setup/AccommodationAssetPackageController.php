<?php

namespace App\Http\Controllers\Backend\AccommodationAssetManagement\Setup;

use Illuminate\Http\Request;
use App\Http\Requests\AccommodationAssetPackagRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Model\AccommodationAsset;
use App\Model\AccommodationAssetPackage;
use App\Model\AccommodationAssetType;
use App\Model\AccommodationType;
use App\Model\FlatType;
use App\User;
use App\Model\MpPs;
use App\Model\Profile;

use Illuminate\Support\Facades\Validator;
use Auth;

class AccommodationAssetPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $data['acc_ass_pack'] = AccommodationAssetPackage::orderBy('id', 'desc')->get();
        // dd($data);
        $data['acc_type_list'] = AccommodationType::orderBy('id', 'asc')->get();
        $data['flat_type_list'] = FlatType::orderBy('id', 'asc')->get();
        
        $data['acc_ass_type_list'] = AccommodationAssetType::orderBy('id', 'asc')->get();
        $data['acc_ass_list'] = AccommodationAsset::orderBy('id', 'asc')->get();
       
        return view('backend.accommodation-asset-management.setup.accommodation-asset-package.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
        $data['accommodation_asset_packages'] = AccommodationAssetPackage::orderBy('id', 'asc')->get();
        $acc_type_list = AccommodationType::orderBy('name', 'asc')->get();
        $flat_type_list = FlatType::orderBy('name', 'asc')->get();
        $acc_ass_type_list = AccommodationAssetType::orderBy('name', 'asc')->get();
        $acc_ass = AccommodationAsset::orderBy('name', 'asc')->get();
        // dd($acc_type_list);
        return view('backend.accommodation-asset-management.setup.accommodation-asset-package.form', compact('data','acc_type_list','acc_ass_type_list','flat_type_list','acc_ass'));
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
        'accommodation_asset_type_id' => 'required',
        'accommodation_asset_id' => 'required',
        'total_no' => 'required'
    ];
    $message = [
        'accommodation_type_id.required' => 'Accommodation type field is required.',
        'accommodation_asset_type_id.required' => 'Accommodation asset type field is required.',
        'accommodation_asset_id.required' => 'Accommodation asset field is required.',
        'total_no.required' => 'Total No field is required.'
    ];
    
    $validator = Validator::make($request->all(), $rules, $message);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
// dd($request);
        // Database Insert
        // $accommodation_asset_type_id = json_encode($request->input('accommodation_asset_type_id'));
        // $accommodation_asset_id = json_encode($request->input('accommodation_asset_id'));
        $accommodation_asset_type_id = json_encode($request->input('accommodation_asset_type_id'));
        $accommodation_asset_id = json_encode($request->input('accommodation_asset_id'));
        $total_no = json_encode($request->input('total_no'));

        DB::beginTransaction();
        try {
            $accass= new AccommodationAssetPackage();
            $request['accommodation_type_id'] = $request['accommodation_type_id'];
            $request['flat_type_id'] = $request['flat_type_id'];
            $request['accommodation_asset_type_id'] = $accommodation_asset_type_id;
            $request['accommodation_asset_type_id'] = $accommodation_asset_type_id;
            $request['accommodation_asset_id'] = $accommodation_asset_id;
            $request['total_no'] = $total_no;
            $accass->fill($request->all());
            $result = $accass->save();

            if($result){
                DB::commit();
                return redirect()->route('admin.accommodation-asset-management.setup.accommodation-asset-package.index')->with('success','Data Saved successfully');
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
        $data['editData'] = AccommodationAssetPackage::find($id);

        $data['acc_type_list'] = AccommodationType::orderBy('id', 'asc')->get();
        $data['flat_type_list'] = FlatType::orderBy('id', 'asc')->get();
        
        $data['acc_ass_type_list'] = AccommodationAssetType::orderBy('id', 'asc')->get();
        $data['acc_ass'] = AccommodationAsset::orderBy('id', 'asc')->get();

        $data['accommodation_asset_type_id'] = json_decode($data['editData']['accommodation_asset_type_id'], true);
        $data['accommodation_asset_id'] = json_decode($data['editData']['accommodation_asset_id'], true);
        $data['total_no'] = json_decode($data['editData']['total_no'], true);

        return view('backend.accommodation-asset-management.setup.accommodation-asset-package.form', $data);
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
    //   dd($request)  ;
         // validation
     $rules = [
        'accommodation_type_id' => 'required'
        
    ];
    $message = [
        'accommodation_type_id.required' => 'Accommodation type field is required.'
    ];
    $validator = Validator::make($request->all(), $rules, $message);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $accommodation_asset_type_id = array_filter($request->input('accommodation_asset_type_id'));
    $accommodation_asset_id = array_map('strval',$request->input('accommodation_asset_id'));
    $total_no = array_map('strval',$request->input('total_no'));
  dd($accommodation_asset_type_id)  ;

    $accommodation_asset_type_id = json_encode($accommodation_asset_type_id);
    $accommodation_asset_id = json_encode($accommodation_asset_id);
    $total_no = json_encode($total_no);
//   
        DB::beginTransaction();
        try {
            $aa_pack = AccommodationAssetPackage::find($id);
            $request['accommodation_type_id'] = $request['accommodation_type_id'];
            $request['flat_type_id'] = $request['flat_type_id'];
            $request['accommodation_asset_type_id'] = $accommodation_asset_type_id;
            $request['accommodation_asset_type_id'] = $accommodation_asset_type_id;
            $request['accommodation_asset_id'] = $accommodation_asset_id;
            $request['total_no'] = $total_no;
            
            $aa_pack->fill($request->all());
            $result = $aa_pack->update();

            if ($result) {
                DB::commit();
                return redirect()->route('admin.accommodation-asset-management.setup.accommodation-asset-package.index')->with('success', 'Data update successfully');
            } else {
                return redirect()->route('admin.accommodation-asset-management.setup.accommodation-asset-package.edit',$id)->with('error', 'Data does not update successfully')->withInput();
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
            $accpack = AccommodationAssetPackage::find($id);
            $accpack->delete();

            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }
}
