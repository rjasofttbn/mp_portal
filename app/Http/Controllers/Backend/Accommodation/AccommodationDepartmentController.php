<?php

namespace App\Http\Controllers\Backend\Accommodation;

use App\AccommodationApplication as AppAccommodationApplication;
use App\Model\Profile;

use App\Model\AccommodationDepartmentApplication;
use Redirect;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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


class AccommodationDepartmentController extends Controller
{
    use BengaliLibraryTrait;


    public function dashboardInfo()
    {
      
      
        
        $totalPending = DB::table('accommodation_applications')->Where('status',1)->count();
        $totalPendingBn=$this->en2bnNumber($totalPending );
        $totalApproved = DB::table('accommodation_applications')->Where('status',5)->count();
        $totalApprovedBn=$this->en2bnNumber($totalApproved);
        $totalRejected = DB::table('accommodation_applications')->Where('status',2)->count();
        $totalRejectedBn=$this->en2bnNumber($totalRejected);



        return view('backend.accommodation.department.dashboard', compact('totalPending', 'totalApproved', 'totalRejected','totalPendingBn', 'totalApprovedBn', 'totalRejectedBn'));
    }


    public function application_monitoring()
    {
        $data['accommodation_application_types'] = AccommodationApplicationType::all();
        return view('backend.accommodation.department.application_list', $data);
    }

    public function applicationMonitoringData(Request $request)
    {
        $where = [];
        if($request->accommodation_application_type_id){
        $where[] = ['application_type_id','=',$request->accommodation_application_type_id];

        }
        $data['accommodation_application_pendings'] = AccommodationApplication::where($where)->where('status',1)->orderBy('id', 'desc')->get();
        $data['accommodation_application_approves'] = AccommodationApplication::where($where)->whereIn('status',[2,4,5])->orderBy('id', 'desc')->get();
        $data['accommodation_application_rejects']  = AccommodationApplication::where($where)->where('status',3)->orderBy('id', 'desc')->get();
        return view('backend.accommodation.department.application_list_data', $data);
    }
    public function applicationMonitoringDataForWhipApprove(Request $request){
        $update = AccommodationApplication::find($request->id);
        $update->status = 4;
        $update->save();
        return response()->json(['status'=>'success','reload_url'=>url('admin/accommodation/applications/application/whip_application_monitoring')]);
    }

    public function applicationMonitoringDataReject(Request $request){
        $update = AccommodationApplication::find($request->id);
        $update->status = $request->status;
        $update->save();
        if($request->status == 3){
            return response()->json(['status'=>'success','reload_url'=>url('admin/accommodation/applications/application/application_monitoring')]);
        }else{
            return response()->json(['status'=>'success','reload_url'=>url('admin/accommodation/applications/application/whip_application_monitoring')]);
        }
    }

    public function applicationMonitoringDataForWhip(Request $request)
    {
        $where = [];
        if($request->accommodation_application_type_id){
        $where[] = ['application_type_id','=',$request->accommodation_application_type_id];

        }
        $data['accommodation_application_pendings'] = AccommodationApplication::where($where)->where('status',2)->orderBy('id', 'desc')->get();
        $data['accommodation_application_approves'] = AccommodationApplication::where($where)->where('status',4)->orderBy('id', 'desc')->get();
        $data['accommodation_application_rejects']  = AccommodationApplication::where($where)->where('status',5)->orderBy('id', 'desc')->get();
        return view('backend.accommodation.whip.application_list_data', $data);
    }


    public function whip_application_monitoring()
    {
        return view('backend.accommodation.whip.application_list');
    }




    public function flat_approve_application($id)
    {
        // $accommodation_application_id = $request->id;
        // $mp_id = $request->mpid;

        // $mpdata = DB::table('profiles')
        // ->join('constituencies', 'constituencies.id', '=', 'profiles.user_id')
        // ->select('constituencies.name as constituencyname','constituencies.bn_name as constituencyname_bn','profiles.name_eng as name','profiles.name_bn as name_bn')
        // ->where('user_id',$mp_id)
        // ->get();  

        $data['accommodation_application'] = AccommodationApplication::where('id',$id)->first();
        // dd($data['accommodation_application']->toArray());
        $data['areas'] = Area::orderBy('name', 'asc')->get();
        return view('backend.accommodation.department.approve_application', $data);
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



    public function cancelApplicationByDepartment(Request $request,$id)
    {

        $reason=$request->reason;

        try {
            
                 DB::table('accommodation_applications')
                ->where('id', $id)
                ->update([
                    'status' => 2,
                    
                ]);

                DB::table('accommodation_department_applications')
                ->insert([
                  'application_id' => $id,
                  'status'=> 2,
                  'created_by'=> authInfo()->id,
                  'cancel_reason' =>$reason
            
                ]);


             

            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        } 
    }



    public function approve_application_by_whip(Request $request,$id)
    {


        $flatid=$request->flatid;

       

        try {
            
             $result = DB::table('accommodation_applications')
                ->where('id', $id)
                ->update([
                    'status' => 5
                   
                    
                ]);


                DB::table('flats')
              ->where('id', $flatid)
              ->update([
              
              'apply_status'=> 2,
              'is_available'=> 0
              
              
              
              
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
