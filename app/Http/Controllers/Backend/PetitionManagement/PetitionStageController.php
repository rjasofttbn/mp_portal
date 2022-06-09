<?php

namespace App\Http\Controllers\Backend\PetitionManagement;

use App\Http\Controllers\Controller;
use App\Model\PetitionStage;
use App\Model\Role;
use App\Model\ParliamentRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetitionStageController extends Controller
{
    public function index()
    {
        $data['stage_list'] = PetitionStage::leftJoin('parliament_rules', 'petition_stages.rule_number', '=', 'parliament_rules.rule_number')
            ->leftJoin('roles', 'roles.id', '=', 'petition_stages.role_id')
            ->select('petition_stages.*', 'parliament_rules.name as rule_name', 'parliament_rules.rule_number', 'roles.name_bn as user_role_name')
            ->orderBy('parliament_rules.rule_number', 'desc')
            ->get();
        return view('backend.petitionManagement.petition_stage.index', $data);
    }


    public function create()
    {
        $data['existingData'] = new PetitionStage();
        $data['user_role_list'] = Role::where('status', 1)->orderBy('id', 'desc')->get();
        $data['parliament_rule_list'] = ParliamentRule::where('status', 1)->orderBy('id', 'desc')->get();
        return view('backend.petitionManagement.petition_stage.form', $data);
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
            $stage = new PetitionStage();
            $stage->fill($request->all());
            $result = $stage->save();

            if ($result) {
                return redirect()->route('admin.petition_management.petitionstage.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.petition_management.petitionstage.create')->with('error', 'Data does not save successfully')->withInput();
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
        $data['existingData'] = PetitionStage::findOrFail($id);
        $data['user_role_list'] = Role::where('status', 1)->orderBy('id', 'desc')->get();
        $data['parliament_rule_list'] = ParliamentRule::where('status', 1)->orderBy('id', 'desc')->get();
        return view('backend.petitionManagement.petition_stage.form', $data);
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
            $stage = PetitionStage::find($id);
            $data = $request->all();
            $data['status'] = $request->status ?? 0;
            $result = $stage->update($data);

            if ($result) {
                return redirect()->route('admin.petition_management.petitionstage.index')->with('success', 'Data Updated successfully');
            } else {
                return redirect()->route('admin.petition_management.petitionstage.edit', [$id])->with('error', 'Data does not update successfully')->withInput();
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
            $stage = PetitionStage::find($id);
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
