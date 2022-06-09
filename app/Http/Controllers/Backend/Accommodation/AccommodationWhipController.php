<?php

namespace App\Http\Controllers\backend\Accommodation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AccommodationApplication as AppAccommodationApplication;
use App\Model\Profile;

use App\Model\AccommodationDepartmentApplication;
use Redirect;



use Illuminate\Support\Facades\Auth;
use App\Model\AccommodationApplication;
use App\Model\MpActivitiesStatus;
use App\Model\AccommodationLog;
use App\Model\accommodationAllotment;
use App\Model\AccommodationApplicationType;

use Illuminate\Support\Facades\Validator;
use App\User;
use App\Model\MpPs;
use App\Model\Department;


use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Carbon;
use App\Model\Flat;
use App\Model\Area;
use App\Traits\BengaliLibraryTrait;


class AccommodationWhipController extends Controller
{
    
  

    public function whip_application_monitoring()
    {
        $data['accommodation_application_types'] = AccommodationApplicationType::all();
        return view('backend.accommodation.whip.application_list',$data);
    }




 


    public function whip_edit_application(request $request)
    {
        $accommodation_application_id = $request->id;
        $mp_id = $request->mpid;

        $mpdata = DB::table('profiles')
        ->join('constituencies', 'constituencies.id', '=', 'profiles.user_id')
        ->select('constituencies.name as constituencyname','profiles.name_eng as name')
        ->where('user_id',$mp_id)
        ->get();  

     

        
    
   

        $areaList = Area::orderBy('name', 'asc')->get();
        
         $proposedAreaId = DB::table('flats')->where('user_id',$mp_id)->value('area_id');
         $proposedBuildingId = DB::table('flats')->where('user_id',$mp_id)->value('building_id');
         $buildingData = DB::table('accommodation_buildings')->where('area_id',$proposedAreaId)->get();
       
        
    
    
        return view('backend.accommodation.whip.edit', compact('areaList','mpdata', 'accommodation_application_id','proposedAreaId','proposedBuildingId','buildingData'));
    }





    public function approve_application_by_whip(Request $request,$id)
    {


        $flatid=$request->flatid;
        //accommodation department application id
        $departmentapplicationid=$id;

       

        try {
            
             $result = DB::table('flats')
                ->where('id', $flatid)
                ->update([
                    'status_id' => 16
                   
                    
                ]);
             

                DB::table('accommodation_whip_applications')->insert([
                    'application_id' => $departmentapplicationid,
                    'approval_type' => 1,
                    'status_id' => 12,
                    'created_by' => authInfo()->id


                ]);

                DB::table('accommodation_department_applications')
              ->where('id', $departmentapplicationid)
              ->update([
              
              'status_id'=> 12
              
              
              
              ]);

            //get application id
                $applicationid = DB::table('accommodation_department_applications')->where('id',$departmentapplicationid)->value('application_id');
      

                DB::table('accommodation_applications')
              ->where('id', $applicationid)
              ->update([
              
              'status'=> 12,          
              
              ]);

              return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {
          
     
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return response()->json(["status"=>"error"]);
        } 
    }

    
    public function cancel_application_by_whip(Request $request,$id)
    {

        $reason=$request->reason;

        try {
            
             $result = DB::table('accommodation_applications')
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

   


    public function Whips_approval_application_list()
    {

        
        $data = AccommodationApplication::orderBy('id', 'desc')->where('status',1)->get();

       

        return view('backend.accommodation.whip.application_list', compact('data'));
    }





}
