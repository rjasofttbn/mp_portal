<?php

namespace App\Http\Controllers\Backend\Accommodation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HostelDepartmentController extends Controller
{



    public function application_monitoring()
    {

        
        

       

        return view('backend.accommodation.hostel_department.application_list');
    }









    public function hostel_approve_application(request $request)
    {
        $hostel_application_id = $request->id;
        $mp_id = $request->mpid;

        $mpdata = DB::table('profiles')
        ->join('constituencies', 'constituencies.id', '=', 'profiles.user_id')
        ->select('constituencies.name as constituencyname','profiles.name_eng as name')
        ->where('user_id',$mp_id)
        ->get();  

     

        
    
   

        $hostelBuildingList = DB::table('hostel_buildings')->get();
       
        return view('backend.accommodation.hostel_department.approve', compact('hostelBuildingList','mpdata', 'hostel_application_id'));
    }























    public function cancel_application_by_department(Request $request,$id)
    {

        $reason=$request->reason;

        try {
            
             $result = DB::table('hostel_applications')
                ->where('id', $id)
                ->update([
                    'status' => 2,
                    'cancel_reason_by_department' =>$reason
                    
                ]);

            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        } 
    }



    public function cancel_application_by_whip(Request $request,$id)
    {

        $reason=$request->reason;

        try {
            
             $result = DB::table('hostel_applications')
                ->where('id', $id)
                ->update([
                    'status' => 2,
                    'cancel_reason_by_whip' =>$reason
                    
                ]);

            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        } 
    }


   



}
