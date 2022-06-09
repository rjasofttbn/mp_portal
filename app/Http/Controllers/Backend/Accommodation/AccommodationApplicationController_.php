<?php

namespace App\Http\Controllers\Backend\Accommodation;
use App\Model\AccommodationDepartmentApplication;
use App\Model\AccommodationApplicationType;
use Illuminate\Support\Facades\Validator;
use App\Model\AccommodationApplication;
use App\Model\accommodationAllotment;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\MpActivitiesStatus;
use App\Model\AccommodationLog;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Model\Department;
use App\Model\Profile;
use App\Model\MpPs;
use App\Model\Flat;
use App\Model\Area;
use DataTables;
use App\User;
use Redirect;
use PDF;


class AccommodationApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = authInfo();
        $data['accommodation_application_types'] = AccommodationApplicationType::all();
        if (isApi()) {
            
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = $data;
            return response()->json($response);
        }      

        return view('backend.accommodation.application.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = authInfo();
        $user_id = authInfo()['id'];
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
        $datas = DB::select("select * from accommodation_application_types WHERE id=$applicationType");
        
        $data['applicationType'] = (array)$datas[0];
        $applicationTypeName = $data['applicationType']['name'];
        $applicationTypesubject = $data['applicationType']['name_bn'];

        // dorp down data
        $areaList = DB::table('areas')->get();
        $acc_build = DB::table('accommodation_buildings')->get();
        $accommodationTypes = DB::table('accommodation_types')->get();
        $flatTypeList = DB::table('flat_types')->get();
        $flatList = DB::table('flats')->get();
        $floorList = DB::table('floors')->get();
        
        /* =====================flat allotment start========================*/
        if ($applicationType == 1) {
            $acc_app = DB::select("select * from accommodation_applications WHERE created_by=$user_id  and application_type_id = 1 and status =1");
            if (!empty($acc_app)) {

                if (isApi()) {
                    $response['status'] = 'error';
                    $response['message'] = \Lang::get('Your last application status is pending, Now you have to wait for reply.');
                    return response()->json($response);
                }
                return redirect()->back()->with('error', \Lang::get('Your last application status is pending, Now you have to wait for reply.'));
            }else{
            // application list view
                $acc_app = DB::select("select * from accommodation_applications WHERE created_by=$user_id and application_type_id = 1 and status =1");

                if (!empty($acc_app)) {
                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = \Lang::get('Your last application status is pending, Now you have to wait for reply.');
                        return response()->json($response);
                    }
                    return redirect()->back()->with('error', \Lang::get('Your last application status is pending, Now you have to wait for reply.'));
                } else {
                    if (isApi()) {
                        
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = compact('data', 'areaList', 'flatTypeList', 'applicationTypesubject', 'applicationType');
                        return response()->json($response);
                    }
                    return view(
                        'backend.accommodation.application.flatAllotment.create',
                        compact('data', 'areaList', 'flatTypeList', 'applicationTypesubject', 'applicationType')
                    );
                }
            }

            /* ======================flat cancel start======================*/
        } elseif ($applicationType == 2) {
            //  validation
            $acc_app = DB::select("select * from accommodation_applications WHERE created_by=$user_id  and application_type_id = 2 and status =1");
            if (!empty($acc_app)) {
              
                if (isApi()) {
                    $response['status'] = 'error';
                    $response['message'] = \Lang::get('Your last application status is pending, Now you have to wait for reply.');
                    return response()->json($response);
                }
                return redirect()->back()->with('error', \Lang::get('Your last application status is pending, Now you have to wait for reply.'));
            }else{
                $acc_app_check = DB::select("select * from accommodation_applications WHERE created_by=$user_id and application_type_id = 1 and status = 4");
            // //  jouin query for approved applicaton of mp
                if (!empty($acc_app_check)) {
                   
                    $building_to_floor  = DB::select("SELECT a.id,a.flat_id,a.flat_type_id,a.created_at,a.application_type_id,a.date,a.status, ar.id as area_id, ar.name as area_en, ar.name_bn as area_bn, ab.id,ab.name as ac_building_en, ab.name_bn as ac_building_bn,f.id, f.number as flat_size_en,f.number_bn as flat_no_bn, fl.id, fl.name as floor_en, fl.name_bn as floor_bn,ft.name_bn as ft_bn,ft.name as ft_en,ft.size

                        FROM accommodation_applications a
                        LEFT JOIN areas as ar on ar.id = a.area_id
                        LEFT JOIN accommodation_buildings ab on ab.id = a.accommodation_building_id
                        LEFT JOIN flats f on f.id = a.flat_id
                        LEFT JOIN flat_types ft on ft.id = f.flat_type_id
                        LEFT JOIN floors fl on fl.id = a.floor_id WHERE a.created_by =$user_id AND a.status = '4' ");
                } else {
                // $acc_app = $acc_app_check;

                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = \Lang::get('There is no flat allocation in your name, which you want to cancel.');
                        return response()->json($response);
                    }
                    return redirect()->back()->with('error', \Lang::get('There is no flat allocation in your name, which you want to cancel.'));
                }
                $acc_app = $acc_app_check;
                $mp_apps = $building_to_floor;
            // dd($building_to_floor);
                if (isApi()) {
                    
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = compact('building_to_floor','applicationTypesubject', 'data', 'applicationType', 'mp_apps', 'areaList', 'acc_build', 'flatList', 'floorList','acc_app');
                    return response()->json($response);
                }
                return view('backend.accommodation.application.flatCancel.create',  compact('building_to_floor','applicationTypesubject', 'data', 'applicationType', 'mp_apps', 'areaList', 'acc_build', 'flatList', 'floorList','acc_app'));

            }

            /* ==========================flat exchange start========================*/
        } elseif ($applicationType == 3) {

            $acc_app = DB::select("select * from accommodation_applications WHERE created_by= $user_id  and application_type_id = 3 and status =1");
            if (!empty($acc_app)) {

                if (isApi()) {
                    $response['status'] = 'error';
                    $response['message'] = \Lang::get('Your last application status is pending, Now you have to wait for reply.');
                    return response()->json($response);
                }  
                return redirect()->back()->with('error', \Lang::get('Your last application status is pending, Now you have to wait for reply.'));
            }else{
            //  validation
                $acc_app_check = DB::select("select * from accommodation_applications WHERE created_by= $user_id and application_type_id = 1  and status = 4");
                if (!empty($acc_app_check[0])) {
                    $data_app = $acc_app_check[0];
                }
            // jouin query for approved applicaton of mp
                if (!empty($acc_app_check)) {
                    $building_to_floor  = DB::select("SELECT a.id,a.flat_id,a.flat_type_id,a.created_at,a.application_type_id,a.date,a.status,ar.id as area_id, ar.name as area_en, ar.name_bn as area_bn, ab.id,ab.name as ac_building_en, ab.name_bn as ac_building_bn,f.id, f.number as flat_size_en,f.number_bn as flat_no_bn, fl.id, fl.name as floor_en, fl.name_bn as floor_bn,ft.size

                        FROM accommodation_applications a
                        LEFT JOIN areas as ar on ar.id = a.area_id
                        LEFT JOIN accommodation_buildings ab on ab.id = a.accommodation_building_id
                        LEFT JOIN flats f on f.id = a.flat_id
                        LEFT JOIN flat_types ft on ft.id = f.flat_type_id
                        LEFT JOIN floors fl on fl.id = a.floor_id WHERE a.created_by =$user_id AND a.status = '4'");
                } else {
                // $acc_app = $acc_app_check;

                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = \Lang::get('There is no flat allocation in your name, which you want to Exchange.');
                        return response()->json($response);
                    }  
                    return redirect()->back()->with('error', \Lang::get('There is no flat allocation in your name, which you want to Exchange.'));
                }
                $mp_apps = $building_to_floor;
        //  dd($data_app->id);
                $applicationType = $data['applicationType'];

                if (isApi()) {
                    
        $response['status'] = 'success';
        $response['message'] = '';
        $response['api_info']    = compact('data','building_to_floor','accommodationTypes', 'applicationTypesubject', 'data_app', 'applicationType', 'mp_apps', 'areaList', 'acc_build', 'flatList', 'floorList');
                            return response()->json($response);
                }
                return view('backend.accommodation.application.flatExchange.create', $data, compact('building_to_floor','accommodationTypes', 'applicationTypesubject', 'data_app', 'applicationType', 'mp_apps', 'areaList', 'acc_build', 'flatList', 'floorList'));
            }

            /* ======================high official house allotment start======================*/
        }elseif ($applicationType == 4) {
            $acc_app = DB::select("select * from accommodation_applications WHERE created_by=$user_id  and application_type_id = 5 and status =1");
            if (!empty($acc_app)) {

                if (isApi()) {
                    $response['status'] = 'error';
                    $response['message'] = \Lang::get('Your last application status is pending, Now you have to wait for reply.');
                    return response()->json($response);
                }
                return redirect()->back()->with('error', \Lang::get('Your last application status is pending, Now you have to wait for reply.'));
            }else{
            // application list view
                $acc_app = DB::select("select * from accommodation_applications WHERE created_by=$user_id  and application_type_id = 4 and status =1");

                if (!empty($acc_app)) {

                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = \Lang::get('Your last application status is pending, Now you have to wait for reply.');
                        return response()->json($response);
                    }
                    return redirect()->back()->with('error', \Lang::get('Your last application status is pending, Now you have to wait for reply.'));
                } else {
                    if (isApi()) {
                        
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = compact('data', 'areaList', 'flatTypeList', 'applicationTypesubject', 'applicationType');
                        return response()->json($response);
                    }
                    return view(
                        'backend.accommodation.application.highOfficialHouseAllotment.create',
                        compact('data', 'areaList', 'flatTypeList', 'applicationTypesubject', 'applicationType')
                    );
                }
            }

            /* ======================high official house allotment cancel start======================*/
        }elseif ($applicationType == 5) {
            //  validation
         $acc_app = DB::select("select * from accommodation_applications WHERE created_by=$user_id  and application_type_id = 5 and status =1");
         if (!empty($acc_app)) {

            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = \Lang::get('Your last application status is pending, Now you have to wait for reply.');
                return response()->json($response);
            }
            return redirect()->back()->with('error', \Lang::get('Your last application status is pending, Now you have to wait for reply.'));
        }else{
          $acc_app_check = DB::select("select * from accommodation_applications WHERE created_by=$user_id and application_type_id = 4 and status = 4");
          
            // jouin query for approved applicaton of mp
          if (!empty($acc_app_check)) {
           
            $building_to_floor  = DB::select("SELECT a.id,a.flat_id,a.flat_type_id,a.created_at,a.application_type_id,a.created_by,a.date,a.status FROM accommodation_applications a
                WHERE a.created_by =$user_id and application_type_id = 4 and a.status = '4'");
        } else {

            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = \Lang::get('There is no flat allocation in your name, which you want to cancel.');
                return response()->json($response);
            }
            return redirect()->back()->with('error', \Lang::get('There is no flat allocation in your name, which you want to cancel.'));
        }
        $acc_app = $acc_app_check;
        $mp_apps = $building_to_floor;
        $approve_id = $acc_app[0]->id;
        
        if (isApi()) {
            
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = compact('applicationTypesubject','applicationType','approve_id');
            return response()->json($response);
        }
        return view('backend.accommodation.application.highOfficialHouseAllotmentCancel.create',  compact('applicationTypesubject','applicationType','approve_id'));   
    }
    /* ======================high official house allotment exchange start======================*/
}elseif ($applicationType == 6) {
           //  validation
   $acc_app = DB::select("select * from accommodation_applications WHERE created_by=$user_id  and application_type_id = 6 and status =1");
   if (!empty($acc_app)) {
     
    if (isApi()) {
        $response['status'] = 'error';
        $response['message'] = \Lang::get('Your last application status is pending, Now you have to wait for reply.');
        return response()->json($response);
    }
    return redirect()->back()->with('error', \Lang::get('Your last application status is pending, Now you have to wait for reply.'));
}else{
            //  validation
    $acc_app_check = DB::select("select * from accommodation_applications WHERE created_by= $user_id and application_type_id = 4 and status = 4");

            // jouin query for approved applicaton of mp
    if (!empty($acc_app_check)) {
        
        $building_to_floor  = DB::select("SELECT a.id,a.flat_id,a.flat_type_id,a.created_at,a.application_type_id,a.created_by, a.date,a.status FROM accommodation_applications a
            WHERE a.created_by =$user_id and application_type_id = $applicationType and a.status = '4'");
    } else {

        if (isApi()) {
            $response['status'] = 'error';
            $response['message'] = \Lang::get('There is no flat allocation in your name, which you want to cancel.');
            return response()->json($response);
        }
        return redirect()->back()->with('error', \Lang::get('There is no flat allocation in your name, which you want to cancel.'));
    }
    $acc_app = $acc_app_check;
    $mp_apps = $building_to_floor;
    $approve_id = $acc_app[0]->id;

    if (isApi()) {
        
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = compact('applicationTypesubject','applicationType','approve_id');
        return response()->json($response);
    }
    return view('backend.accommodation.application.highOfficialHouseExchange.create',  compact('applicationTypesubject','applicationType','approve_id'));
}
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
        $validator = Validator::make($request->all(), [
            'date'  => 'required'
        ]);

        if ($validator->fails()) {
            if (isApi()) {
                return response()->json($validator->messages(), 200);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $created_by = authInfo()['id'];
        $app_id = $request['applicationType'];
        /* Log Start*/
        $server = $_SERVER;
        $s_name = 'Server Name : '.$server['SERVER_NAME'];
        $s_add = 'Server Address : '.$server['SERVER_ADDR'];
        $s_port = 'Server Port : '.$server['SERVER_PORT'];
        $s_remote_address = 'Remote Address : '.$server['REMOTE_ADDR'];
        $s_request_time = 'Request Time : '.$server['REQUEST_TIME'];
        $s_request_time = 'Request Time : '.date('d-m-Y H:i:s A', $_SERVER['REQUEST_TIME']);
        
        if ($app_id == 1) {
            
            $area_id = $request['area_id'];
            $name = DB::select("SELECT name_bn FROM `areas` WHERE id = $area_id");
            $name_bn = 'এলাকা : '.$name[0]->name_bn;
            $flat_type_id = $request['flat_type_id'];
            $name = DB::select("SELECT name_bn FROM `flat_types` WHERE id = $flat_type_id");
            $flat_size = 'ফ্ল্যাট সাইজ : '.$name[0]->name_bn;
            $date_js = 'তারিখ : '.date('d-m-Y', strtotime($request['date']));
        } elseif($app_id == 2 || $app_id == 3) {
           
            //  $flat_id = $request['flat_id'];
            //  approve application id
            $flat_info = DB::select("select * from accommodation_applications WHERE created_by= $created_by and status = 4");
            $area_id= $flat_info[0]->area_id;
            $approve_application_id = $flat_info[0]->id;
            // dd($approve_application_id);
            $name = DB::select("SELECT name_bn FROM `areas` WHERE id = $area_id");
            $name_bn = 'এলাকা  : '.$name[0]->name_bn;
            $c_description = 'বিবরণ  : '.$request['description'];
            $description = $request['description'];
            
            $flat_type_id = $request['flat_type_id'];
            $subject = $request['subject_bn'];
            // dd($request['date']);
            $date_js = 'তারিখ : '.date('d-m-Y', strtotime($request['date']));
            
            $name = DB::select("SELECT name_bn FROM `areas` WHERE id = $area_id");
            $name_bn = $name[0]->name_bn;
            // $flat_no = DB::select("SELECT number_bn FROM `flats` WHERE id = $flat_id");
            // $flat_nu = 'ফ্ল্যাট নং : '.$flat_no[0]->number_bn;
        }
        $profile = DB::select("SELECT name_bn FROM `profiles` WHERE `user_id` = $created_by");
        $mp_name ='নাম : '.$profile[0]->name_bn;
        /* Log End*/
        $created_by = authInfo()['id'];
        $accommodation_type_id =  $request['accommodation_type_id'];
        
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
            
            /* =================flatAllotment code start====================*/
            if ($app_id == 1) {
                DB::beginTransaction();
                try {
                    extract($_REQUEST);
                    $result = DB::table('accommodation_applications')->insert(
                        [
                            "application_type_id" => "$applicationType",
                            "area_id" => "$area_id",
                            "flat_type_id" => "$flat_type_id",
                            "date" => "$date_for",                           
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );

                    if($status ==1){
                        $id = DB::getPdo()->lastInsertId();
                        $requestData = json_encode($mp_name . ',' . $name_bn . ',' . $flat_size . ',' . $date_js . ',' .$s_name.','.$s_add.','.$s_port.','.$s_remote_address.','.$s_request_time);
                        DB::table('accommodation_log')->insert(
                            [
                                "application_id" => "$id",
                                "subject" => "$subject",
                                "description" => "$requestData"
                            ]
                        );
                    }
                    
                    if ($result) {
                        DB::commit();
                        if($status ==0){

                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Draft store successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Draft store successfully');
                        }else{
                           
                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Saved successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                        }

                    } else {
                        if (isApi()) {
                            $response['status'] = 'error';
                            $response['message'] = 'Data does not save successfully';
                            return response()->json($response);
                        }
                        return redirect()->route('backend.accommodation.application.index')->with('error', 'Data does not save successfully')->withInput();
                    }
                    
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = 'Exception! Something went wrong please try again!';
                        return response()->json($response);
                    }
                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput();
                }
                /* =================flat cancel code start=================*/
            } elseif ($app_id == 2) {
                DB::beginTransaction();
                try {
                    extract($_REQUEST);
                    $result = DB::table('accommodation_applications')->insert(
                        [
                            "application_type_id" => "$app_id",
                            "approve_application_id" => "$approve_application_id",
                            "date" => "$date_for",
                            "description" => "$description",
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );

                    if($status ==1){
                        $id = DB::getPdo()->lastInsertId();
                        $requestData = json_encode($mp_name . ',' . $name_bn . ',' . $c_description . ',' . $date_js . ',' .$s_name. ',' .$s_add.','.$s_port.','.$s_remote_address.','.$s_request_time);
                        DB::table('accommodation_log')->insert(
                            [
                                "application_id" => "$id",
                                "subject" => "$subject",
                                "description" => "$requestData"
                            ]
                        );
                    }

                    if ($result) {
                        DB::commit();
                        if($status ==0){

                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Draft store successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Draft store successfully');
                        }else{
                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Saved successfully';
                                return response()->json($response);
                            }                               
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                        }
                        
                    } else {

                        if (isApi()) {
                            $response['status'] = 'error';
                            $response['message'] = 'Data does not save successfully';
                            return response()->json($response);
                        }
                        return redirect()->route('backend.accommodation.application.index')->with('error', 'Data does not save successfully')->withInput();
                    }
                    
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = 'Exception! Something went wrong please try again!';
                        return response()->json($response);
                    }
                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
                /* =============flat change code start ==========================*/
            } elseif ($app_id == 3) {
                DB::beginTransaction();
                try {
                   
                    extract($_REQUEST);
                    $result = DB::table('accommodation_applications')->insert(
                        [
                          
                            "application_type_id" => "$app_id",
                            "approve_application_id" => "$approve_application_id",
                            "area_id" => "$area_id",
                            "date" => "$date_for",
                            "description" => "$description",
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );

                    if($status ==1){
                        $id = DB::getPdo()->lastInsertId();
                        $requestData = json_encode($mp_name . ',' . $name_bn . ',' . $c_description . ',' . $date_js . ',' .$s_name. ',' .$s_add.','.$s_port.','.$s_remote_address.','.$s_request_time);
                        DB::table('accommodation_log')->insert(
                            [
                                "application_id" => "$id",
                                "subject" => "$subject",
                                "description" => "$requestData"
                            ]
                        );
                    }
                    if ($result) {
                        DB::commit();
                        if($status ==0){

                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Draft store successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Draft store successfully');
                        }else{
                           
                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Saved successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                        }
                        
                    } else {
                        if (isApi()) {
                            $response['status'] = 'error';
                            $response['message'] = 'Data does not save successfully';
                            return response()->json($response);
                        }
                        return redirect()->route('backend.accommodation.application.index')->with('error', 'Data does not save successfully')->withInput();
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = 'Exception! Something went wrong please try again!';
                        return response()->json($response);
                    }
                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
                /* =============High offficial house New allotment code start ==========================*/
            } elseif ($app_id == 4) {
                DB::beginTransaction();
                try {
                    extract($_REQUEST);
                    $result = DB::table('accommodation_applications')->insert(
                        [
                            "application_type_id" => "$applicationType",
                            "date" => "$date_for",                           
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );

                    if ($result) {
                        DB::commit();
                        if($status ==0){
                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Draft store successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Draft store successfully');
                        }else{
                           
                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Saved successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                        }
                        
                    } else {

                        if (isApi()) {
                            $response['status'] = 'error';
                            $response['message'] = 'Data does not save successfully';
                            return response()->json($response);
                        }
                        return redirect()->route('backend.accommodation.application.index')->with('error', 'Data does not save successfully')->withInput();
                    }
                    
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = 'Exception! Something went wrong please try again!';
                        return response()->json($response);
                    }
                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
                /* =============High offficial house Cancel code start ==========================*/
            }elseif ($app_id == 5) {
                DB::beginTransaction();
                try {
                    extract($_REQUEST);
                    $approve_id =$request['approve_id'];
                    $result = DB::table('accommodation_applications')->insert(
                        [
                            "application_type_id" => "$app_id",
                            "approve_application_id" => "$approve_id", 
                            "date" => "$date_for",
                            "description" => "$description",
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );

                    if ($result) {
                        DB::commit();
                        if($status ==0){
                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Draft store successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Draft store successfully');
                        }else{

                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Saved successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                        }
                        
                    } else {

                        if (isApi()) {
                            $response['status'] = 'error';
                            $response['message'] = 'Data does not save successfully';
                            return response()->json($response);
                        }
                        return redirect()->route('backend.accommodation.application.index')->with('error', 'Data does not save successfully')->withInput();
                    }
                    
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = 'Exception! Something went wrong please try again!';
                        return response()->json($response);
                    }
                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
                /* =============High offficial house exchange code start ==========================*/
            } elseif ($app_id == 6) {
                DB::beginTransaction();
                try {
                    extract($_REQUEST);
                    $approve_id =$request['approve_id'];
                    $result = DB::table('accommodation_applications')->insert(
                        [
                            "application_type_id" => "$app_id",
                            "approve_application_id" => "$approve_id",
                            "date" => "$date_for",
                            "description" => "$description",
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );

                    if ($result) {
                        DB::commit();
                        if($status ==0){

                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Draft store successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Draft store successfully');
                        }else{
                           
                            if (isApi()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Data Saved successfully';
                                return response()->json($response);
                            }
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                        }
                        
                    } else {

                        if (isApi()) {
                            $response['status'] = 'error';
                            $response['message'] = 'Data does not save successfully';
                            return response()->json($response);
                        }
                        return redirect()->route('backend.accommodation.application.index')->with('error', 'Data does not save successfully')->withInput();
                    }

                    // if($result){
                    //     DB::commit();
                    //         if($status ==0){
                    //         return response()->json(['status'=>'success','message'=>\Lang::get('Data Draft Store Successfully')]);
                    //     }else{
                    
                    //     return response()->json(['status'=>'success','message'=>\Lang::get('Data Saved Successfully')]);
                    //     }
                    
                    // }else{
                    //     return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert')]);
                    // }
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    if (isApi()) {
                        $response['status'] = 'error';
                        $response['message'] = 'Exception! Something went wrong please try again!';
                        return response()->json($response);
                    }
                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
            }
        } else {

            if (isApi()) {
                $response['status'] = 'error';
                $response['message'] = 'Data does not save successfully';
                return response()->json($response);
            }
            
            if ($validator->fails()) {
                if (isApi()) {
                    return response()->json($validator->messages(), 200);
                }
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
        $user_id = authInfo()['id'];
        $datas = DB::select("select * from accommodation_applications a
            LEFT JOIN accommodation_application_types as at on at.id = a.application_type_id WHERE a.id=$id");
        $app_id = $datas[0]->application_type_id;
        $a_id = $datas[0]->id;

        $data = (array) $datas[0];

        
        $building_to_floor  = DB::select("SELECT a.id,a.flat_id,a.created_at,a.application_type_id,a.approve_application_id,a.created_by, a.date,a.status,ar.id as area_id, ar.name as area_en, ar.name_bn as area_bn,at.name,at.name_bn as app_t_name_bn

            FROM accommodation_applications a
            LEFT JOIN accommodation_application_types as at on at.id = a.application_type_id
            LEFT JOIN areas as ar on ar.id = a.area_id
            WHERE a.created_by =$user_id AND a.status = '4'");
    // dd($building_to_floor);

        $areaList = DB::table('areas')->get();
        $acc_build = DB::table('accommodation_buildings')->get();
        $accommodationTypes = DB::table('accommodation_types')->get();
        $flatTypeList = DB::table('flat_types')->get();
        $flatList = DB::table('flats')->get();
        $floorList['editData'] = DB::table('floors')->get();
        // application list view
        $acc_app = DB::table('accommodation_applications')->get();
        if ($app_id == 1) {
            return view(
                'backend.accommodation.application.flatAllotment.edit',
                compact('data', 'acc_app', 'areaList', 'flatTypeList', 'app_id', 'a_id')
            );
        } elseif ($app_id == 2) {
            return view(
                'backend.accommodation.application.flatCancel.edit',
                compact('building_to_floor','data', 'acc_app', 'areaList', 'flatTypeList', 'app_id', 'a_id')
            );
            
        } elseif ($app_id == 3) {
            $data_app = $datas;
            return view(
                'backend.accommodation.application.flatExchange.edit',
                compact('building_to_floor','acc_build', 'data_app', 'accommodationTypes', 'flatList', 'floorList', 'data', 'acc_app', 'areaList', 'flatTypeList', 'app_id', 'a_id')
            );
        }elseif ($app_id == 4) {
            $data_app = $datas;
            return view(
                'backend.accommodation.application.highOfficialHouseAllotment.edit',
                compact('building_to_floor','acc_build', 'data_app', 'accommodationTypes', 'data', 'acc_app', 'app_id', 'a_id')
            );
        }elseif ($app_id == 5) {
            
            return view(
                'backend.accommodation.application.highOfficialHouseAllotmentCancel.edit',
                compact('building_to_floor','data', 'acc_app', 'areaList', 'app_id', 'a_id')
            );
        } elseif ($app_id == 6) {
            $data_app = $datas;
            return view(
                'backend.accommodation.application.highOfficialHouseExchange.edit',
                compact('building_to_floor','acc_build', 'data_app', 'accommodationTypes',  'data', 'acc_app', 'app_id', 'a_id')
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
        $created_by = authInfo()['id'];
        $id = $request['applicationId'];
        
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
        /* =============New allotment code start ==========================*/
        if ($app_id == 1) {
                // dd($request);
            DB::beginTransaction();
            try {
                extract($_REQUEST);
                $result = DB::table('accommodation_applications')
                ->where('id', $id)
                ->update(
                    [
                        "date" => "$date_for",
                        "area_id" => "$area_id",
                        "flat_type_id" => "$flat_type_id",
                        "status" => "$status",
                        "updated_by" => "$created_by"
                    ]
                );

                
                if ($result) {
                    DB::commit();
                    if($status ==0){
                        return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Draft store successfully');
                    }else{
                       
                        return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                    }
                    
                } else {
                    return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                }
                    // if($result){
                    //     DB::commit();
                    //     return response()->json(['status'=>'success','message'=>\Lang::get('Data Successfully Updated')]);
                    // }else{
                    //     return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully Not Update')]);
                    // }

            } catch (\Exception $e) {
                DB::rollback();
                $errorMessage = $e->getMessage();
                $customMessage = "Exception! Something went wrong please try again!";

                \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
                /* ============= Cancel code start ==========================*/
            } elseif ($app_id == 2) {
                DB::beginTransaction();
                try {
                // $flat_id = $request['flat_id'];
                // //  approve application id
                // $flat_info = DB::select("select * from accommodation_applications WHERE application_from= $created_by and status = 5  and department_ar_by !='' and whips_ar_by !='' and flat_id =  $flat_id ");
                // $approve_application_id = $flat_info[0]->id;
                    extract($_REQUEST);
                    $result =   DB::table('accommodation_applications')
                    ->where('id', $id)
                    ->update(
                        [
                            "date" => "$date_for",
                            "description" => "$description",
                            // "flat_id" => "$flat_id",
                            // "approve_application_id" => "$approve_application_id",
                            "status" => "$status",
                            "updated_by" => "$created_by"
                        ]
                    );

                    if($result){
                        DB::commit();
                        if($status ==0){
                            return response()->json(['status'=>'success','message'=>\Lang::get('Data Draft Update Successfully')]);
                        }else{
                          
                            return response()->json(['status'=>'success','message'=>\Lang::get('Data Update Successfully')]);
                        }
                        
                    }else{
                        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully Not Update')]);
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
                /* ============= Change code start ==========================*/
            } elseif ($app_id == 3) {
                DB::beginTransaction();
                try {
                 
                    extract($_REQUEST);
                    $result = DB::table('accommodation_applications')
                    ->where('id', $id)
                    ->update(
                        [
                            "application_type_id" => "$app_id",
                            "area_id" => "$area_id",
                            "date" => "$date_for",
                            "description" => "$description",
                            "status" => "$status",
                            "created_by" => "$created_by"
                        ]
                    );

                    if ($result) {
                        DB::commit();
                        if($status ==0){
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Draft store successfully');
                        }else{
                           
                            return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                        }
                        
                    } else {
                        return redirect()->route('backend.accommodation.application.index')->with('error', 'Data does not save successfully')->withInput();
                    }

                //     if($result){
                //         DB::commit();
                //         if($status ==0){
                //         return response()->json(['status'=>'success','message'=>\Lang::get('Data Draft Update Successfully')]);
                //     }else{
                    
                //     return response()->json(['status'=>'success','message'=>\Lang::get('Data Update Successfully')]);
                //     }
                    
                // }else{
                //     return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully Not Update')]);
                // }
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";

                    \Session::flash('error', $errorMessage, true);
                return redirect()->back()->withInput(); //If you want to go back
            }
            /* =============High offficial house New allotment code start ==========================*/
        }elseif ($app_id == 4) {
            // dd($id);
            DB::beginTransaction();
            try {
                extract($_REQUEST);
                $result = DB::table('accommodation_applications')
                ->where('id', $id)
                ->update(
                    [
                        "date" => "$date_for",
                        "status" => "$status",
                        "updated_by" => "$created_by"
                    ]
                );

                if ($result) {
                    DB::commit();
                    if($status ==0){
                        return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Draft store successfully');
                    }else{
                       
                        return redirect()->route('admin.accommodation.applications.mp.appNewList')->with('success', 'Data Saved successfully'); 
                    }
                    
                } else {
                    return redirect()->route('backend.accommodation.application.index')->with('error', 'Data does not save successfully')->withInput();
                }
                    // if($result){
                    //     DB::commit();
                    //     return response()->json(['status'=>'success','message'=>\Lang::get('Data Successfully Updated')]);
                    // }else{
                    //     return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully Not Update')]);
                    // }
            } catch (\Exception $e) {
                DB::rollback();
                $errorMessage = $e->getMessage();
                $customMessage = "Exception! Something went wrong please try again!";
                
                \Session::flash('error', $errorMessage, true);
                    return redirect()->back()->withInput(); //If you want to go back
                }
                /* =============High offficial house Cancel allotment code start ==========================*/
            }elseif ($app_id == 5) {
              
                DB::beginTransaction();
                try {
                //  approve application id
                // $flat_info = DB::select("select * from accommodation_applications WHERE application_from= $created_by and application_type_id = 4 and status = 5 ");
                // // dd($id);
                // $approve_application_id = $flat_info[0]->id;
                    extract($_REQUEST);
                    $result =   DB::table('accommodation_applications')
                    ->where('id', $id)
                    ->update(
                        [
                            "date" => "$date_for",
                            "description" => "$description",
                            // "approve_application_id" => "$approve_application_id",
                            "status" => "$status",
                            "updated_by" => "$created_by"
                        ]
                    );

                    if($result){
                        DB::commit();
                        if($status ==0){
                            return response()->json(['status'=>'success','message'=>\Lang::get('Data Draft Update Successfully')]);
                        }else{
                          
                            return response()->json(['status'=>'success','message'=>\Lang::get('Data Update Successfully')]);
                        }
                        
                    }else{
                        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully Not Update')]);
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    $errorMessage = $e->getMessage();
                    $customMessage = "Exception! Something went wrong please try again!";
                    
                    \Session::flash('error', $errorMessage, true);
                            return redirect()->back()->withInput(); //If you want to go back
                        }
                        /* =============High offficial house Exchange allotment code start ==========================*/
                    }elseif ($app_id == 6) {
                        DB::beginTransaction();
                        try {
                        //  approve application id
                        // $flat_info = DB::select("select * from accommodation_applications WHERE application_from= $created_by and application_type_id = 4 and status = 5 ");
                        // $approve_application_id = $flat_info[0]->id;
                            extract($_REQUEST);
                            $result = DB::table('accommodation_applications')
                            ->where('id', $id)
                            ->update(
                                [
                                    "subject" => "$subject",
                                    "application_type_id" => "$app_id",                            
                                    // "approve_application_id" => "$approve_application_id",
                                    "date" => "$date_for",
                                    "description" => "$description",
                                    "status" => "$status",
                                    "application_from" => "$created_by",
                                    "created_by" => "$created_by"
                                ]
                            );
                            if($result){
                                DB::commit();
                                if($status ==0){
                                    return response()->json(['status'=>'success','message'=>\Lang::get('Data Draft Update Successfully')]);
                                }else{
                                  
                                    return response()->json(['status'=>'success','message'=>\Lang::get('Data Update Successfully')]);
                                }
                                
                            }else{
                                return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully Not Update')]);
                            }
                        } catch (\Exception $e) {
                            DB::rollback();
                            $errorMessage = $e->getMessage();
                            $customMessage = "Exception! Something went wrong please try again!";
                            
                            \Session::flash('error', $errorMessage, true);
                        return redirect()->back()->withInput(); //If you want to go back
                    }
                }
                
                
            }


        /*
       New high official application view for mp
        */
       public function viewhighAppPending(Request $request, $id)
       {
        $application_id = $id;
        $data_id = DB::select("SELECT * FROM `accommodation_applications` WHERE id = $id");
        
        $app_user_id = $data_id[0]->application_from;
        $appli_id = $data_id[0]->id;
        $user_id = authInfo()['id'];
        
            // FROM hostel_applications ha
        $data['na']  = DB::select("SELECT a.id,a.application_type_id,a.application_from, a.subject,a.date,a.status,a.dept_submission_date,a.approval_date    
            FROM accommodation_applications a  WHERE  a.id = $application_id");
        
        $data['mp']  = DB::select("SELECT * FROM profiles WHERE user_id = $app_user_id ");
        
        if (!empty($h_b_List)) {
            return view('backend.accommodation.application.mp.viewHighAppPending', compact('application_id','data'));
        } else {
            return view('backend.accommodation.application.mp.viewHighAppPending', compact('application_id','data'));
        }
    }

          /*
       Cancel high official application view for mp
        */
       public function viewHighAppPendingExChange(Request $request, $id)
       {
        $user_id = authInfo()['id'];
        $application_id = $id;
        //Approve application information
        $data['ap'] = DB::select("SELECT a.id,a.description,a.application_type_id,a.application_from, a.subject,a.date,a.status,a.dept_submission_date FROM accommodation_applications a 
            WHERE application_from = $user_id and a.application_type_id = 4 and a.status = 4");

        $app_user_id = $data['ap'][0]->application_from; //Applicant
        $appli_id = $data['ap'][0]->id; //Application id
        
        $data['mp']  = DB::select("SELECT * FROM profiles WHERE user_id = $app_user_id");
        $data['na'] = DB::select("SELECT a.id,a.description,a.application_type_id,a.application_from, a.subject,a.date,a.status,a.dept_submission_date FROM accommodation_applications a 
            WHERE a.id = $application_id");
        return view('backend.accommodation.application.mp.viewhighAppPendingCancel', compact('application_id', 'data'));
    }
          /*
       Cancel high official application view for mp
        */
       public function viewHighAppPendingCancel(Request $request, $id)
       {
        $user_id = authInfo()['id'];
        $application_id = $id;
        //Approve application information
        $data['ap'] = DB::select("SELECT a.id,a.description,a.application_type_id,a.application_from, a.subject,a.date,a.status,a.dept_submission_date FROM accommodation_applications a 
            WHERE application_from = $user_id and a.status = 4");

        $app_user_id = $data['ap'][0]->application_from; //Applicant
        $appli_id = $data['ap'][0]->id; //Application id
        
        $data['mp']  = DB::select("SELECT * FROM profiles WHERE user_id = $app_user_id");
        $data['na'] = DB::select("SELECT a.id,a.description,a.application_type_id,a.application_from, a.subject,a.date,a.status,a.dept_submission_date FROM accommodation_applications a 
            WHERE a.id = $application_id");
        return view('backend.accommodation.application.mp.viewhighAppPendingCancel', compact('application_id', 'data'));
    }

    /*
       New application view for mp
        */
       public function viewAppPending(Request $request, $id){
            /* 
             Accommodation Application
        */

             $accommodation_applications = DB::table('accommodation_applications')->where('id',$id)->value('application_type_id');

             if($accommodation_applications ==1){
                $template_name = 'viewAppPending';
                $data['acappt'] = array("0"=>"বরাদ্দ", "1"=>"ফ্ল্যাট");
            }

            if($accommodation_applications ==2){
                $template_name = 'viewAppPendingCancel';
                $data['acappt'] = array("0"=>"বাতিল", "1"=>"ফ্ল্যাট");
            }

            if($accommodation_applications ==3){
                $template_name = 'viewAppPendingCancel';
                $data['acappt'] = array("0"=>"বাতিল", "1"=>"ফ্ল্যাট");
            }

        // $template_name = 'viewAppPending';
            $pdf_file_name = 'Test';
            
            $pdf_file_name = \Lang::get('Application For New Flat');
            $data['message'] = "hello.... I am Mr. Nothing";

            $data['app_data'] = DB::table('accommodation_applications AS a')
            ->leftJoin('accommodation_application_types AS acappt', 'acappt.id', '=', 'a.application_type_id')
            ->leftJoin('areas AS ar', 'ar.id', '=', 'a.area_id')
            ->leftJoin('profiles AS p', 'p.id', '=', 'a.created_by')
            ->leftJoin('constituencies AS con', 'con.id', '=', 'p.constituency_id')
            ->select('a.id','acappt.id as acappt_id', 'acappt.name_bn as acappt_name_bn', 'acappt.name as acappt_name',  'ar.name_bn as ar_name_bn','ar.name as ar_name','p.name_bn as p_name_bn','p.name_eng as p_name_eng','con.bn_name as con_bn_name','con.name as con_name', 'con.number')
            ->where('a.id', '=' ,$id)
            ->get();

            $data['acc_head'] = '<div class="head_title_acc">বরাবর 
            <br>
            মাননীয় চীফ হুইপ 
            <br>
            বাংলাদেশ জাতীয় সংসদ
            <br>
            ঢাকা ।
            </div>
            <div class="header_content_acc">বিষয়ঃ- মানিক মিয়া অ্যাভিনিউস্থ সংসদ-সদস্য ভবনের যে কোন একটি ফ্ল্যাট বরাদ্দ প্রসঙ্গে ।</div><br>

            <div>প্রিয় মহোদয়,</div>
            <div class="header_content_acc">                
            আপনার সদয় দৃষ্টি আকর্ষণ করে জানাচ্ছি যে, আমার সংসদীয় এলাকা ৫১ নওগাঁ -৬ এবং আমার বসবাসের সংসদ কোটায় একটি ফ্ল্যাট একান্ত প্রয়োজন ।<br>
            এমতাবস্থায়, মানিক মিয়া অ্যাভিনিউস্থ সংসদ-সদস্য  ভবনের যে কোন একটি ফ্ল্যাট সংসদ কোটায় আমার বরাদ্দ প্রদানের প্রয়োজনীয় ব্যবস্থা গ্রহনের জন্য বিশেষভাবে অনুরোধ জানাচ্ছি ।  </div>';
            
                // if($data['app_data'][0]->acappt_id==1){
                //     $data['acappt'] = array("0"=>"বরাদ্দ", "1"=>"ফ্ল্যাট");
                // }

            $pdf = PDF::loadView('backend.accommodation.application.mp.' . $template_name, $data);
        //$pdf->render();
        // return response()->download($pdf_file_name . '.pdf');
            return $pdf->stream($pdf_file_name . '.pdf');
        }
        public function viewAppPending_(Request $request, $id)
        {
            $application_id = $id;
            $data_id = DB::select("select * from accommodation_applications a
                LEFT JOIN accommodation_application_types as at on at.id = a.application_type_id WHERE a.id=$id");

            $app_user_id = $data_id[0]->created_by;
            $appli_id = $data_id[0]->id;
            $user_id = authInfo()['id'];
        // dorp down data
            $areaList = DB::table('areas')->get();
            $h_b_List = DB::table('house_buildings')->get();
            $floorList = DB::table('floors')->get();
            $officeRoom = DB::table('flats')->get();

        // FROM hostel_applications ha
            $data['na']  = DB::select("SELECT a.id,a.application_type_id,a.date,a.status, ar.id as area_id, ar.name as area_en, ar.name_bn as area_bn, ab.id,ab.name as ac_building_en, ab.name_bn as ac_building_bn,f.id, f.number as flat_size_en,f.number_bn as flat_no_bn, fl.id, fl.name as floor_en, fl.name_bn as floor_bn,at.name as at_name, at.name_bn as at_name_bn

                FROM accommodation_applications a
                LEFT JOIN areas as ar on ar.id = a.area_id
                LEFT JOIN accommodation_application_types as at on at.id = a.application_type_id
                LEFT JOIN accommodation_buildings ab on ab.id = a.accommodation_building_id
                LEFT JOIN flats f on f.id = a.flat_id
                LEFT JOIN floors fl on fl.id = a.floor_id WHERE  a.id = $application_id");

            $data['mp']  = DB::select("SELECT * FROM profiles WHERE user_id = $app_user_id ");
            
            if (!empty($h_b_List)) {
                return view('backend.accommodation.application.mp.viewAppPending', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
            } else {
                return view('backend.accommodation.application.mp.viewAppPending', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
            }
        }

    /*
       Change application view for mp
        */
       public function viewAppPendingChange(Request $request, $id)
       {
        $user_id = authInfo()['id'];
        // master data
        $areaList = DB::table('areas')->get();
        $h_b_List = DB::table('house_buildings')->get();
        $floorList = DB::table('floors')->get();
        $officeRoom = DB::table('flats')->get();

        $application_id = $id;
        //Approve application information
        $data['ap'] = DB::select("SELECT a.id,a.whips_ar_date, a.whips_ar_by,a.department_ar_by,a.department_ar_date,a.description,a.application_type_id,a.application_from, a.subject,a.date,a.status,a.dept_submission_date,a.approval_date, ar.id as area_id, ar.name as area_en, ar.name_bn as area_bn, ab.id,ab.name as ac_building_en, ab.name_bn as ac_building_bn,f.id, f.number as flat_size_en,f.number_bn as flat_no_bn, fl.id, fl.name as floor_en, fl.name_bn as floor_bn,ft.size as size_bn FROM accommodation_applications a LEFT JOIN areas as ar on ar.id = a.area_id LEFT JOIN accommodation_buildings ab on ab.id = a.accommodation_building_id LEFT JOIN flats f on f.id = a.flat_id LEFT JOIN flat_types ft on ft.id = f.flat_type_id LEFT JOIN floors fl on fl.id = a.floor_id 
            WHERE application_from = $user_id and a.status = 4");

        $app_user_id = $data['ap'][0]->application_from; //Applicant
        $appli_id = $data['ap'][0]->id; //Application id

        $data['mp']  = DB::select("SELECT * FROM profiles WHERE user_id = $app_user_id");

        $data['na'] = DB::select("SELECT a.id,a.description,a.application_type_id,a.application_from, a.subject,a.date,a.status,a.dept_submission_date,a.approval_date, ar.id as area_id, ar.name as area_en, ar.name_bn as area_bn, ab.id,ab.name as ac_building_en, ab.name_bn as ac_building_bn,f.id, f.number as flat_size_en,f.number_bn as flat_no_bn, fl.id, fl.name as floor_en, fl.name_bn as floor_bn,ft.size as size_bn FROM accommodation_applications a LEFT JOIN areas as ar on ar.id = a.area_id LEFT JOIN accommodation_buildings ab on ab.id = a.accommodation_building_id LEFT JOIN flats f on f.id = a.flat_id LEFT JOIN flat_types ft on ft.id = f.flat_type_id LEFT JOIN floors fl on fl.id = a.floor_id
            WHERE a.id = $application_id");
        
        return view('backend.accommodation.application.mp.viewAppPendingChange', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
    }

    /*
       Cancel application view for mp
        */
       public function viewAppPendingCancel(Request $request, $id)
       {
        $user_id = authInfo()['id'];
        // master data
        $areaList = DB::table('areas')->get();
        $h_b_List = DB::table('house_buildings')->get();
        $floorList = DB::table('floors')->get();
        $officeRoom = DB::table('flats')->get();
        
        $application_id = $id;
        //Approve application information
        $data['ap'] = DB::select("SELECT a.id,a.description,a.application_type_id,a.application_from, a.subject,a.date,a.status,a.dept_submission_date,a.approval_date, ar.id as area_id, ar.name as area_en, ar.name_bn as area_bn, ab.id,ab.name as ac_building_en, ab.name_bn as ac_building_bn,f.id, f.number as flat_size_en,f.number_bn as flat_no_bn, fl.id, fl.name as floor_en, fl.name_bn as floor_bn,ft.size as size_bn FROM accommodation_applications a LEFT JOIN areas as ar on ar.id = a.area_id LEFT JOIN accommodation_buildings ab on ab.id = a.accommodation_building_id LEFT JOIN flats f on f.id = a.flat_id LEFT JOIN flat_types ft on ft.id = f.flat_type_id LEFT JOIN floors fl on fl.id = a.floor_id 
            WHERE application_from = $user_id and a.status = 4");

        $app_user_id = $data['ap'][0]->application_from; //Applicant
        $appli_id = $data['ap'][0]->id; //Application id
        
        $data['mp']  = DB::select("SELECT * FROM profiles WHERE user_id = $app_user_id");

        $data['na'] = DB::select("SELECT a.id,a.description,a.application_type_id,a.application_from, a.subject,a.date,a.status,a.dept_submission_date,a.approval_date, ar.id as area_id, ar.name as area_en, ar.name_bn as area_bn, ab.id,ab.name as ac_building_en, ab.name_bn as ac_building_bn,f.id, f.number as flat_size_en,f.number_bn as flat_no_bn, fl.id, fl.name as floor_en, fl.name_bn as floor_bn,ft.size as size_bn FROM accommodation_applications a LEFT JOIN areas as ar on ar.id = a.area_id LEFT JOIN accommodation_buildings ab on ab.id = a.accommodation_building_id LEFT JOIN flats f on f.id = a.flat_id LEFT JOIN flat_types ft on ft.id = f.flat_type_id LEFT JOIN floors fl on fl.id = a.floor_id 
            WHERE a.id = $application_id");

        return view('backend.accommodation.application.mp.viewAppPendingCancel', compact('application_id', 'officeRoom', 'h_b_List', 'data', 'areaList', 'floorList'));
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
            DB::table('accommodation_applications')
            ->where('id', $id)
            ->delete();
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";
            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }

    public function application_list_mp()
    {
        // draft and pending
        $user_id = authInfo()['id'];
        $acc_app = DB::select("select * from accommodation_applications WHERE application_from=$user_id and application_type_id = 1 and (status = 1 or status = 0) ");

        if (!empty($acc_app)) {
            return view('backend.accommodation.application.application_list_mp', compact('acc_app'));
        } else {
            return redirect()->route('admin.accommodation.applications.index')->with('danger', 'Flat or House not found for cancel');
        }
    }

    /*
       New application list for mp
        */
       public function appNewList()
       {
        // draft and pending
        $user_id = authInfo()['id'];
        $acc_app = DB::select("select at.name, at.name_bn,a.status,a.id, a.created_at, a.application_type_id  from accommodation_applications a
            LEFT JOIN accommodation_application_types as at on at.id = a.application_type_id WHERE a.created_by=$user_id order by a.id desc");
        
        if (!empty($acc_app)) {
            if (isApi()) {
                $response['acc_status_msg']    = [
                    ['status'=>0,'message'=>'খসড়া'],
                    ['status'=>1,'message'=>'বিবেচনাধীন'],
                    ['status'=>2,'message'=>'এপ্রুভ (ডিপার্ট্মেন্ট)'],
                    ['status'=>3,'message'=>'বাতিল (ডিপার্ট্মেন্ট)'],
                    ['status'=>4,'message'=>'এপ্রুভ (হুইপ)'],
                    ['status'=>5,'message'=>'বাতিল (হুইপ)']
                ];
                
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = compact('acc_app');
                return response()->json($response);
            }
            return view('backend.accommodation.application.mp.appNewList', compact('acc_app'));
        } else {

            if (isApi()) {
                $response['acc_status_msg']    = [
                    ['status'=>0,'message'=>'খসড়া'],
                    ['status'=>1,'message'=>'বিবেচনাধীন'],
                    ['status'=>2,'message'=>'এপ্রুভ (ডিপার্ট্মেন্ট)'],
                    ['status'=>3,'message'=>'বাতিল (ডিপার্ট্মেন্ট)'],
                    ['status'=>4,'message'=>'এপ্রুভ (হুইপ)'],
                    ['status'=>5,'message'=>'বাতিল (হুইপ)']
                ];
                
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = compact('acc_app');
                return response()->json($response);
            }
            return view('backend.accommodation.application.mp.appNewList', compact('acc_app'));
        }
    }

    /*
      Log information for admin
        */
      public function logInformation()
      {
        $user_id = authInfo()['id'];
        $acc_app = DB::select("select * from accommodation_log ");
        return view('backend.accommodation.application.logInformation', compact('acc_app'));
        
    }

    public function logInformationDetail($id)
    {
        $acc_app = DB::select("select * from accommodation_log where id = $id ");
        return view('backend.accommodation.application.log-information-detail', compact('acc_app'));
    }


    /*
       Cancel application list for mp
        */
       public function appCancelMpList()
       {
        // draft and pending
        $user_id = authInfo()['id'];
        $acc_app = DB::select("select * from accommodation_applications WHERE application_from=$user_id and application_type_id =2");
        if (!empty($acc_app)) {
            return view('backend.accommodation.application.mp.appCancelMpList', compact('acc_app'));
        } else {
            return view('backend.accommodation.application.mp.appCancelMpList', compact('acc_app'));
        }
    }
    /*
       Change application list for mp
        */
       public function appChangeMpList()
       {
        // draft and pending
        $user_id = authInfo()['id'];
        $acc_app = DB::select("select * from accommodation_applications WHERE application_from=$user_id and application_type_id =3");
        if (!empty($acc_app)) {
            return view('backend.accommodation.application.mp.appChangeMpList', compact('acc_app'));
        } else {
            return view('backend.accommodation.application.mp.appChangeMpList', compact('acc_app'));
        }
    }

    public function create_pdf(Request $request, $id)
    {
        $template_name = 'application_list';
        $pdf_file_name = 'Test_File_name';

        $pdf_file_name = \Lang::get('Acceptable List');
        $data['message'] = "hello.... I am Mr. Nothing";
        $query = "SELECT a.id, acappt.name_bn, acappt.name, ar.name_bn,ar.name,act.name_bn,act.name_bn,p.name_bn,p.name_eng,con.bn_name,con.name FROM accommodation_applications a LEFT JOIN accommodation_application_types acappt on acappt.id = a.application_type_id LEFT JOIN areas ar on ar.id = a.area_id LEFT JOIN accommodation_types act on act.id = a.application_type_id LEFT JOIN profiles p on p.user_id = a.created_by LEFT JOIN constituencies con on con.id = p.constituency_id";
        $where = '';

        $where = $id;

        $data['acc_head'] = '<div class="head_title_acc">বরাবর 
        <br>
        মাননীয় চীফ হুইপ 
        <br>
        বাংলাদেশ জাতীয় সংসদ
        <br>
        ঢাকা ।
        </div>
        <div class="header_content_acc">বিষয়ঃ- মানিক মিয়া অ্যাভিনিউস্থ সংসদ-সদস্য ভবনের যে কোন একটি ফ্ল্যাট বরাদ্দ প্রসঙ্গে ।</div><br>

        <div>প্রিয় মহোদয়,</div>
        <div class="header_content_acc">                
        আপনার সদয় দৃষ্টি আকর্ষণ করে জানাচ্ছি যে, আমার সংসদীয় এলাকা ৫১ নওগাঁ -৬ এবং আমার বসবাসের সংসদ কোটায় একটি ফ্ল্যাট একান্ত প্রয়োজন ।<br>
        এমতাবস্থায়, মানিক মিয়া অ্যাভিনিউস্থ সংসদ-সদস্য  ভবনের যে কোন একটি ফ্ল্যাট সংসদ কোটায় আমার বরাদ্দ প্রদানের প্রয়োজনীয় ব্যবস্থা গ্রহনের জন্য বিশেষভাবে অনুরোধ জানাচ্ছি ।  </div>';

        $data['acc_list'] = DB::select($query . $where);

        // dd($data);

        $pdf = PDF::loadView('backend.pdf.' . $template_name, $data);
        //$pdf->render();
        //return response()->download($pdf_file_name . '.pdf');
        return $pdf->stream($pdf_file_name . '.pdf');
    }


    public function application_department_approved()
    {
        // approved applications 
        $acc_app = DB::table('accommodation_applications')
        ->select('*')
        ->join('users', 'users.id', '=', 'accommodation_applications.created_by')
        ->where('accommodation_applications.status', 4)
        ->get();

        if (!empty($acc_app)) {
            return view('backend.accommodation.application.application_department_approved', compact('acc_app'));
        } else {
            return redirect()->route('backend.accommodation.application.application_list')->with('danger', 'Flat or House not found for cancel');
        }
    }
    
}
