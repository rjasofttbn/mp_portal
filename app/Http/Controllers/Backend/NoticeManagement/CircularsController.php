<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 4/12/20
 * Time: 11:40 AM
 */

namespace App\Http\Controllers\Backend\NoticeManagement;


use App\Http\Controllers\Controller;
use App\Http\Requests\NoticeRulesRequest;
use App\Model\Circular;
use App\Model\Department;
use App\Model\Ministry;
use App\Model\MinistryWings;
use App\Model\ParliamentSession;
use App\Model\Notice;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;


class CircularsController extends Controller
{

    public function index()
    {
        $session_list = ParliamentSession::where('status', 1)->get();

        return view('backend.noticeManagement.circulars.index', compact('session_list'));
    }

    public function CircularPushFromPRP(Request $request){
        if($request->token == 'EmBxttK6cb2wnRd6tSojz9O5jhjkyuisRdyPnkkDjkkjgfgfEKb53zaA6OWEHPd2Zjl'){
            
            if(!$request->parliament_session_id){
                return response()->json(['status'=>'error','message'=>'Parliament Session required']);
            }

            if(!$request->date){
                return response()->json(['status'=>'error','message'=>'date required']);
            }

            if(!$request->ministry_id){
                return response()->json(['status'=>'error','message'=>'Ministry required']);
            }

            if(!$request->circular_no){
                return response()->json(['status'=>'error','message'=>'Circular No required']);
            }

            DB::beginTransaction();
            try {            
                $where = [];
                $where[] = ['parliament_session_id','=',$request->parliament_session_id];
                $where[] = ['date','=',date('Y-m-d',strtotime($request->date))];
                $where[] = ['ministry_id','=',$request->ministry_id];
                $exist_circular = Circular::where($where)->first();

                if($exist_circular){
                    $store  = $exist_circular;
                }else{
                    $store  = new Circular();
                }

                $store->parliament_session_id = $request->parliament_session_id;
                $store->date = date('Y-m-d',strtotime($request->date));
                $store->ministry_id = $request->ministry_id;
                $store->circular_no = $request->circular_no;
                $store->circular_pdf_url = $request->circular_pdf_url;
                $store->save();
                DB::commit();

                if($exist_circular){
                    return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Updated')]);
                }else{
                    return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status'=>'error','message'=>'You are facing some error']);
                dd($e);
            }
        }else{
            return response()->json(['status'=>'error','message'=>'Token Mismatch']);

        }

    }

    public function listCircular(Request $request)
    {
        $parliament_session_id = $request->parliament_session_id;
        $call_type = $request->call_type;
        if ($call_type == 'api_call') {
            //call the external api
            //since we dont have any api at this moment ... just use a dummy json file
            $session_list = ParliamentSession::where('status', 1)->get();
            $ministry_list = Ministry::where('status', 1)->get();
            $wing_list = MinistryWings::where('status', 1)->get();

            $final_result = ' <table id="load_circular_table" class="table table-sm table-bordered table-striped"> <thead> <tr> <th>' . \Lang::get("Date") . '</th> <th>' . \Lang::get("Ministry") . '</th> <th>' . \Lang::get("Ministry Wings") . '</th> </tr></thead><tbody>';
            $json_data = '[
            {"parliament_session_id":"2","date":"2021-06-15","ministry_id":"1","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-15","ministry_id":"13","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-15","ministry_id":"20","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-15","ministry_id":"28","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-15","ministry_id":"31","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-16","ministry_id":"17","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-16","ministry_id":"23","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-16","ministry_id":"32","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-16","ministry_id":"16","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-17","ministry_id":"11","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-17","ministry_id":"33","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-17","ministry_id":"34","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-17","ministry_id":"35","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-18","ministry_id":"12","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-18","ministry_id":"36","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-19","ministry_id":"19","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-19","ministry_id":"9","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-19","ministry_id":"26","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-19","ministry_id":"3","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-19","ministry_id":"4","created_at":null,"updated_at":null},
            {"parliament_session_id":"2","date":"2021-06-19","ministry_id":"15","created_at":null,"updated_at":null}
            ]';
            $data = json_decode($json_data, true);
            foreach ($data as $d) {
                $d['wing_name'] = "";
                $d['ministry_name'] = "";
                foreach ($session_list as $s) {
                    if ($d['parliament_session_id'] == $s->id) {
                        $d['session_no'] = $s->session_no;
                    }
                }
                foreach ($ministry_list as $m) {
                    if ($d['ministry_id'] == $m->id) {
                        $d['ministry_name'] = $m->name_bn;
                    }
                }
                foreach ($wing_list as $w) {
                    if ($d['ministry_id'] == $w->ministry_id) {
                        $d['wing_name'] .= $w->name_bn . ' , ';
                    }
                }
                $final_result .= '<tr><td>' . digitDateLang(nanoDateFormat($d['date'])) . '</td><td>' . $d['ministry_name'] . '</td><td>' . $d['wing_name'] . '</td></tr>';
            }
            $final_result .= '</tbody></table>';
            //$final_result = 'Hello i am a result of API Call'; //[];
            return json_encode(array('status' => true, 'data' => $final_result), true);
        } else if ($call_type == 'list') {
            $final_result = ' <table id="list_circular_table" class="table table-sm table-bordered table-striped"> <thead> <tr> <th>' . \Lang::get("Date") . '</th> <th>' . \Lang::get("Ministry") . '</th> <th>' . \Lang::get("Ministry Wings") . '</th> </tr></thead><tbody>';

            $circular_list = Circular::where('parliament_session_id', $parliament_session_id)
                ->leftJoin('ministries', 'circulars.ministry_id', '=', 'ministries.id')
                ->leftJoin('ministry_wings', 'circulars.ministry_id', '=', 'ministry_wings.ministry_id')
                ->select('circulars.*', 'ministries.name_bn as ministry_name', 'ministry_wings.name_bn as wing_name')
                ->get();
            if (count($circular_list) > 0) {
                foreach ($circular_list as $c) {
                    $final_result .= '<tr><td>' . digitDateLang(nanoDateFormat($c->date)) . '</td><td>' . $c->ministry_name . '</td><td>' . $c->wing_name . '</td></tr>';
                }

                $final_result .= '</tbody></table>';
                //$final_result = 'Hello i am a result of API Call'; //[];
                return json_encode(array('status' => true, 'data' => $final_result), true);
            } else {
                return json_encode(array('status' => false), true);
            }
        }
    }
}
