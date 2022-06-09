<?php

namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\HostelBuilding;
use App\Model\OfficeRoom;
use App\Model\Area;
use App\Http\Requests\HostelFloorRequest;
use App\Model\Floor;
use App\Model\HostelFloor;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB as FacadesDB;


class HostelFloorController extends Controller
{
    public function index()
    {
        // $data = HostelFloor::orderBy('id', 'desc')->get();

        $data =  DB::select("SELECT hf.id, hf.status, hf.name as hf_name_en, hf.name_bn as hf_name_bn, hb.name, hb.name_bn FROM hostel_floors  hf
        LEFT JOIN hostel_buildings hb on hb.id = hf.building_id");

        // dd($data); SELECT hf.id, hf.name as hf_name_en, hf.name_bn as hf_name_bn, hb.name, hb.name_bn FROM hostel_floors  hf
        // LEFT JOIN hostel_buildings hb on hb.id = hf.building_id
// dd($data);

        return view('backend.accommodation-management.setup.hostel-floor.index', compact('data'));
    }

    public function create()
    {
        $title="Create";
        $data = new OfficeRoom();
        $hostelBuildingList = HostelBuilding::orderBy('name', 'asc')->get();
        return view('backend.accommodation-management.setup.hostel-floor.create', compact('data','hostelBuildingList'));
    }

    public function store(Request $request) {

       $created_by = authInfo()->id;
     
     
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
                
                  
       try {

        DB::beginTransaction();
        $result = DB::table('hostel_floors')->insert(
        [
            "name" => $request['name'],
            "name_bn" => $request['name_bn'],           
            "building_id" => $request['building_id'],              
            "created_by" => "$created_by"
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
        $data['editData'] = HostelFloor::findOrFail($id);
        $hostelBuildingList = HostelBuilding::orderBy('name', 'asc')->get();
        // dd($data['editData']['building_id']);
       return view('backend.accommodation-management.setup.hostel-floor.edit', compact('data','hostelBuildingList'));
    }

    public function show()
    {
        //
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
            $result = DB::table('hostel_floors')
                ->where('id', $id)
                ->update(
                    [
                        "name" => "$name",
                        "name_bn" => "$name_bn",
                        "building_id" => "$building_id",
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
                
            // if($result){
            //     DB::commit();
            //     return redirect()->route('admin.accommodation-management.setup.hostel_floors.index')->with('success','Data Updated successfully');
            // }else{
            //     return redirect()->route('admin.accommodation-management.setup.hostel_floors.edit', [$id])->with('error','Data does not update successfully')->withInput();
            // }
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
            $result=DB::table('hostel_floors')->where('id', $id)->delete();
            if($result){
                return response()->json(["status"=>"success"]);
            }
        } catch (\Exception $e) {
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }
   
    

}
