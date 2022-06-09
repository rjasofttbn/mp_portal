<?php

namespace App\Http\Controllers\Backend\MasterSetup;

use App\Http\Controllers\Controller;
use App\Model\Ministry;
use App\Model\Cabinet;
use App\Model\MinistryWings;
use App\Model\Profile;
use App\Model\ParliamentSession;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class CabinetController extends Controller
{
    public function index()
    {
        echo 'hello i am cabinet member';
    }

    public function setup_cabinet_old($id, $type)
    {
        $data['ministry_list'] = Ministry::all();
        $data['profile_list'] = Profile::all();

        $data['current_ministry'] = Ministry::where('id', $id)->first();

        $parliamentSession = ParliamentSession::where('status', 1)->first();
        $data['session_from'] = Carbon::parse($parliamentSession->declare_date)->format('d.m.Y');
        $data['session_to'] = Carbon::parse($parliamentSession->date_to)->format('d.m.Y');

        if ($type == 'create') {
            return view('backend.master_setup.cabinets.create', $data);
        } else if ($type == 'edit') {
            $data['existing_record'] = Cabinet::where('ministry_id', $id)->first();
            if (!empty($data['existing_record'])) {
                $data['existing_state_minister'] = (!is_null($data['existing_record']->state_minister)) ? explode(',', $data['existing_record']->state_minister) : [];

                $data['existing_deputy_minister'] = (!is_null($data['existing_record']->deputy_minister)) ? explode(',', $data['existing_record']->deputy_minister) : [];

                $data['existing_secretary'] = (!is_null($data['existing_record']->secretary)) ? explode(',', $data['existing_record']->secretary) : [];

                $data['existing_joint_secretary'] = (!is_null($data['existing_record']->joint_secretary)) ? explode(',', $data['existing_record']->joint_secretary) : [];
                return view('backend.master_setup.cabinets.edit', $data);
            } else {
                return view('backend.master_setup.cabinets.create', $data);
            }
        }
    }
    public function setup_cabinet($id, $type)
    {
        $data['ministry_list'] = Ministry::all();
        $data['profile_list'] = Profile::all();

        $data['current_ministry'] = Ministry::where('id', $id)->first();
        $data['ministry_wing_list'] = MinistryWings::where('ministry_id', $id)->get();

        $parliamentSession = ParliamentSession::where('status', 1)->first();
        $data['session_from'] = Carbon::parse($parliamentSession->declare_date)->format('d.m.Y');
        $data['session_to'] = Carbon::parse($parliamentSession->date_to)->format('d.m.Y');

        if ($type == 'create') {
            return view('backend.master_setup.cabinets.create', $data);
        } else if ($type == 'edit') {
            $data['existing_record'] = Cabinet::where('ministry_id', $id)->first();
            if (!empty($data['existing_record'])) {
                $existing_minister = Cabinet::where(array('ministry_id' => $id, 'designation_id' => 5))->first();
                //$data['existing_minister_id'] = (!empty($existing_minister))?$existing_minister->profile_id:0;

                $existing_minister = Cabinet::where(array('ministry_id' => $id, 'designation_id' => 5))->get();
                $data['existing_ministers'] = $existing_minister;
                
                $existing_state_minister = Cabinet::where(array('ministry_id' => $id, 'designation_id' => 7))->get();
                $data['existing_state_ministers'] = $existing_state_minister;

                $existing_deputy_minister = Cabinet::where(array('ministry_id' => $id, 'designation_id' => 6))->get();              
                $data['existing_deputy_ministers'] = $existing_deputy_minister;

                $existing_secretary = Cabinet::where(array('ministry_id' => $id, 'designation_id' => 9))->get();              
                $data['existing_secretary'] = $existing_secretary;

                $existing_joint_secretary = Cabinet::where(array('ministry_id' => $id, 'designation_id' => 10))->get();              
                $data['existing_joint_secretary'] = $existing_joint_secretary;

                return view('backend.master_setup.cabinets.edit', $data);
            } else {
                return view('backend.master_setup.cabinets.create', $data);
            }
        }
    }

    public function save_old(Request $request)
    {
        $data['ministry_id'] = $request->ministry_id;
        $data['minister_id'] = $request->minister_id;
        $data['state_minister'] = (isset($request->state_minister)) ? implode(',', $request->state_minister) : '';
        $data['deputy_minister'] = (isset($request->deputy_minister)) ? implode(',', $request->deputy_minister) : '';
        $data['secretary'] = (isset($request->secretary)) ? implode(',', $request->secretary) : '';
        $data['joint_secretary'] = (isset($request->joint_secretary)) ? implode(',', $request->joint_secretary) : '';
        $data['created_by'] = authInfo()->id;

        $existing_record = Cabinet::where('ministry_id', $request->ministry_id)->first();
        if (!empty($existing_record)) {
            //update the fields
            $done = DB::table('cabinets')->where(array('ministry_id' => $request->ministry_id))->update($data);
        } else {
            //insert new record
            $done = DB::table('cabinets')->insert($data);
        }

        if ($done) {
            return back()->with('success', 'Data Saved successfully');
        } else {
            return back()->with('error', 'Error !!!');
        }
    }

    public function save(Request $request)
    {

        //dd($request->all());

        DB::beginTransaction();
        try {
            $log_previous_data = array();
            $log_current_data = array();

            $existing_record = Cabinet::where('ministry_id', $request->ministry_id)->get();
            if(!empty($existing_record)){       
                $log_previous_data = $existing_record;  

                Cabinet::where('ministry_id', $request->ministry_id)->delete();
            }

            $minister_data = array();
            $state_minister_data = array();
            $deputy_minister_data = array();
            $secretary_data = array();
            $joint_secretary_data = array();

            /* if ($request->minister_id != NULL) {
                //after remove all then insert all new items
                $minister_data = array(
                    'ministry_id' => $request->ministry_id,
                    'profile_id' => $request->minister_id,
                    'designation_id' => 5,
                    'date_from' => Carbon::parse($request->minister_from[0])->format('Y-m-d'),
                    'date_to' => Carbon::parse($request->minister_to[0])->format('Y-m-d'),
                    'created_by' => authInfo()->id
                );
                Cabinet::UpdateOrCreate(
                    $minister_data
                );
            } */

            for ($i = 0; $i < count($request->minister); $i++) {
                if ($request->minister[$i] != NULL) { 
                    $minister_data[] = array(
                        'ministry_id' => $request->ministry_id,
                        'wing_id' => $request->minister_wing[$i],
                        'profile_id' => $request->minister[$i],
                        'designation_id' => 5,
                        'date_from' => Carbon::parse($request->minister_from[$i])->format('Y-m-d'),
                        'date_to' => Carbon::parse($request->minister_to[$i])->format('Y-m-d'),
                        'created_by' => authInfo()->id
                    );
                    Cabinet::UpdateOrCreate(
                        array(
                            'ministry_id' => $request->ministry_id,
                            'wing_id' => $request->minister_wing[$i],
                            'profile_id' => $request->minister[$i],
                            'designation_id' => 5,
                            'date_from' => Carbon::parse($request->minister_from[$i])->format('Y-m-d'),
                            'date_to' => Carbon::parse($request->minister_to[$i])->format('Y-m-d'),
                            'created_by' => authInfo()->id
                        )
                    );
                }
            }
            for ($i = 0; $i < count($request->state_minister); $i++) {
                if ($request->state_minister[$i] != NULL) { 
                    $state_minister_data[] = array(
                        'ministry_id' => $request->ministry_id,
                        'wing_id' => $request->state_minister_wing[$i],
                        'profile_id' => $request->state_minister[$i],
                        'designation_id' => 7,
                        'date_from' => Carbon::parse($request->stateminister_from[$i])->format('Y-m-d'),
                        'date_to' => Carbon::parse($request->stateminister_to[$i])->format('Y-m-d'),
                        'created_by' => authInfo()->id
                    );
                    Cabinet::UpdateOrCreate(
                        array(
                            'ministry_id' => $request->ministry_id,
                            'wing_id' => $request->state_minister_wing[$i],
                            'profile_id' => $request->state_minister[$i],
                            'designation_id' => 7,
                            'date_from' => Carbon::parse($request->stateminister_from[$i])->format('Y-m-d'),
                            'date_to' => Carbon::parse($request->stateminister_to[$i])->format('Y-m-d'),
                            'created_by' => authInfo()->id
                        )
                    );
                }
            }
            for ($i = 0; $i < count($request->deputy_minister); $i++) {
                if ($request->deputy_minister[$i] != NULL) {
                    $deputy_minister_data[] = array(
                        'ministry_id' => $request->ministry_id,
                        'wing_id' => $request->deputy_minister_wing[$i],
                        'profile_id' => $request->deputy_minister[$i],
                        'designation_id' => 6,
                        'date_from' => Carbon::parse($request->deputyminister_from[$i])->format('Y-m-d'),
                        'date_to' => Carbon::parse($request->deputyminister_to[$i])->format('Y-m-d'),
                        'created_by' => authInfo()->id
                    );
                    Cabinet::UpdateOrCreate(
                        array(
                            'ministry_id' => $request->ministry_id,
                            'wing_id' => $request->deputy_minister_wing[$i],
                            'profile_id' => $request->deputy_minister[$i],
                            'designation_id' => 6,
                            'date_from' => Carbon::parse($request->deputyminister_from[$i])->format('Y-m-d'),
                            'date_to' => Carbon::parse($request->deputyminister_to[$i])->format('Y-m-d'),
                            'created_by' => authInfo()->id
                        )
                    );
                }
            }
            for ($i = 0; $i < count($request->secretary); $i++) {
                if ($request->secretary[$i] != NULL) {
                    $secretary_data[] =  array(
                        'ministry_id' => $request->ministry_id,
                        'wing_id' => $request->secretary_wing[$i],
                        'profile_id' => $request->secretary[$i],
                        'designation_id' => 9,
                        'date_from' => Carbon::parse($request->secretary_from[$i])->format('Y-m-d'),
                        'date_to' => Carbon::parse($request->secretary_to[$i])->format('Y-m-d'),
                        'created_by' => authInfo()->id
                    );
                    Cabinet::UpdateOrCreate(
                        array(
                            'ministry_id' => $request->ministry_id,
                            'wing_id' => $request->secretary_wing[$i],
                            'profile_id' => $request->secretary[$i],
                            'designation_id' => 9,
                            'date_from' => Carbon::parse($request->secretary_from[$i])->format('Y-m-d'),
                            'date_to' => Carbon::parse($request->secretary_to[$i])->format('Y-m-d'),
                            'created_by' => authInfo()->id
                        )
                    );
                }
            }
            for ($i = 0; $i < count($request->joint_secretary); $i++) {
                if ($request->joint_secretary[$i] != NULL) {
                    $joint_secretary_data[] = array(
                        'ministry_id' => $request->ministry_id,
                        'wing_id' => $request->joint_secretary_wing[$i],
                        'profile_id' => $request->joint_secretary[$i],
                        'designation_id' => 10,
                        'date_from' => Carbon::parse($request->jointsecretary_from[$i])->format('Y-m-d'),
                        'date_to' => Carbon::parse($request->jointsecretary_to[$i])->format('Y-m-d'),
                        'created_by' => authInfo()->id
                    );
                    Cabinet::UpdateOrCreate(
                        array(
                            'ministry_id' => $request->ministry_id,
                            'wing_id' => $request->joint_secretary_wing[$i],
                            'profile_id' => $request->joint_secretary[$i],
                            'designation_id' => 10,
                            'date_from' => Carbon::parse($request->jointsecretary_from[$i])->format('Y-m-d'),
                            'date_to' => Carbon::parse($request->jointsecretary_to[$i])->format('Y-m-d'),
                            'created_by' => authInfo()->id
                        )
                    );
                }
            }

            $log_current_data = "'[";
            $log_current_data.= json_encode(array_merge($minister_data,$state_minister_data,$deputy_minister_data,$secretary_data,$joint_secretary_data),true);
            $log_current_data.="]'";

            $previous_data = "'";
            $previous_data.= json_encode($log_previous_data,true);
            $previous_data.="'";

            //Insert into Cabinet Log table with previous and current members 
            $log_data = array(
                'ministry_id' => $request->ministry_id,
                'previous_members' => $previous_data,
                'current_members' => $log_current_data,
                'changed_by' => authInfo()->id
            );

            DB::table('cabinet_log')->insert($log_data);

            DB::commit();
            return back()->with('success', 'Data Saved successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with($th->getMessage());
        }
    }
}
