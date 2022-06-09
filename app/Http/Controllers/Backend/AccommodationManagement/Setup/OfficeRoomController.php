<?php

namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\HostelBuilding;
use App\Model\HostelFloor;
use App\Model\OfficeRoom;
use Auth;
use DB;
use App\Traits\BengaliLibraryTrait;
use Illuminate\Support\Facades\Validator;

class OfficeRoomController extends Controller
{
    use BengaliLibraryTrait;


    public function index()
    {
       
        $data = DB::select("SELECT hf.id as hf_id, hb.id as hb_id,hb.name_bn as hb_b_name, hf.name_bn as hf_b_name, hf.status as hf_status FROM hostel_floors hf LEFT JOIN hostel_buildings hb on hb.id = hf.building_id");
        // dd($data);
        //  HostelBuilding::orderBy('id')->get();
        // $data = HostelBuilding::orderBy('id')->get();
        $buildingList = DB::select("SELECT hf.id as hf_id, hb.id as hb_id,hb.name_bn as hb_b_name, hf.name_bn as hf_b_name, hf.status as hf_status FROM hostel_floors hf LEFT JOIN hostel_buildings hb on hb.id = hf.building_id");;

        // $buildingList = DB::table('hostel_buildings')->select('id')->whereNull('deleted_at')->get();
        
        $i=0;
        foreach($buildingList as $value) {
         // $totalOfficeRoom[$i] = DB::table('office_rooms')->get()->where('building_id', '=', $value->id)->whereNull('deleted_at')->count();

            $totalOfficeRoom[$i] = DB::table('office_rooms')->get()->where('hostel_floor_id', '=', $value->hf_id)->whereNull('deleted_at')->count();
            $i++;
        }
        return view('backend.accommodation-management.setup.office-room.index', compact('data','totalOfficeRoom'));
    }


    public function create()
    {
        
        $title="Create";
        $data = new OfficeRoom();
      
        $BuildingList = HostelBuilding::orderBy('name', 'asc')->get();
        $FloorList = HostelFloor::orderBy('name', 'asc')->get();
        return view('backend.accommodation-management.setup.office-room.form', compact('BuildingList','data','FloorList'));


    }

    public function store(Request $request) {
      
        $floorno= $request->input('floor_id');
        $startno= $request->input('startno');
        $totalofficeroom= $request->input('total_office_room');
        $building_id= $request->input('building_id');

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
                $officeroomnumber=array();
                $officeroomnumberbangla=array();
                $l=0;
                for($c=0;$c<count($floorno);$c++){
                for($i=0,$j=$startno[$c];$i<$totalofficeroom[$c];$i++,$j++){
                    $officeroomnumber[$l]=$j;
                    $officeroomnumberbangla[$i]= $this->en2bnNumber($officeroomnumber[$l]);           
                    $officeroom = new OfficeRoom();
                    $officeroom->number = $officeroomnumber[$l];
                    if(OfficeRoom::where('number','=',$officeroomnumber[$l])->where('hostel_floor_id','=',$floorno[$c])->exists()){
        
               return redirect()->route('admin.accommodation-management.setup.office_rooms.create')->with('error','Office Room Number already Exists!')->withInput();
                    }
                   
                    $officeroom->number_bn = $officeroomnumberbangla[$i];
                    $officeroom->status = 1;
                    $officeroom->hostel_floor_id = $floorno[$c];
                    $officeroom->building_id = $building_id;
                    $officeroom->created_by = Auth::id();
                    $result = $officeroom->save();
                    $l++; 
                }
            }  
                 if($result){
                 }else{
                    return redirect()->route('admin.accommodation-management.setup.office_rooms.create')->with('error','Data does not save successfully')->withInput();           
                 }            
             } catch (\Exception $e) {
                 $errorMessage=$e->getMessage();
                 $customMessage="Exception! Something went wrong please try again!";
     
                 \Session::flash('error', $errorMessage, true);
                 return redirect()->back()->withInput(); //If you want to go back
     } 
     if($result){
         return redirect()->route('admin.accommodation-management.setup.office_rooms.index')->with('success','Data added successfully');
         }
    }


   
    public function edit($id)
    {
       
        $data=HostelBuilding::findOrFail($id);
        
        $floorList = OfficeRoom::orderBy('id', 'asc')->where('building_id',$id)->get()->unique('hostel_floor_id');
        $total_office_room=array();
        $i=0;
        $j=0;

        $officeRoomStartNo=array();
        $floorId=array();

        foreach($floorList as $value){
            $floorNo[]=HostelFloor::where('id',$value->hostel_floor_id)->value('name');
            $floorId[]=$value->hostel_floor_id;
            $total_office_room[$i++] = OfficeRoom::where('building_id',$id)->where('hostel_floor_id',$value->hostel_floor_id)->count();
            $officeRoomStartNo[$j++] = OfficeRoom::where('building_id',$id)->where('hostel_floor_id',$value->hostel_floor_id)->min('number');
        }
       
       return view('backend.accommodation-management.setup.office-room.update', compact('data','floorNo','total_office_room','officeRoomStartNo','floorId'));
        // $data=HostelBuilding::findOrFail($id);
    //    return view('backend.accommodation-management.setup.office-room.form', compact('data')); 

    }



    public function update(request $request, $id) {
 
            $result=DB::table('office_rooms')->where('building_id', $id)->delete();
            $floorno= $request->input('floor_id');

            $startno= $request->input('startno');
            $totalflat= $request->input('total_office_room');

            $flatnumber=array();
            $flatnumberbangla=array();
            $l=0;
                
            for($c=0;$c<count($floorno);$c++){
            for( $i=0, $j=$startno[$c]; $i<$totalflat[$c]; $i++, $j++ ){
                                    
                $flatnumber[$l]=$j;
                $flatnumberbangla[$i]= $this->en2bnNumber($flatnumber[$l]);           
                $flat = new OfficeRoom();
                $flat->number = $flatnumber[$l];
                $flat->number_bn = $flatnumberbangla[$i];
                $flat->status = 1;
                $flat->hostel_floor_id = $floorno[$c];
                $flat->building_id = $id;
                $flat->updated_by = Auth::id();
                $result = $flat->save();
                $l++;   
                
                try {
                    if($result){
                    }else{
                    return redirect()->route('admin.accommodation-management.setup.office_rooms.edit', [$id])->with('error','Data does not updated successfully')->withInput();           

                    }            
                
                } catch (\Exception $e) {
                    $errorMessage=$e->getMessage();
                    $customMessage="Exception! Something went wrong please try again!";

                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
            }       
            } 
            if($result){
            return redirect()->route('admin.accommodation-management.setup.office_rooms.index')->with('success','Data Updated successfully');

            }
    }



    public function destroy($id)
    {
        try {
            $result=DB::table('office_rooms')->where('building_id', $id)->delete();
            if($result){
                return response()->json(["status"=>"Office Room Delete Successfully"]);
            }
        } catch (\Exception $e) {
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }
    
    }



