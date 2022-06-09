<?php

namespace App\Http\Controllers\backend\accommodation;

// namespace App\Http\Controllers\PublicController;
// namespace App\Http\Utility;

  
use Auth;
use App\Traits\PublicTrait;
use App\Model\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\HostelApplicationType;
use App\Model\MpActivitiesStatus;
use App\Model\HostelApplication;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Model\MpPs;
use App\Model\Department;
use App\Model\HostelBuilding;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Carbon;
DB::enableQueryLog();
use PDF;


class HostelApplicationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = authInfo();
        $data['applicationTypes'] = HostelApplicationType::all();
        return view('backend.accommodation.hostel_application.index', $data, compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = authInfo();
        $user_id = authInfo()->id;
        if ($user->usertype == 'mp') {
            $whereMpUser = [
                'user_id' => $user->id,
            ];
        } elseif ($user->usertype == 'ps') {
            $whereMpUser = [
                'user_id' => $user['psMpInfo']['mp_user_id'],
            ];
        } else {
            $whereMpUser = '';
        }

        if ($whereMpUser) {
            $data['mpProfile'] = Profile::where($whereMpUser)->first();
        }
        $applicationType = $request->application_type_id;
        $datas = DB::select("select * from hostel_application_types WHERE id=$applicationType");
        $data['applicationType'] = (array) $datas;
        $applicationTypeId = $data['applicationType'][0]->id;
        // dd($applicationTypeName);
        $applicationTypesubject = $data['applicationType'][0]->subject;
        // dorp down data
        $res = PublicTrait::approveApp();
        
        $hostelBuildingList = DB::table('hostel_buildings')->get();

         

        //    return $applicationTypeId;
        /* =====================flat allotment start======================== */
        if ($applicationTypeId == '1') {
            // application list view
            $acc_app = DB::select("select * from hostel_applications WHERE application_from=$user_id");
            return view(
                'backend.accommodation.hostel_application.hostelAllotment.create',
                compact('data', 'acc_app', 'hostelBuildingList', 'applicationTypesubject', 'applicationType')
            );
            /* ======================flat cancel start====================== */
        } elseif ($applicationTypeId == '2') {
            //  validation
            
            // New Application
            $acc_app_check = DB::select("select * from hostel_applications WHERE application_from=$user_id and status = 5");
            // //  jouin query for approved applicaton of mp
            if (!empty($acc_app_check)) {
               
                $building_to_floor = DB::select("$res
                WHERE ha.application_from =$user_id AND ha.status = '5'");
                
            } else {
                
                $acc_app_check = 0;
             
                // return view('backend.accommodation.hostel_application.hostelCancel.create', compact('acc_app_check', 'user', 'applicationTypesubject', 'data', 'applicationType'));

                return redirect()->back()->with('error', \Lang::get('There is no hostel allocation in your name, which you want to cancel.'));
            }
            
            $type = $applicationTypeId;
            $mp_apps = $building_to_floor;
            // dd($mp_apps);
            return view('backend.accommodation.hostel_application.hostelCancel.create', compact('building_to_floor','acc_app_check', 'applicationTypesubject', 'data', 'applicationType', 'mp_apps','hostelBuildingList'));

            /* ==========================flat exchange start======================== */
        } elseif ($applicationTypeId == '3') {
            $acc_app_check = DB::select("select * from hostel_applications WHERE application_from=$user_id and status = 5 ");
            if (!empty($acc_app_check)) {
                $data_app = $acc_app_check[0];
            }
            // //  jouin query for approved applicaton of mp
            if (!empty($acc_app_check)) {
                $building_to_floor = DB::select("$res
                WHERE ha.application_from =$user_id AND ha.status = '5' ");
            } else {
              

                $acc_app_check = 0;
                
                return redirect()->back()->with('error', \Lang::get('There is no hostel allocation in your name, which you want to Exchange.'));
               
                // return view('backend.accommodation.hostel_application.hostelExchange.create', compact('acc_app_check', 'user', 'applicationTypesubject', 'data', 'applicationType',  'areaList', 'acc_build', 'flatList', 'floorList'));
                // return redirect()->route('admin.accommodation.applications.index')->with('acc_app_check', 'danger', 'Flat or House not found for cancel');
            }

            $mp_apps = $building_to_floor;
            $applicationType = $data['applicationType'];
         
            $type = $applicationTypeId;
            return view('backend.accommodation.hostel_application.hostelExchange.create', compact('hostelBuildingList','building_to_floor','data','mp_apps','applicationTypesubject', 'type'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created_by = authInfo()->id;
        $app_id = $request['applicationType'];
        $created_by = authInfo()->id;
        $accommodation_type_id = $request['accommodation_type_id'];
        // validation
        $rules = [
            'date' => 'required',
        ];
        $message = [
            'date.required' => 'This Expected Cancel Date field is Required.',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($request['date'] != '') {

            if ($request->has('submit')) {
                if (authInfo()->usertype == 'mp') {
                    $request['status'] = 1;
                } else {
                    $request['status'] = 0;
                }
            } elseif ($request->has('draft')) {
                $request['status'] = 0;
            }
            $status = $request['status'];
            $date_for = date_format(date_create($request['date']), 'Y-m-d');/* date format for insert database */

            /* ========================hostel Allotment code start========================= */
            if ($app_id == 1) {
                
                DB::beginTransaction();
                try {
                    extract($_REQUEST);
                    $result = DB::table('hostel_applications')->insert(
                        [
                            "subject" => "$subject",
                            "hostel_application_type_id" => "$applicationType",
                            "application_from" => "$application_from",
                            "date" => "$date_for",
                            "hostel_building_id" => "$hostel_building_id",
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );
                  

                    if($result){
                        DB::commit();
                        return response()->json(['status'=>'success','message'=>\Lang::get('Data Successfully Insert')]);
                    }else{
                        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert')]);
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput();
                }
                /* ========================hostel cancel code start============================== */
            } elseif ($app_id == 2) {
                $room_id = $request['office_room_id'];
         
                //  approve application id
                $info_room_id = DB::select("select * from hostel_applications WHERE application_from= $created_by and status = 5  and office_room_id =  $room_id ");
              
              $approve_application_id = $info_room_id[0]->id;
                DB::beginTransaction();
                try {
                    extract($_REQUEST);
                    $result = DB::table('hostel_applications')->insert(
                        [
                            "subject" => "$subject",
                            "hostel_application_type_id" => "$applicationType",
                            "application_from" => "$created_by",
                            "approve_application_id" => "$approve_application_id",
                            "office_room_id" => "$office_room_id",
                            "description" => "$description",
                            "date" => "$date_for",
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );
                    // if($result){
                    //     DB::commit();
                    //     return redirect()->route('admin.accommodation.applications.hostel_application.hostel_application_list_mp')->with('success','Flat added successfully');
                    // }else{
                    //    return redirect()->route('admin.accommodation.applications.hostel_application.hostel_application_list_mp')->with('error','Data does not save successfully')->withInput();
                    // }
                    if($result){
                        DB::commit();
                        return response()->json(['status'=>'success','message'=>\Lang::get('Data Successfully Insert')]);
                    }else{
                        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert')]);
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
                /* ======================hostel change code start ======================== */
            } elseif ($app_id == 3) {
                $room_id = $request['office_room_id'];
                //  approve application id
                $info_room_id = DB::select("select * from hostel_applications WHERE application_from= $created_by and status = 5 and office_room_id =  $room_id ");
          
              $approve_application_id = $info_room_id[0]->id;
          
                DB::beginTransaction();
                try {

                    extract($_REQUEST);
                    $result = DB::table('hostel_applications')->insert(
                        [
                            "subject" => "$subject",
                            "hostel_application_type_id" => "$applicationType",
                            "application_from" => "$created_by",
                            "description" => "$description",
                            "approve_application_id" => "$approve_application_id",
                            "hostel_building_id" => "$hostel_building_id",
                            "office_room_id" => "$office_room_id",
                            "date" => "$date_for",
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );
                  
                    if($result){
                        DB::commit();
                        return response()->json(['status'=>'success','message'=>\Lang::get('Data Successfully Insert')]);
                    }else{
                        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert')]);
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
            }
        } else {

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
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
        
        $user_id = authInfo()->id;
        $datas = DB::select("select * from hostel_applications WHERE id=$id");

        $app_id = $datas[0]->hostel_application_type_id;
        $data['editData'] = (array) $datas[0];
        
        $data_1['editData'] = (array) $datas[0];
        $editData = $data_1['editData'];
        $areaList = DB::table('areas')->get();
        $flatTypeList = DB::table('flat_types')->get();
        
        
        $building_to_floor = DB::select("SELECT ha.id as application_id,ha.office_room_id,ha.created_at,ha.date,ha.department_ar_date,ha.department_ar_by,ha.whips_ar_date,ha.whips_ar_by,ha.application_from, ha.subject,ha.status,ha.description,ha.hostel_application_type_id,hb.name as hostel_bu_en,hb.name_bn as hostel_bu_bn,hf.name_bn as hostel_fl_bn, hf.name as hostel_fl_en,ofr.number as hostel_ofr_bn, ofr.number_bn as hostel_ofr_bn
                FROM hostel_applications ha
                LEFT JOIN hostel_buildings hb on hb.id = ha.hostel_building_id
                LEFT JOIN hostel_floors hf on hf.id = ha.hostel_floor_id
                LEFT JOIN office_rooms ofr on ofr.id = ha.office_room_id
                WHERE ha.application_from =$user_id AND ha.status = '5' ");
        // application list view
        $acc_app = DB::table('hostel_applications')->get();
        $hostelBuildingList = DB::table('hostel_buildings')->get();
       
        if ($app_id == 1) {
            return view(
             
                'backend.accommodation.hostel_application.hostelAllotment.edit',
                compact('building_to_floor','data', 'acc_app', 'editData', 'hostelBuildingList', 'app_id')
            );
        } elseif ($app_id == 2) { 
            return view(
                'backend.accommodation.hostel_application.hostelCancel.edit',
                compact('building_to_floor','data','editData', 'acc_app', 'areaList', 'flatTypeList', 'app_id')
            );
        } elseif ($app_id == 3) {
            return view(
                'backend.accommodation.hostel_application.hostelExchange.edit',
                compact('editData','building_to_floor','data', 'acc_app', 'areaList', 'hostelBuildingList', 'flatTypeList', 'app_id')
            );
        }
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
        
        $app_id = $request['applicationType'];
        $created_by = authInfo()->id;
        try {
            if ($request->has('submit')) {
                if (authInfo()->usertype == 'mp') {
                    $request['status'] = 1;
                } else {
                    $request['status'] = 0;
                }
            } elseif ($request->has('draft')) {
                $request['status'] = 0;
            }
            $status = $request['status'];
            $date_for = date_format(date_create($request['date']), 'Y-m-d');/* date format for insert database */
            if ($app_id == 1) {
                 
                extract($_REQUEST);
                $result = DB::table('hostel_applications')
                    ->where('id', $id)
                    ->update(
                        [
                            "date" => "$date_for",
                            "hostel_building_id" => "$hostel_building_id",
                            "status" => "$status",
                            "updated_by" => "$created_by"
                        ]
                    );
                    if($result){
                        DB::commit();
                        return response()->json(['status'=>'success','message'=>\Lang::get('Data Successfully Updated')]);
                    }else{
                        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Update')]);
                    }
            } elseif ($app_id == 2) {
               
                $room_id = $request['office_room_id'];
                //  approve application id
                $flat_info = DB::select("select * from hostel_applications WHERE application_from= $created_by and status = 5  and office_room_id =  $room_id ");
                $approve_application_id = $flat_info[0]->id;

                extract($_REQUEST);
                $result = DB::table('hostel_applications')
                    ->where('id', $id)
                    ->update(
                        [
                            "subject" => "$subject",
                            "date" => "$date_for",
                            "description" => "$description",
                            "approve_application_id" => "$approve_application_id",
                            "office_room_id" => "$office_room_id",
                            "status" => "$status",
                            "updated_by" => "$created_by"
                        ]
                    );

                    // if($result){
                    //     DB::commit();
                    //     return redirect()->route('admin.accommodation.applications.hostel_application.hostel_application_list_mp')->with('success','Data Successfully Update');
                    // }else{
                    //    return redirect()->route('admin.accommodation.applications.hostel_application.hostel_application_list_mp')->with('error','Data does not update successfully')->withInput();
                    // }
                    if($result){
                        DB::commit();
                        return response()->json(['status'=>'success','message'=>\Lang::get('Data Successfully Updated')]);
                    }else{
                        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Update')]);
                    }
            } elseif ($app_id == 3) {
                $room_id = $request['office_room_id'];
                //  approve application id
                $room_info = DB::select("select * from hostel_applications WHERE application_from= $created_by and status = 5 and office_room_id =  $room_id ");
                $approve_application_id = $room_info[0]->id;
                 
                extract($_REQUEST);
                $result = DB::table('hostel_applications')
                    ->where('id', $id)
                    ->update(
                        [
                            "subject" => "$subject",
                            "date" => "$date_for",
                            "description" => "$description",
                            "hostel_building_id" => "$hostel_building_id",
                            "approve_application_id" => "$approve_application_id",
                            "office_room_id" => "$office_room_id",
                            "updated_by" => "$created_by",
                            "status" => "$status"
                        ]
                    );
                    if($result){
                        DB::commit();
                        return response()->json(['status'=>'success','message'=>\Lang::get('Data Successfully Updated')]);
                    }else{
                        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Update')]);
                    }
            }
        } catch (\Exception $e) {
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
        //
    }

    public function hostel_application_list_mp()
    {
        // draft and pending
        $user_id = authInfo()->id;
        $acc_app = DB::select("select * from hostel_applications WHERE application_from=$user_id order by id desc");
    
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.hostel_application_list_mp', compact('acc_app'));
        } else {
            return view('backend.accommodation.hostel_application.hostel_application_list_mp', compact('acc_app'));
           
        }
    }

    public function hostel_app_list_approved()
    {
        // draft and pending
        $user_id = authInfo()->id;
        $acc_app = DB::select("SELECT ha.id as application_id,ha.date,ha.department_ar_date,ha.department_ar_by,ha.whips_ar_date,ha.whips_ar_by,ha.application_from, ha.subject,ha.status,ha.description,ha.hostel_application_type_id,hb.name as hostel_bu_en,hb.name_bn as hostel_bu_bn,hf.name_bn as hostel_fl_bn, hf.name as hostel_fl_en,ofr.number as hostel_ofr_bn, ofr.number_bn as hostel_ofr_bn
        FROM hostel_applications ha
        LEFT JOIN hostel_buildings hb on hb.id = ha.hostel_building_id
        LEFT JOIN hostel_floors hf on hf.id = ha.hostel_floor_id
        LEFT JOIN office_rooms ofr on ofr.id = ha.office_room_id
        WHERE ha.application_from =$user_id AND ha.status = '5' ");
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.hostel_application_list_mp', compact('acc_app'));
        } else {
            return view('backend.accommodation.hostel_application.hostel_application_list_mp', compact('acc_app'));
            
        }
    }

    public function hostel_application_list_mp_cancel()
    {
        // draft and pending
        $user_id = authInfo()->id;
        $acc_app = DB::select("select * from hostel_applications WHERE application_from=$user_id and hostel_application_type_id = 2");
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.hostelCancel.hostel_application_list_mp_cancel', compact('acc_app'));
        } else {
            return view('backend.accommodation.hostel_application.hostelCancel.hostel_application_list_mp_cancel', compact('acc_app'));
         
        }
    }

    public function hostel_application_list_mp_exchange()
    {
        // draft and pending
        $user_id = authInfo()->id;
        $acc_app = DB::select("select * from hostel_applications WHERE application_from=$user_id and hostel_application_type_id = 3");
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.hostelExchange.hostel_application_list_mp_exchange', compact('acc_app'));
        } else {
            return view('backend.accommodation.hostel_application.hostelExchange.hostel_application_list_mp_exchange', compact('acc_app'));
        }
    }
    /* Department Task start*/
    public function hostelAppNewPending()
    {
        // draft and pending
        $user_id = authInfo()->id;
        $acc_app = DB::select("select * from hostel_applications WHERE status = 1 and hostel_application_type_id =1");
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.department.hostelAppNewPending', compact('acc_app'));
        } else {
            return view('backend.accommodation.hostel_application.department.hostelAppNewPending', compact('acc_app'));
        }
    }

    public function hostelAppCancelPending()
    {
        // draft and pending
        $user_id = authInfo()->id;
        $acc_app = DB::select("select * from hostel_applications WHERE status = 1 and hostel_application_type_id =2");
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.department.hostelAppCancelPending', compact('acc_app'));
        } else {
            return view('backend.accommodation.hostel_application.department.hostelAppCancelPending', compact('acc_app'));
        }
    }

    public function hostelAppChangePending()
    {
        // draft and pending
        $user_id = authInfo()->id;
        $acc_app = DB::select("select * from hostel_applications WHERE status = 1 and hostel_application_type_id =3");
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.department.hostelAppChangePending', compact('acc_app'));
        } else {
            return view('backend.accommodation.hostel_application.department.hostelAppChangePending', compact('acc_app'));
        }
    }

    public function createCancel(Request $request, $id)
    {
        // 
        $current_url = $_SERVER['REQUEST_URI'];
        $current_urla = explode('/', $current_url);
        $application_id = $current_urla[7];

        $user = authInfo();
        $user_id = authInfo()->id;
        if ($user->usertype == 'mp') {
            $whereMpUser = [
                'user_id' => $user->id,
            ];
        } elseif ($user->usertype == 'ps') {
            $whereMpUser = [
                'user_id' => $user['psMpInfo']['mp_user_id'],
            ];
        } else {
            $whereMpUser = '';
        }

        if ($whereMpUser) {
            $data['mpProfile'] = Profile::where($whereMpUser)->first();
        }

        $data_id = DB::select("SELECT * FROM `hostel_applications` WHERE id = $id");
        $applicationType = $data_id[0]->hostel_application_type_id;


        // $applicationType = $request->application_type_id;
        $datas = DB::select("select * from hostel_application_types WHERE id=2");
        $data['applicationType'] = (array) $datas[0];
        $applicationTypeName = $data['applicationType']['type_name'];
        $applicationTypesubject = $data['applicationType']['subject'];

        $building_to_floor = DB::select("SELECT ha.id as application_id,ha.created_at,ha.date,ha.department_ar_date,ha.department_ar_by,ha.whips_ar_date,ha.whips_ar_by,ha.application_from, ha.subject,ha.status,ha.description,ha.hostel_application_type_id,hb.name as hostel_bu_en,hb.name_bn as hostel_bu_bn,hf.name_bn as hostel_fl_bn, hf.name as hostel_fl_en,ofr.number as hostel_ofr_bn, ofr.number_bn as hostel_ofr_bn
        FROM hostel_applications ha
        LEFT JOIN hostel_buildings hb on hb.id = ha.hostel_building_id
        LEFT JOIN hostel_floors hf on hf.id = ha.hostel_floor_id
        LEFT JOIN office_rooms ofr on ofr.id = ha.office_room_id
        WHERE ha.application_from =$user_id AND ha.status = '5'  and ha.id = $application_id");


        $mp_apps = $building_to_floor;


        if (!empty($mp_apps)) {
            return view('backend.accommodation.hostel_application.hostelCancel.createCancel', compact('application_id', 'applicationTypesubject', 'applicationType', 'mp_apps'));
           
        } else {
            return view('backend.accommodation.hostel_application.viewHostelAppPending', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
        }
    }

    public function createChange(Request $request, $id)
    {
        // 
        $current_url = $_SERVER['REQUEST_URI'];
        $current_urla = explode('/', $current_url);
        $application_id = $current_urla[7];

        $user = authInfo();
        $user_id = authInfo()->id;
        if ($user->usertype == 'mp') {
            $whereMpUser = [
                'user_id' => $user->id,
            ];
        } elseif ($user->usertype == 'ps') {
            $whereMpUser = [
                'user_id' => $user['psMpInfo']['mp_user_id'],
            ];
        } else {
            $whereMpUser = '';
        }

        if ($whereMpUser) {
            $data['mpProfile'] = Profile::where($whereMpUser)->first();
        }

        $data_id = DB::select("SELECT * FROM `hostel_applications` WHERE id = $id");
        $applicationType = $data_id[0]->hostel_application_type_id;
        $hostelBuildingList = DB::table('hostel_buildings')->get();

        // $applicationType = $request->application_type_id;
        $datas = DB::select("select * from hostel_application_types WHERE id=3");
        $data['applicationType'] = (array) $datas[0];
        $applicationTypeName = $data['applicationType']['type_name'];
        $applicationTypesubject = $data['applicationType']['subject'];

        $building_to_floor = DB::select("SELECT ha.id as application_id,ha.created_at,ha.date,ha.department_ar_date,ha.department_ar_by,ha.whips_ar_date,ha.whips_ar_by,ha.application_from, ha.subject,ha.status,ha.description,ha.hostel_application_type_id,hb.name as hostel_bu_en,hb.name_bn as hostel_bu_bn,hf.name_bn as hostel_fl_bn, hf.name as hostel_fl_en,ofr.number as hostel_ofr_bn, ofr.number_bn as hostel_ofr_bn
        FROM hostel_applications ha
        LEFT JOIN hostel_buildings hb on hb.id = ha.hostel_building_id
        LEFT JOIN hostel_floors hf on hf.id = ha.hostel_floor_id
        LEFT JOIN office_rooms ofr on ofr.id = ha.office_room_id
        WHERE ha.application_from =$user_id AND ha.status = '5'  and ha.id = $application_id");


        $mp_apps = $building_to_floor;
        if (!empty($mp_apps)) {
            return view('backend.accommodation.hostel_application.hostelExchange.createChange', compact('hostelBuildingList', 'application_id', 'applicationTypesubject', 'applicationType', 'mp_apps'));
            
        } else {
            return view('backend.accommodation.hostel_application.viewHostelAppPending', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
        }
    }


    public function pendingHostelApp(Request $request, $id){
        /* 
         Accommodation Application
    */

    $hostel_application_id = DB::table('hostel_applications')->where('id',$id)->value('hostel_application_type_id');
// dd($hostel_application_id);
    if($hostel_application_id ==1){
        $template_name = 'new_hostel_app';
        $data['acappt'] = array("0"=>"বরাদ্দ", "1"=>"হোস্টেল");
    }

    if($hostel_application_id ==2){
        $template_name = 'cancel_hostel_app';
        $data['acappt'] = array("0"=>"বাতিল", "1"=>"হোস্টেল");
    }


    if($hostel_application_id ==3){
        $template_name = 'change_hostel_app';
        $data['acappt'] = array("0"=>"পরিবর্তন", "1"=>"হোস্টেল");
    }
 
    $pdf_file_name = 'Test';
     
            $pdf_file_name = \Lang::get('Application For New Hostel');
            $data['message'] = "hello.... I am Mr. Nothing";

            $data['app_data'] = DB::table('hostel_applications AS ha')
            ->leftJoin('hostel_application_types AS hapt', 'hapt.id', '=', 'ha.hostel_application_type_id')
            ->leftJoin('hostel_buildings as hb', 'hb.id', '=', 'ha.hostel_building_id')
            ->leftJoin('hostel_floors as hf', 'hf.id', '=', 'ha.hostel_floor_id')
            ->leftJoin('office_rooms as ofr', 'ofr.id', '=', 'ha.office_room_id')            
            ->leftJoin('office_room_types as ofrt', 'ofrt.id', '=', 'ofr.office_room_type_id')
            ->leftJoin('profiles AS p', 'p.id', '=', 'ha.created_by')
            ->leftJoin('constituencies AS con', 'con.id', '=', 'p.constituency_id')
            ->select('ha.id as application_id','ha.created_at','ha.date','ha.department_ar_date','ha.department_ar_by',
            'ha.whips_ar_date','ha.whips_ar_by','ha.status','ha.description','hb.name as hostel_bu_en','hb.name_bn as hostel_bu_bn',
            'hf.name_bn as hostel_fl_bn', 'hf.name as hostel_fl_en','ofr.number as hostel_ofr_en', 'ofr.number_bn as hostel_ofr_bn',
            'p.name_bn as p_name_bn','p.name_eng as p_name_eng','con.bn_name as con_bn_name','con.name as con_name', 'con.number',
            'hapt.subject', 'hapt.type_name','ofrt.name as ofrt_name','ofrt.name_bn as ofrt_name_bn')
            ->where('ha.id', '=' ,$id)
            ->get();

    $pdf = PDF::loadView('backend.accommodation.hostel_application.' . $template_name, $data);
    //$pdf->render();
    // return response()->download($pdf_file_name . '.pdf');
    return $pdf->stream($pdf_file_name . '.pdf');
}

    public function approveHostelApp(Request $request, $id){
        /* 
         Accommodation Application
    */

    $hostel_application_id = DB::table('hostel_applications')->where('id',$id)->value('hostel_application_type_id');

    if($hostel_application_id ==1){
        $template_name = 'approve_hostel_app';
        $data['acappt'] = array("0"=>"বরাদ্দ", "1"=>"হোস্টেল");
    }

    if($hostel_application_id ==2){
        $template_name = 'approve_hostel_app_cancel';
        $data['acappt'] = array("0"=>"বাতিল", "1"=>"হোস্টেল");
    }


    if($hostel_application_id ==3){
        $template_name = 'approve_hostel_app_change';
        $data['acappt'] = array("0"=>"পরিবর্তন", "1"=>"হোস্টেল");
    }
 
    $pdf_file_name = 'Test';
     
            $pdf_file_name = \Lang::get('Application For New Hostel');
            $data['message'] = "hello.... I am Mr. Nothing";

            $data['app_data'] = DB::table('hostel_applications AS ha')
            ->leftJoin('hostel_application_types AS hapt', 'hapt.id', '=', 'ha.hostel_application_type_id')
            ->leftJoin('hostel_buildings as hb', 'hb.id', '=', 'ha.hostel_building_id')
            ->leftJoin('hostel_floors as hf', 'hf.id', '=', 'ha.hostel_floor_id')
            ->leftJoin('office_rooms as ofr', 'ofr.id', '=', 'ha.office_room_id')            
            ->leftJoin('office_room_types as ofrt', 'ofrt.id', '=', 'ofr.office_room_type_id')
            ->leftJoin('profiles AS p', 'p.id', '=', 'ha.created_by')
            ->leftJoin('constituencies AS con', 'con.id', '=', 'p.constituency_id')
            ->select('ha.id as application_id','ha.created_at','ha.date','ha.department_ar_date','ha.department_ar_by',
            'ha.whips_ar_date','ha.whips_ar_by','ha.status','ha.description','hb.name as hostel_bu_en','hb.name_bn as hostel_bu_bn',
            'hf.name_bn as hostel_fl_bn', 'hf.name as hostel_fl_en','ofr.number as hostel_ofr_en', 'ofr.number_bn as hostel_ofr_bn',
            'p.name_bn as p_name_bn','p.name_eng as p_name_eng','con.bn_name as con_bn_name','con.name as con_name', 'con.number',
            'hapt.subject', 'hapt.type_name','ofrt.name as ofrt_name','ofrt.name_bn as ofrt_name_bn')
            ->where('ha.id', '=' ,$id)
            ->get();

    $pdf = PDF::loadView('backend.accommodation.hostel_application.' . $template_name, $data);
    //$pdf->render();
    // return response()->download($pdf_file_name . '.pdf');
    return $pdf->stream($pdf_file_name . '.pdf');
}

    public function viewHostelAppPending_back(Request $request, $id)
    {
        $application_id = $id;
        $data_id = DB::select("SELECT * FROM `hostel_applications` WHERE id = $id");
        $app_user_id = $data_id[0]->application_from;
        
        $appli_id = $data_id[0]->id;
        $user_id = authInfo()->id;
        // dorp down data
        $areaList = DB::table('areas')->get();
        $h_b_List = DB::table('hostel_buildings')->get();
        $floorList = DB::table('floors')->get();
        $officeRoom = DB::table('office_rooms')->get();
        //  hostel_applications
        $data['ha'] = DB::select("SELECT ha.id as application_id,ha.office_room_id,ha.status,ha.created_at,ha.date,ha.department_ar_date,ha.department_ar_by,ha.whips_ar_date,ha.whips_ar_by,ha.application_from, ha.subject,ha.status,ha.description,ha.hostel_application_type_id,hb.id as building_id,hb.name as hostel_bu_en,hb.name_bn as hostel_bu_bn,hf.name_bn as hostel_fl_bn, hf.name as hostel_fl_en,ofr.number as hostel_ofr_bn, ofr.number_bn as hostel_ofr_bn
        FROM hostel_applications ha
        LEFT JOIN hostel_buildings hb on hb.id = ha.hostel_building_id
        LEFT JOIN hostel_floors hf on hf.id = ha.hostel_floor_id
        LEFT JOIN office_rooms ofr on ofr.id = ha.office_room_id
        WHERE ha.application_from =$user_id AND ha.hostel_application_type_id = 1
        
        AND ha.id = $appli_id ");

        $data['mp']  = DB::select("SELECT * FROM profiles WHERE id= $app_user_id ");
        if (!empty($h_b_List)) {
            return view('backend.accommodation.hostel_application.viewHostelAppPending', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
        } else {
            return view('backend.accommodation.hostel_application.viewHostelAppPending', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
        }
    }

    public function viewHostelAppCancel(Request $request, $id)
    {
        $application_id = $id;
        $data_id = DB::select("SELECT * FROM `hostel_applications` WHERE id = $id");
        $app_user_id = $data_id[0]->application_from;
        
        $appli_id = $data_id[0]->id;
        $user_id = authInfo()->id;
        // dorp down data
        $areaList = DB::table('areas')->get();
        $h_b_List = DB::table('hostel_buildings')->get();
        $floorList = DB::table('floors')->get();
        $officeRoom = DB::table('office_rooms')->get();
        //  hostel_applications
        $data['ha'] = DB::select("SELECT ha.id as application_id,ha.office_room_id,ha.status,ha.created_at,ha.date,ha.department_ar_date,ha.department_ar_by,ha.whips_ar_date,ha.whips_ar_by,ha.application_from, ha.subject,ha.status,ha.description,ha.hostel_application_type_id,hb.id as building_id,hb.name as hostel_bu_en,hb.name_bn as hostel_bu_bn,hf.name_bn as hostel_fl_bn, hf.name as hostel_fl_en,ofr.number as hostel_ofr_bn, ofr.number_bn as hostel_ofr_bn
        FROM hostel_applications ha
        LEFT JOIN hostel_buildings hb on hb.id = ha.hostel_building_id
        LEFT JOIN hostel_floors hf on hf.id = ha.hostel_floor_id
        LEFT JOIN office_rooms ofr on ofr.id = ha.office_room_id
        WHERE ha.application_from =$user_id AND ha.hostel_application_type_id = 2
        AND ha.id = $appli_id ");

        $data['mp']  = DB::select("SELECT * FROM profiles WHERE id= $app_user_id ");
        if (!empty($h_b_List)) {
            return view('backend.accommodation.hostel_application.hostelCancel.viewHostelAppCancel', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
        } else {
            return view('backend.accommodation.hostel_application.hostelCancel.viewHostelAppCancel', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
        }
    }

    public function viewHostelAppChange(Request $request, $id)
    {
        $application_id = $id;
        $data_id = DB::select("SELECT * FROM `hostel_applications` WHERE id = $id");
        $app_user_id = $data_id[0]->application_from;
        
        $appli_id = $data_id[0]->id;
        $user_id = authInfo()->id;
        // dorp down data
        $areaList = DB::table('areas')->get();
        $h_b_List = DB::table('hostel_buildings')->get();
        $floorList = DB::table('floors')->get();
        $officeRoom = DB::table('office_rooms')->get();
        //  hostel_applications
        $data['ha'] = DB::select("SELECT ha.id as application_id,ha.status,ha.office_room_id,ha.created_at,ha.date,ha.department_ar_date,ha.department_ar_by,ha.whips_ar_date,ha.whips_ar_by,ha.application_from, ha.subject,ha.status,ha.description,ha.hostel_application_type_id,hb.id as building_id,hb.name as hostel_bu_en,hb.name_bn as hostel_bu_bn,hf.name_bn as hostel_fl_bn, hf.name as hostel_fl_en,ofr.number as hostel_ofr_bn, ofr.number_bn as hostel_ofr_bn
        FROM hostel_applications ha
        LEFT JOIN hostel_buildings hb on hb.id = ha.hostel_building_id
        LEFT JOIN hostel_floors hf on hf.id = ha.hostel_floor_id
        LEFT JOIN office_rooms ofr on ofr.id = ha.office_room_id
        WHERE ha.application_from =$user_id AND ha.hostel_application_type_id = 3
        AND ha.id = $appli_id ");

        $data['mp']  = DB::select("SELECT * FROM profiles WHERE id= $app_user_id ");
        if (!empty($h_b_List)) {
            return view('backend.accommodation.hostel_application.hostelExChange.viewHostelAppChange', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
        } else {
            return view('backend.accommodation.hostel_application.hostelExChange.viewHostelAppChange', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
        }
    }

    public function updateHostelAppPending(Request $request, $id)
    {
        $user_id = authInfo()->id;
        // dorp down data

        $app_id = $request['applicationType'];

        $created_by = authInfo()->id;
        try {
            if ($request->has('submit')) {
                if (authInfo()->usertype == 'Department') {
                    $request['status'] = 3;
                } else {
                    $request['status'] = 2;
                }
            } elseif ($request->has('Rejected')) {
                $request['status'] = 2;
            }
            $status = $request['status'];
            if ($app_id == 1) {


                if ($request['status'] == 2) {
                    if ($request['dept_submission_date'] == '') {
                        $date = $Date = date('Y/m/d');
                    }
                    extract($_REQUEST);
                    $result = DB::table('hostel_applications')
                        ->where('id', $app_id)
                        ->update(
                            [
                                "dept_submission_date" => "$date",
                                "status" => "$status",
                                "department_ar_by" => "$created_by"
                            ]
                        );
                } else {
                    extract($_REQUEST);
                    $result = DB::table('hostel_applications')
                        ->where('id', $app_id)
                        ->update(
                            [
                                "area_id" => "$area_id",
                                "hostel_building_id" => "$hostel_building_id",
                                "floor_id" => "$floor_id",
                                "office_room_id" => "$office_room_id",
                                "dept_submission_date" => "$dept_submission_date",
                                "status" => "$status",
                                "department_ar_by" => "$created_by"
                            ]
                        );
                }
                if ($result) {
                    return redirect()->route('admin.accommodation.applications.hostel_application.department.hostelAppNewPending')->with('success', 'Data Updated successfully');
                } else {
                    return redirect()->route('admin.accommodation.applications.hostel_application.department.hostelAppNewPending')->with('error', 'Data does not update successfully')->withInput();
                }
            } elseif ($app_id == 2) {
                extract($_REQUEST);
                $result = DB::table('hostel_applications')
                    ->where('id', $app_id)
                    ->update(
                        [
                            "area_id" => "$area_id",
                            "hostel_building_id" => "$hostel_building_id",
                            "floor_id" => "$floor_id",
                            "office_room_id" => "$office_room_id",
                            "dept_submission_date" => "$dept_submission_date",
                            "status" => "$status",
                            "department_ar_by" => "$created_by"
                        ]

                    );
                if ($result) {
                    return redirect()->route('admin.accommodation.applications.hostel_application.department.hostelApplicationPending')->with('success', 'Data Updated successfully');
                } else {
                    return redirect()->route('admin.accommodation.applications.hostel_application.hostelApplicationPending', [$id])->with('error', 'Data does not update successfully')->withInput();
                }
            } elseif ($app_id == 3) {
                extract($_REQUEST);
                $result = DB::table('hostel_applications')
                    ->where('id', $id)
                    ->update(
                        [
                            "subject" => "$subject",
                            "date" => "$date",
                            "description" => "$description",
                            "flat_id" => "$flat_id",
                            "updated_by" => "$created_by",
                            "status" => "$status"
                        ]
                    );
                if ($result) {

                    return redirect()->route('admin.accommodation.applications.hostel_application.hostelExchange.hostel_application_list_mp_exchange')->with('success', 'Data Saved successfully');
                } else {
                    return redirect()->route('admin.accommodation.applications.hostel_application.index')->with('error', 'Data does not save successfully')->withInput();
                }
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";
            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }


    public function dptAppApproved( )
    {
        // $model = DB::table('Ho');
        $res = (new PublicController)->mpInfo();

        $res = (new PublicController)->mpInfo();
        // New Application
        $acc_app = DB::select("$res WHERE ha.status = 1");
        //Cancel Application
        $cancel_app = DB::select("$res WHERE ha.status = 2");
        //Change Application
        $change_app = DB::select("$res WHERE ha.status = 3");
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.department.dptAppApproved', compact('acc_app','cancel_app','change_app'));
        } else {
            return redirect()->back()->with('error', \Lang::get('There is no data available.'));
        }
    }


    public function dptAppRejected()
    {
        // draft and pending
        $user_id = authInfo()->id;
        $acc_app = DB::select("select * from hostel_applications WHERE status = 2 and dept_submission_date !='' and department_ar_by != ''");
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.department.dptAppApproved', compact('acc_app'));
        } else {
            return view('backend.accommodation.hostel_application.department.dptAppApproved', compact('acc_app'));
        }
    }


    public function wAppNewPending()
    {
        // draft and pending
        $user_id = authInfo()->id;
        $acc_app = DB::select("select * from hostel_applications WHERE status = 3 and dept_submission_date !='' and department_ar_by != ''");
        if (!empty($acc_app)) {
            return view('backend.accommodation.hostel_application.department.wAppNewPending', compact('acc_app'));
        } else {
            return view('backend.accommodation.hostel_application.department.wAppNewPending', compact('acc_app'));
        }
    }
}
