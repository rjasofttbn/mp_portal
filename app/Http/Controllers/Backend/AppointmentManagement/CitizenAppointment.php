<?php

namespace App\Http\Controllers\Backend\AppointmentManagement;

use App\Http\Controllers\Controller;
use App\Model\Appointment;
use App\Model\District;
use App\Model\Division;
use App\Model\Ministry;
use App\Model\Petition;
use App\Model\PetitionAttachment;
use App\Model\PetitionOtp;
use App\Model\Profile;
use App\Model\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitizenAppointment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['data'] = new Appointment();
        $data['profileList'] = Profile::orderBy('name_eng', 'asc')->get();
        $data['ministry_list'] = Ministry::all();
        return view('backend.appointmentManagement.citizen_appointment.form', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    public function get_mp_list(Request $request)
    {
        $requested_to = $request->input('requested_to');
        $profileList = Profile::orderBy('name_eng', 'asc')->get();
        $is_mp = true;
        return view('backend.appointmentManagement.mp_list', compact('requested_to', 'profileList', 'is_mp'));

    }

    public function get_ministry_list(Request $request)
    {
        //$data = Appointment::findOrFail($id);
        //$title="Edit";
        $requested_to = $request->input('requested_to');
        $ministry_id = $request->input('ministry_id');
        $is_mp = false;
        if ($ministry_id != 0) {
            $profileList = Profile::orderBy('name_eng', 'asc')
                ->where('ministry_id', $ministry_id)
                ->get();
        } else {
            $profileList = Profile::orderBy('name_eng', 'asc')->get();
        }

        return view('backend.appointmentManagement.mp_list', compact('requested_to', 'profileList', 'is_mp'));

    }
    public function getOtpInfo(Request $request)
    {
        $mobile = $request['applicant_mobile'];
        $result = PetitionOtp::where('mobile', $mobile)->get();
        return response()->json(array(
            'data' => $result,
        ));
    }

    public function citizenContactInfo(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");
        $mobile = $request['applicant_mobile'];
        $otp_number = random_int(1000, 9999);
        $start_time = date('Y-m-d H:i:s');
        $end_time = date('Y-m-d H:i:s', strtotime('+2 minutes'));

        PetitionOtp::insert([
            'mobile' => $mobile,
            'otp_number' => $otp_number,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
    public function citizenAppointmentInsert(Request $request)
    {
        dd($request);
        // validation
        $rules = [
            'applicant_name' => 'required',
            'applicant_designation' => 'required',
            'applicant_nid' => 'required',
            'applicant_mobile' => 'required',
            'applicant_email' => 'required',
            'applicant_division_id' => 'required',
            'applicant_district_id' => 'required',
            'applicant_upazila_id' => 'required',
            'applicant_union' => 'required',

            'description' => 'required',
            'prayer' => 'required',
            'mp_name' => 'required',
            'otp_number' => 'required',
        ];
        $message = [
            'applicant_name.required' => 'The Name field is required.',
            'applicant_designation.required' => 'The Designation field is required.',
            'applicant_nid.required' => 'The NID field is required.',
            'applicant_mobile.required' => 'The Mobile No. field is required.',
            'applicant_email.required' => 'The E-mail field is required.',
            'applicant_division_id.required' => 'The Division field is required.',
            'applicant_district_id.required' => 'The District field is required.',
            'applicant_upazila_id.required' => 'The Upazila field is required.',
            'applicant_union.required' => 'The Union field is required.',

            'description.required' => 'The Description field is required.',
            'prayer.required' => 'The field Prayer is required.',
            'mp_name.required' => 'The MP field is required.',
            'otp_number.required' => 'The OTP Number field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $applicant_list = json_encode($request->input('applicant_list'));

        $otp_number = $request->input('otp_number');

        $otpInfo = PetitionOtp::where('mobile', $request->input('applicant_mobile'))->orderBy('id', 'desc')->first();

        $petition = new Petition();

        try {

            $request['applicant_list'] = $applicant_list;

            $request['otp_number'] = $otp_number;
            $request['otp_id'] = $otpInfo->id;

            if ($otpInfo->otp_number == $otp_number) {
                $petition->fill($request->all());
                $result = $petition->save();

                $petition_id = $petition->id;

                if ($request->hasfile('attachment')) {

                    if ($files = $request->file('attachment')) {
                        foreach ($files as $file) {
                            $extension = $file->getClientOriginalExtension();
                            $filename = 'petition' . '_' . time() . random_int(0, 1000) . '.' . $extension; // Make a file name
                            $folder = public_path('/backend/petition/'); // Define folder path
                            $file->move($folder, $filename); // Upload image
                            $petitionAttachment = new PetitionAttachment();
                            $petitionAttachment->petition_id = $petition_id;
                            $petitionAttachment->attachment = $filename; // Set file path in database to filePath
                            $petitionAttachment->save();
                        }
                    }
                }

                if ($result) {
                    return 1;
                } else {
                    return 0;
                }
            }

        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }

    public function petitionOtpView(Request $request)
    {
        $petitionOtp = PetitionOtp::where('mobile', $request->input('applicant_mobile'))->orderBy('id', 'desc')->first();
        return response()->json(array(
            'data' => $petitionOtp,

        ));
    }

    public function petitionsWelcome()
    {
        return view('backend.appointmentManagement.citizen_appointment.welcome');
    }

    public function petitionsMonitoring()
    {
        return view('backend.appointmentManagement.citizen_appointment.monitoring');
    }

    public function petitionsMonitoringGetData(Request $request)
    {
        $petition_nid = $request->input('petition_nid');
        $petition_mobile = $request->input('petition_mobile');

        $result = Petition::where('applicant_nid', $petition_nid)
            ->where('applicant_mobile', $petition_mobile)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json(array(
            'data' => $result,
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['petitions'] = Petition::where('id', $id)->first();
        $data['applicant_list'] = json_decode($data['petitions']['applicant_list']);

        $multi_name = $data['applicant_list']->name;
        $unions = $data['applicant_list']->union;
        $upazilaId = $data['applicant_list']->upazila;
        $districtId = $data['applicant_list']->district;
        $divisionId = $data['applicant_list']->division;
        $more_address = $data['applicant_list']->more_address;

        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();

        $upazilaNames = [];
        $districtNames = [];
        $divisionNames = [];

        foreach ($upazilaId as $upazilaId) {
            foreach ($upazilas as $upazila) {
                if ($upazila->id == $upazilaId) {
                    array_push($upazilaNames, $upazila->bn_name);
                }
            }
        }
        foreach ($districtId as $districtId) {
            foreach ($districts as $district) {
                if ($district->id == $districtId) {
                    array_push($districtNames, $district->bn_name);
                }
            }
        }
        foreach ($divisionId as $divisionId) {
            foreach ($divisions as $division) {
                if ($division->id == $divisionId) {
                    array_push($divisionNames, $division->bn_name);
                }
            }
        }

        $petition_id = $data['petitions']->id;
        $data['attachments'] = PetitionAttachment::where('petition_id', $id)->get();

        $data['allData'] = array_map(null, $multi_name, $unions, $upazilaNames, $districtNames, $divisionNames, $more_address);

        return view('backend.appointmentManagement.citizen_appointment.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
