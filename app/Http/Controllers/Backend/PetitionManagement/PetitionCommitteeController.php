<?php

namespace App\Http\Controllers\Backend\PetitionManagement;

use App\Http\Controllers\Controller;
use App\Model\Constituency;
use Illuminate\Http\Request;
use App\Model\Profile;
use App\Model\PetitionCommittee;
use App\Model\PetitionComitteeDesignation;
use App\Model\Parliament;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class PetitionCommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['committees'] = PetitionCommittee::orderBy('id', 'asc')->get();
        $data['profiles'] = Profile::orderBy('id', 'asc')->get();
        $data['constituencies'] = Constituency::orderBy('id', 'asc')->get();
        $data['designations'] = PetitionComitteeDesignation::orderBy('id', 'asc')->get();
        
        return view('backend.petitionManagement.petitionCommittee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['profiles'] = Profile::orderBy('id', 'asc')->get();
        $data['constituencies'] = Constituency::orderBy('id', 'asc')->get();
        $data['parliaments'] = Parliament::where('status', 1)->first();
        $data['designations'] = PetitionComitteeDesignation::orderBy('id', 'asc')->get();

        return view('backend.petitionManagement.petitionCommittee.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        DB::beginTransaction();
        // validation
        $rules = [
            'parliament_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'user_id.*' => 'required',
            'designation_id.*' => 'required',
            'member_status.*' => 'required',
            'quorum' => 'required',
        ];
        $message = [
            'parliament_id.required' => 'The Parliament field is required.',
            'date_from.required' => 'The Date From field is required.',
            'date_to.required' => 'The Date To field is required.',
            'user_id.*.required' => 'The Member field is required.',
            'designation_id.*.required' => 'The Designation field is required.',
            'member_status.*.required' => 'The Member Status field is required.',
            'quorum.required' => 'The Quorum field is required.',
        ];


        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Database Insert
        $user_id = json_encode($request->input('user_id'));
        $designation_id = json_encode($request->input('designation_id'));
        $member_status = json_encode($request->input('member_status'));

        try {

            $committee = new PetitionCommittee();
            $request['user_id'] = $user_id;
            $request['designation_id'] = $designation_id;
            $request['member_status'] = $member_status;
            $committee->fill($request->all());
            $result = $committee->save();


            // for ($i = 0; $i < count($request->user_id); $i++) {
            //     if ($request->user_id[$i] != NULL) { 
            //         $result = PetitionCommittee::UpdateOrCreate(
            //             array(
            //                 'parliament_id' => $request->parliament_id,
            //                 'date_from' => $request->date_from,
            //                 'date_to' => $request->date_from,
            //                 'user_id' => $request->user_id[$i],
            //                 'designation_id' => $request->designation_id[$i],
            //                 'member_status' => $request->member_status,
            //                 'quorum' => $request->quorum
            //             )
            //         );
            //     }
            // }

            
            DB::commit();
            if ($result) {
                return redirect()->route('admin.petition_management.petition_committees.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.petition_management.petition_committees.create')->with('error', 'Data does not save successfully')->withInput();
            }

        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput();
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
        $data['editData'] = PetitionCommittee::find($id);
        $data['profiles'] = Profile::all();
        $data['parliaments'] = Parliament::where('status', 1)->first();
        $data['committees'] = json_decode($data['editData']['user_id'], true);
        $data['designation_ids'] = json_decode($data['editData']['designation_id'], true);
        $data['memberStatus'] = json_decode($data['editData']['member_status'], true);
        $data['designations'] = PetitionComitteeDesignation::orderBy('id', 'asc')->get();

        return view('backend.petitionManagement.petitionCommittee.edit', $data);
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
        DB::beginTransaction();

        // validation
        $rules = [
            'parliament_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'user_id.*' => 'required',
            'designation_id.*' => 'required',
            'member_status.*' => 'required',
            'quorum' => 'required',
        ];
        $message = [
            'parliament_id.required' => 'The Parliament field is required.',
            'date_from.required' => 'The Date From field is required.',
            'date_to.required' => 'The Date To field is required.',
            'user_id.*.required' => 'The Member field is required.',
            'designation_id.*.required' => 'The Designation field is required.',
            'member_status.*.required' => 'The Member Status field is required.',
            'quorum.required' => 'The Quorum field is required.',
        ];


        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Database Update
        $user_id = json_encode($request->input('user_id'));
        $designation_id = json_encode($request->input('designation_id'));
        $member_status = json_encode($request->input('member_status'));

        try {
            $committee = PetitionCommittee::find($id);
            $request['user_id'] = $user_id;
            $request['designation_id'] = $designation_id;
            $request['member_status'] = $member_status;
            $request['status']= $request->status ?? 0;
            $committee->fill($request->all());
            $result = $committee->update();

            DB::commit();
            if ($result) {
                return redirect()->route('admin.petition_management.petition_committees.index')->with('success', 'Data update successfully');
            } else {
                return redirect()->route('admin.petition_management.petition_committees.index')->with('error', 'Data does not update successfully')->withInput();
            }

        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput();
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
            $committee = PetitionCommittee::find($id);
            $committee->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(['status'=>'error']);
        }
    }
}
