<?php

namespace App\Http\Controllers\Backend\Accommodation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HostelWhipController extends Controller
{
    
    public function whip_application_monitoring()
    {        


        return view('backend.accommodation.whip_hostel.application_list');
    }



    public function approve_application_by_whip(Request $request,$id)
    {


        $officeroomid=$request->officeroomid;
         //hostel department application id
         $departmentapplicationid=$id;
       

        try {
            
           

            $result = DB::table('office_rooms')
            ->where('id', $officeroomid)
            ->update([
                'status_id' => 16
               
                
            ]);
         

            DB::table('hostel_whip_applications')->insert([
                'application_id' => $departmentapplicationid,
                'approval_type' => 1,
                'status_id' => 12,
                'created_by' => authInfo()->id


            ]);

            DB::table('hostel_department_applications')
          ->where('id', $departmentapplicationid)
          ->update([
          
          'status_id'=> 12
          
          
          
          ]);

        //get application id
            $applicationid = DB::table('hostel_department_applications')->where('id',$departmentapplicationid)->value('application_id');
  

            DB::table('hostel_applications')
          ->where('id', $applicationid)
          ->update([
          
          'status'=> 12,          
          
          ]);

            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return response()->json(["status"=>$errorMessage]);
        } 
    }






    public function whip_edit_application(request $request)
    {
        $hostel_application_id = $request->id;
        $mp_id = $request->mpid;

        $mpdata = DB::table('profiles')
        ->join('constituencies', 'constituencies.id', '=', 'profiles.user_id')
        ->select('constituencies.name as constituencyname','profiles.name_eng as name')
        ->where('user_id',$mp_id)
        ->get();  

     

        
    
   

        $hostelBuildingList = DB::table('hostel_buildings')->get();
        $proposedHostelBuildingId = DB::table('office_rooms')->where('user_id',$mp_id)->value('building_id');

       
        return view('backend.accommodation.whip_hostel.edit', compact('hostelBuildingList','mpdata', 'hostel_application_id','proposedHostelBuildingId'));
    }


    





}
