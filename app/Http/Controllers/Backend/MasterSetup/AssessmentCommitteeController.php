<?php

namespace App\Http\Controllers\Backend\MasterSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssessmentCommittee;
use App\Model\Profile;
use App\Model\Parliament;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AssessmentCommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['committees'] = AssessmentCommittee::orderBy('id', 'asc')->get();
        $data['profiles'] = Profile::orderBy('id', 'asc')->get();
      

        return view('backend.master_setup.assessment_committee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['profiles'] = Profile::orderBy('id', 'asc')->get();
        $data['parliaments'] = Parliament::where('status', 1)->first();

        return view('backend.master_setup.assessment_committee.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // validation
        $rules = [
            'parliament_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'user_id' => 'required',
            'designation' => 'required',
        ];
        $message = [
            'parliament_id.required' => 'The Parliament field is required.',
            'date_from.required' => 'The Date from field is required.',
            'date_to.required' => 'The Date to field is required.',
            'user_id.required' => 'The Name field is required.',
            'designation.required' => 'The Designation field is required.',
        ];


        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Database Insert
        $user_id = json_encode($request->input('user_id'));
        $designation = json_encode($request->input('designation'));

        try {
            $committee = new AssessmentCommittee();
            $request['user_id'] = $user_id;
            $request['designation'] = $designation;
            $committee->fill($request->all());
            $result = $committee->save();

            if($result){
                return redirect()->route('admin.master_setup.assessment_committees.index')->with('success','Data Saved successfully');
            }else{
                return redirect()->route('admin.master_setup.assessment_committees.create')->with('error','Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

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
        $data['editData'] = AssessmentCommittee::find($id);
        $data['profiles'] = Profile::orderBy('id', 'asc')->get();
        $data['parliaments'] = Parliament::where('status', 1)->first();
        $data['committees'] = json_decode($data['editData']['user_id'], true);
        $data['designations'] = json_decode($data['editData']['designation'], true);

        return view('backend.master_setup.assessment_committee.edit', $data);
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
        
        // validation
        $rules = [
            'parliament_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'user_id' => 'required',
            'designation' => 'required',
        ];
        $message = [
            'parliament_id.required' => 'The Parliament field is required.',
            'date_from.required' => 'The Date from field is required.',
            'date_to.required' => 'The Date to field is required.',
            'user_id.required' => 'The Name field is required.',
            'designation.required' => 'The Designation field is required.',
        ];


        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_id = json_encode($request->input('user_id'));
        $designation = json_encode($request->input('designation'));

        try {
            $committee = AssessmentCommittee::find($id);
            $request['user_id'] = $user_id;
            $request['designation'] = $designation;
            $committee->fill($request->all());
            $result = $committee->update();

            if ($result) {
                return redirect()->route('admin.master_setup.assessment_committees.index')->with('success', 'Data update successfully');
            } else {
                return redirect()->route('admin.master_setup.assessment_committees.index')->with('error', 'Data does not update successfully')->withInput();
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
        
        try {
            $committee = AssessmentCommittee::find($id);
            $committee->delete();

            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }
}
