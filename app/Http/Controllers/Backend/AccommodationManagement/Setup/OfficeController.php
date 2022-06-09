<?php

namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use App\Model\HostelBuilding;
use App\Model\HostelFloor;
use App\Model\OfficeRoom;
use App\Model\OfficeRoomType;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::select("
        SELECT ofr.id, ofr.number as ofr_number, oft.name_bn as oft_name_bn, ofr.status as ofr_status, ofr.number_bn as ofr_number_bn, hb.name_bn as hb_b_name, hf.name_bn as hf_b_name FROM office_rooms ofr LEFT JOIN hostel_buildings hb on hb.id = ofr.building_id LEFT JOIN hostel_floors hf on hf.id = ofr.hostel_floor_id LEFT JOIN office_room_types oft on oft.id = ofr.office_room_type_id");
     
        return view('backend.accommodation-management.setup.office.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Create";
        $BuildingList = HostelBuilding::orderBy('name', 'asc')->get();
        $FloorList = HostelFloor::orderBy('name', 'asc')->get();
        $officeRoomList = OfficeRoom::orderBy('number_bn', 'asc')->get();
        $offType = OfficeRoomType::orderBy('name', 'asc')->get();
        // dd($officeRoomList['office_room_type_id']);
        // $assigned= DB::select("SELECT id,office_room_type_id  FROM office_rooms WHERE office_room_type_id !=''");
        
        return view('backend.accommodation-management.setup.office.form', compact('BuildingList','FloorList','officeRoomList','offType',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'building_id' => 'required',
            'floor_id' => 'required',
        ];
        $message = [
            'building_id.required' => 'The Building field is required.',
            'floor_id.required' => 'The Floor field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
        
        try {
            $data = $request->select_office;
            $office_room_type_id= $request->office_room_type_id;
            foreach($data as $id){
            $result=DB::table('office_rooms')
              ->where('id', $id)
              ->update(['office_room_type_id' => $office_room_type_id[0]]);
            }

            if($result){
                return redirect()->route('admin.accommodation-management.setup.office.index')->with('success','Data Updated successfully');
            }else{
                return redirect()->route('admin.accommodation-management.setup.office.create')->with('error','Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
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
        $data=OfficeRoom::findOrFail($id);
        $offType = OfficeRoomType::orderBy('name', 'asc')->get();
        
        $building_Id=$data->building_id;
        $data['building_name'] =HostelBuilding::where('id',$data->building_id)->value('name_bn');
        $data['floor_name'] =HostelFloor::where('id',$data->hostel_floor_id)->value('name_bn');
        $data['office_number'] =OfficeRoom::where('id',$data->id)->value('number_bn');
        $data['offType'] =OfficeRoomType::where('id',$data->office_room_type_id)->value('name_bn');
        return view('backend.accommodation-management.setup.office.edit', compact('data','offType'));
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
        $rules = [
            'office_type_id' => 'required',
        ];
        $message = [
            'office_type_id.required' => 'The office type field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
        try {
            $office_room_type_id= $request['office_type_id'];
            $result=DB::table('office_rooms')
              ->where('id', $id)
              ->update(['office_room_type_id' => $office_room_type_id]);

            if($result){
                return redirect()->route('admin.accommodation-management.setup.office.index')->with('success','Office Updated successfully');
            }else{
                return redirect()->route('admin.accommodation-management.setup.office.edit', [$id])->with('error','Office does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
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
        //
    }
}
