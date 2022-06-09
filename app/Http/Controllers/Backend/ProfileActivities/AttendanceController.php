<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 4/12/20
 * Time: 11:40 AM
 */

namespace App\Http\Controllers\Backend\ProfileActivities;


use App\Model\ParliamentSession;
use App\Model\Parliament;
use App\Model\Attendance;
use App\Model\Profile;
use App\Http\Controllers\Controller;

use App\Model\ResidentialBuilding;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\AttendanceRequest;
use App\Model\Mpattendance;
use Illuminate\Support\Facades\Validator;
use Auth;

class AttendanceController extends Controller
{

    public function __construct()
    {
    }


    /* Author: Rajan Bhatta
    Created Date: 01-02-2021*/

    public function index()
    {

        $data = Attendance::orderBy('id', 'desc')->get();


        return view('backend.profileActivities.attendance.index', compact('data'));
    }


    /* Author: Rajan Bhatta
   Created Date: 01-02-2021*/
    public function create(Request $request)
    {
        $data = new Attendance();
        $title = "Create";

        $parliamentList = Parliament::orderBy('id', 'desc')->get();
        $userList = authInfo();

        $profileList = Profile::orderBy('name_bn', 'asc')->get();
        $sessionList = array();

        return view('backend.profileActivities.attendance.form', compact('data', 'title', 'sessionList', 'parliamentList', 'userList', 'profileList'));
    }

    /* Author: Rajan Bhatta
   Created Date: 01-02-2021*/
    public function store(AttendanceRequest $request)
    {



        try {
            if ($request->isMethod("POST")) {
                $attendanceEloquent = new Attendance();
                $request['created_by'] = authInfo()->id;
                //$request['status']= 1;

                $request['date'] = isset($request['date']) ? date('Y-m-d', strtotime($request['date'])) : '';

                $attendanceEloquent->fill($request->all());
                $result = $attendanceEloquent->save();

                if ($result) {
                    return redirect()->route('admin.attendance.index')->with('success', 'Attendance Saved successfully');
                } else {
                    return redirect()->route('admin.attendance.create')->with('error', 'Attendance does not save successfully')->withInput();
                }
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }


    /* Author: Rajan Bhatta
   Created Date: 01-02-2021*/
    /* public function edit($id)
     {
         $data=Attendance::findOrFail($id);
         $title="Edit";

         $parliamentList =Parliament::orderBy('parliament_number', 'asc')->get();
         $sessionList =ParliamentSession::where('parliament_id',$data->parliament->id)->orderBy('id', 'desc')->get();

         $userList =User::orderBy('name', 'asc')->get();

         return view('profileActivities.attendance.form', compact('data', 'title', 'sessionList', 'parliamentList', 'userList'));

     }*/


    /*  /* Author: Rajan Bhatta
     Created Date: 01-02-2021*/
    /*public function update(AttendanceRequest $request, $id) {

        try {
            if ($request->isMethod("PUT")) {

                $attendanceEloquent = Attendance::find($id);
                $request['updated_by']= authInfo()->id;
                $result = $attendanceEloquent->update($request->all());

                if($result){
                    return redirect()->route('admin.attendance.index')->with('success','Data Updated successfully');
                }else{
                    return redirect()->route('admin.attendance.edit', [$id])->with('error','Data does not update successfully')->withInput();
                }
            }
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }*/

    /* Author: Rajan Bhatta
   Created Date: 01-02-2021*/

    public function destroy(Request $request)
    {
        try {
            if ($request->id) {
                $attendanceEloquent = Attendance::find($request->id);
                $response = $attendanceEloquent->delete();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    public function myAttendanceList()
    {
        $parliamentList = Parliament::orderBy('id', 'desc')->get();

        $login_user_id = authInfo()->id;
        $data = Attendance::where('user_id', $login_user_id)->orderBy('id', 'desc')->get();


        return view('backend.profileActivities.myAttendance.index', compact('data', 'parliamentList'));
    }


    public function parliamentSessionWiseMyattendanceSearch(Request $request)
    {



        $parliament_id = $request->parliament_id;
        $session_id = $request->session_id;

        $login_user_id = authInfo()->id;

        //DB::enableQueryLog();
        $where = [];
        $where[] = ['user_id', '=', $login_user_id];


        if ($parliament_id && ($parliament_id != 0)) {
            $where[] = ['parliament_id', '=', $parliament_id];
        }


        if ($session_id && ($session_id != 0)) {
            $where[] = ['session_id', '=', $session_id];
        }

        $data = Attendance::where($where)->orderBy('id', 'asc')->get();

        //dd($data->toArray());
        //dd(DB::getQueryLog());


        $loadMyAttendanceListHtml = view('backend.profileActivities.myAttendance.grid', compact('data'))->render();

        if ($data->count()) {
            $status = 1;
            $msg = "";
        } else {
            $status = 0;
            $msg = "Attendance Not Found";
        }

        return response()->json(array(
            "status" => $status,
            "msg" => $msg,
            "loadMyAttendanceListHtml" => $loadMyAttendanceListHtml,
        ));
    }

    /*  Enayet Hossain starts here.... */
    public function mpAttendance()
    {
        $data['mp_list'] = Profile::where('status', 1)->get();
        $data['session_list'] = ParliamentSession::where('status', 1)->get();
        $data['time_list'] = [];
        return view('backend.profileActivities.attendance.import_attendance', $data);
    }

    public function saveAttendance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            //'mp_id'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $attendance = new Mpattendance();

        $attendance->date = date('Y-m-d H:i:s', strtotime($request->date));
        $attendance->mp_id = $request->mp_id;
        $attendance->created_by = authInfo()->id;
        $attendance->isPresent = ($request->isPresent === 'on') ? 1 : 0;
        $attendance->checkin_time = date('H:i:s', strtotime($request->checkin_time));
        $attendance->checkout_time = date('H:i:s', strtotime($request->checkout_time));

        if ($attendance->save()) {
            return Response()->json([
                "success" => true
            ]);
        } else {
            return Response()->json([
                "success" => false
            ]);
        }
    }


    public function importAttendance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_date' => 'required',
            //'import_file'  => 'required|mimes:csv|max:5048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $request->import_date = date('Y-m-d H:i:s', strtotime($request->import_date));

        if ($files = $request->file('import_file')) {
            $extension = $files->getClientOriginalExtension();
            $filename = 'attendance' . '_' . time() . random_int(0, 1000) . '.' . $extension; // Make a file name
            $folder = public_path('/backend/attachment/'); // Define folder path
            $files->move($folder, $filename); // Upload image

            $main_file = public_path('/backend/attachment/' . $filename);
            //$mpData = csvToArray($main_file);

            $csvData = file_get_contents($main_file);
            $lines = explode(PHP_EOL, $csvData);
            $mpData = array();
            foreach ($lines as $line) {
                $mpData[] = str_getcsv($line);
            }

            $data = [];
            for ($i = 0; $i < count($mpData)-1; $i++) {
                $data[] = [
                    'date' => $request->import_date,
                    'mp_id' => $mpData[$i][0],
                    'isPresent' => $mpData[$i][1],
                    'checkin_time' => $mpData[$i][2],
                    'checkout_time' => $mpData[$i][3],
                    'created_by' => authInfo()->id
                ];
            }

            //dd($data);


            DB::table('mpattendances')->insert($data);
            return Response()->json([
                "success" => true
            ]);
        }
    }

    public function listAttendance(Request $request)
    {
        $selected_date = explode("~",$request->date);
        $mp_id = $request->mp_id;
        $session_id = $request->parliament_session_id;
        $where = "";

        if ($session_id != '') {
            $session_data = ParliamentSession::where('id', $session_id)->first();
            $start = date('Y-m-d', strtotime($session_data->date_from));
            $end = date('Y-m-d', strtotime($session_data->date_to));
            $where .= " and date between '" . $start . "' and '" . $end . "'";
        } else if ($selected_date != '') {
            $start = date('Y-m-d', strtotime($selected_date[0]));
            $end = date('Y-m-d', strtotime($selected_date[1]));
            $where .= " and date between '" . $start . "' and '" . $end . "'";
        }


        $final_result = ' <table id="list_orders_table" class="table table-sm table-bordered table-striped"> <thead> <tr> <th>' . \Lang::get("Date") . '</th> <th>' . \Lang::get("MP Name") . '</th><th>' . \Lang::get("Present") . '</th> <th>' . \Lang::get("Check In") . '</th><th>' . \Lang::get("Check Out") . '</th></tr></thead><tbody>';

        $query = "select a.*, p.name_bn as mp_name from mpattendances a left join profiles p on p.user_id = a.mp_id where a.id>0 ";  //Mpattendance::whereBetween('date', [$start, $end])->get();

        if ($mp_id != '') {
            $where .= ' and a.mp_id=' . $mp_id;
        }

        $record_list = DB::select($query . $where);

        if (count($record_list) > 0) {
            if (isApi()) {
                $response['status'] = 'success';
                $response['message'] = '';
                $response['api_info']    = $record_list;
                return response()->json($response);
            }
            foreach ($record_list as $r) {
                $r->isPresent = ($r->isPresent == 1) ? \Lang::get('Yes') : \Lang::get('No');
                $final_result .= '<tr><td>' . digitDateLang(nanoDateFormat($r->date)) . '</td><td>' . $r->mp_name . '</td><td>' . $r->isPresent . '</td><td>' . digitDateLang($r->checkin_time) . '</td><td>' . digitDateLang($r->checkout_time) . '</td></tr>';
            }
            $final_result .= '</tbody></table>';
            return json_encode(array('status' => true, 'data' => $final_result), true);
        }
    }
}
