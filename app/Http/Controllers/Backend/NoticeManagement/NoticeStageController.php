<?php

namespace App\Http\Controllers\Backend\NoticeManagement;


use App\Model\NoticeStage;
use App\Model\Role;
use App\Model\ParliamentRule;
use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use Auth;

class NoticeStageController extends Controller
{

    public function index()
    {
       // loggedin user's role: authInfo()->user_role->pluck('role_id')->toArray();
        $data['stage_list'] = NoticeStage::leftJoin('parliament_rules', 'notice_stages.rule_number', '=', 'parliament_rules.rule_number')
            ->leftJoin('roles', 'roles.id', '=', 'notice_stages.role_id')
            ->select('notice_stages.*', 'parliament_rules.name as rule_name', 'parliament_rules.rule_number', 'roles.name_bn as user_role_name')
            ->orderBy('parliament_rules.rule_number', 'desc')
            ->get();
        return view('backend.noticeManagement.notice_stage.index', $data);
    }


    public function create()
    {
        $data['existingData'] = new NoticeStage();
        $data['user_role_list'] = Role::where('status', 1)->orderBy('id', 'desc')->get();
        $data['parliament_rule_list'] = ParliamentRule::where('status', 1)->orderBy('id', 'desc')->get();
        return view('backend.noticeManagement.notice_stage.form', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'rule_number' => 'required',
            'role_id' => 'required',
            'stage' => 'required'
        ];
        $message = [
            'rule_number' => 'required',
            'role_id' => 'required',
            'stage' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {

            if (isApi()) {
                
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = $validator;
                return response()->json($response);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $stage = new NoticeStage();
            $stage->fill($request->all());
            $result = $stage->save();

            if ($result) {
                return redirect()->route('admin.notice_management.noticestage.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.notice_management.noticestage.create')->with('error', 'Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }


    public function edit($id)
    {
        $data['existingData'] = NoticeStage::findOrFail($id);
        $data['user_role_list'] = Role::where('status', 1)->orderBy('id', 'desc')->get();
        $data['parliament_rule_list'] = ParliamentRule::where('status', 1)->orderBy('id', 'desc')->get();
        return view('backend.noticeManagement.notice_stage.form', $data);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'rule_number' => 'required',
            'role_id' => 'required',
            'stage' => 'required'
        ];
        $message = [
            'rule_number' => 'required',
            'role_id' => 'required',
            'stage' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {

            if (isApi()) {
                
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = $validator;
                return response()->json($response);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $stage = NoticeStage::find($id);
            $data = $request->all();
            $data['status'] = $request->status ?? 0;
            $result = $stage->update($data);

            if ($result) {
                return redirect()->route('admin.notice_management.noticestage.index')->with('success', 'Data Updated successfully');
            } else {
                return redirect()->route('admin.notice_management.noticestage.edit', [$id])->with('error', 'Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    public function destroy($id)
    {
        try {
            $stage = NoticeStage::find($id);
            $stage->delete();
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(['status' => 'error']);
        }
    }
}
