<?php

namespace App\Http\Controllers\Backend\AppointmentManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Model\Appointment;
use App\Model\Ministry;
use App\Model\Profile;
use Auth;
use Illuminate\Http\Request;
class AppointmentManage extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($date = "")
    {
        if ($date != "") {
            $data = Appointment::orderBy('id', 'desc')
                ->where('created_by', Auth::user()->id)
                ->where('status', 0)
                ->where('date', $date)
                ->get();
        } else {

            $data = Appointment::orderBy('id', 'desc')
                ->where('created_by', Auth::user()->id)
                ->where('status', 0)
                ->get();
        }
        $listType = 1;
        return view('backend.appointmentManagement.index', compact('data', 'listType', 'date'));
    }
    public function acceptedList($date = "")
    {
        if ($date != "") {
            $data = Appointment::orderBy('id', 'desc')
                ->where('created_by', Auth::user()->id)
                ->where('status', 1)
                ->where('date', $date)
                ->get();
        } else {
            $data = Appointment::orderBy('id', 'desc')
                ->where('created_by', Auth::user()->id)
                ->where('status', 1)
                ->get();
        }
        $listType = 2;
        return view('backend.appointmentManagement.index', compact('data', 'listType', 'date'));
    }
    public function rejectedList($date = "")
    {
        if ($date != "") {
            $data = Appointment::orderBy('id', 'desc')
                ->where('created_by', Auth::user()->id)
                ->where('status', 2)
                ->where('date', $date)
                ->get();
        } else {
            $data = Appointment::orderBy('id', 'desc')
                ->where('created_by', Auth::user()->id)
                ->where('status', 2)
                ->get();
        }
        $listType = 3;

        return view('backend.appointmentManagement.index', compact('data', 'listType', 'date'));
    }

    public function receivedIndex($date = "")
    {
        if ($date != "") {
            $data = Appointment::orderBy('id', 'desc')
                ->where('requested_to', userIdToProfileId())
                ->where('status', 0)
                ->where('date', $date)
                ->get();
        } else {
            $data = Appointment::orderBy('id', 'desc')
                ->where('requested_to', userIdToProfileId())
                ->where('status', 0)
                ->get();
        }
        //dd($data);
        $listType = 1;
        return view('backend.appointmentManagement.receivedIndex', compact('data', 'listType', 'date'));
    }
    public function receivedAcceptList($date = "")
    {
        if ($date != "") {
            $data = Appointment::orderBy('id', 'desc')
                ->where('requested_to', userIdToProfileId())
                ->where('status', 1)
                ->where('date', $date)
                ->get();
        } else {
            $data = Appointment::orderBy('id', 'desc')
                ->where('requested_to', userIdToProfileId())
                ->where('status', 1)
                ->get();
        }
        $listType = 2;
        return view('backend.appointmentManagement.receivedIndex', compact('data', 'listType', 'date'));
    }
    public function receivedRejectList($date = "")
    {
        if ($date != "") {
            $data = Appointment::orderBy('id', 'desc')
                ->where('requested_to', userIdToProfileId())
                ->where('status', 2)
                ->where('date', $date)
                ->get();
        } else {
            $data = Appointment::orderBy('id', 'desc')
                ->where('requested_to', userIdToProfileId())
                ->where('status', 2)
                ->get();
        }
        $listType = 3;

        return view('backend.appointmentManagement.receivedIndex', compact('data', 'listType', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Appointment();
        $title = "Create";

        $profileList = Profile::orderBy('name_eng', 'asc')->get();
        $ministry_list = Ministry::all();
        return view('backend.appointmentManagement.form', compact('data', 'title', 'profileList', 'ministry_list'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {

        try {
            if ($request->isMethod("POST")) {
                $appointment = new Appointment();
                $request['created_by']= Auth::user()->id;
                //$appointment->fill($request->all());
                $appointment->date = $request->date;
                $appointment->time_from = $request->time_from;
                $appointment->time_to = $request->time_to;
                $appointment->topics = $request->topics;
                $appointment->type = $request->type;
                if ($request->type != 0) {
                    $appointment->place = $request->place;
                    $appointment->requested_to = $request->requested_to;
                    if ($request->type == 1) {
                        $appointment->ministry_id = $request->ministry_id;
                    }
                } else {
                    $appointment->requested_to = Auth::user()->id;
                    $appointment->status = 1;

                }

                $result = $appointment->save();

                if ($result) {
                    return redirect()->route('admin.appointment-management.appointment-request.index')->with('success', 'Data Saved successfully');
                } else {
                    return redirect()->route('admin.appointment-management.appointment-request.create')->with('error', 'Data does not save successfully')->withInput();
                }
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

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
        $data = Appointment::findOrFail($id);
        $title = "Edit";

        $profileList = Profile::orderBy('name_eng', 'asc')->get();
        $ministry_list = Ministry::all();

        return view('backend.appointmentManagement.form', compact('data', 'title', 'profileList', 'ministry_list'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details_data(Request $request)
    {

        $data = Appointment::findOrFail($request->input('id'));
        $is_change = true;
        return view('backend.appointmentManagement.details_modal', compact('data', 'is_change'));

    }

    public function timechange_data(Request $request)
    {

        $data = Appointment::findOrFail($request->input('id'));
        return view('backend.appointmentManagement.timechange_modal', compact('data'));

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, $id)
    {

        try {
            if ($request->isMethod("PUT")) {

                $appointment = Appointment::find($id);
                //$request['created_by']= Auth::user()->id;
                //$appointment->fill($request->all());
                $appointment->date = $request->date;
                $appointment->time_from = $request->time_from;
                $appointment->time_to = $request->time_to;
                $appointment->topics = $request->topics;
                $appointment->type = $request->type;
                if ($request->type != 0) {
                    $appointment->place = $request->place;
                    $appointment->requested_to = $request->requested_to;
                    if ($request->type == 1) {
                        $appointment->ministry_id = $request->ministry_id;
                    }
                } else {
                    $appointment->requested_to = Auth::user()->id;
                    $appointment->status = 1;

                }
                //$request['updated_by']= Auth::user()->id;
                $appointment->update();
                return redirect()->route('admin.appointment-management.appointment-request.index')->with('success', 'Data Updated successfully');

            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function appointment_accept(Request $request, $id)
    {

        try {
            if ($request->isMethod("PUT")) {

                $appointment = Appointment::find($id);
                $appointment->status = 1;
                if ($request->appointment_change != 0) {
                    $appointment->new_date = $request->date;
                    $appointment->new_time_from = $request->time_from;
                    $appointment->new_time_to = $request->time_to;
                    $appointment->new_place = $request->place;

                }
                //$request['updated_by']= Auth::user()->id;
                $appointment->update();
                return redirect()->route('admin.appointment-management.appointment-received.index')->with('success', 'Data Updated successfully');

            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function appointment_update(Request $request, $id)
    {

        try {
            if ($request->isMethod("PUT")) {

                $appointment = Appointment::find($id);
                $appointment->status = 1;
                $appointment->new_date = $request->date;
                $appointment->new_time_from = $request->time_from;
                $appointment->new_time_to = $request->time_to;
                $appointment->new_place = $request->place;
                //$request['updated_by']= Auth::user()->id;
                $appointment->update();
                return redirect()->route('admin.appointment-management.appointment-received.index')->with('success', 'Data Updated successfully');

            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
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
            $appointmentEloquent = Appointment::find($id);
            $appointmentEloquent->delete();
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }

    public function approved(Request $request, $id)
    {

        try {
            $appointmentEloquent = Appointment::find($id);
            $appointmentEloquent->updated_by = Auth::user()->id;
            $result = $appointmentEloquent->save();
            if ($result) {
                return redirect()->route('admin.appointment-management.appointment-request.acceptedList')->with('success', 'Approved');
            } else {
                return redirect()->route('admin.appointment-management.appointment-request.acceptedList', [$id])->with('error', 'Approved does not successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }

    public function declined(Request $request, $id)
    {
        try {
            $appointmentEloquent = Appointment::find($id);
            $update_by = $request['updated_by'] = Auth::user()->id;
            $result = $appointmentEloquent->update(['status' => 2, 'update_by' => $update_by]);
            if ($result) {
                return redirect()->route('admin.appointment-management.appointment-request.index')->with('success', 'Declined');
            } else {
                return redirect()->route('admin.appointment-management.appointment-request.index', [$id])->with('error', 'Declined does not successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    public function receivedApproved(Request $request, $id)
    {

        try {
            $appointmentEloquent = Appointment::find($id);
            $update_by = $request['updated_by'] = Auth::user()->id;
            $result = $appointmentEloquent->update(['status' => 1, 'update_by' => $update_by]);
            if ($result) {
                return redirect()->route('admin.appointment-management.appointment-received.index')->with('success', 'Approved');
            } else {
                return redirect()->route('admin.appointment-management.appointment-received.index', [$id])->with('error', 'Approved does not successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }

    public function receivedDeclined(Request $request, $id)
    {
        try {
            $appointmentEloquent = Appointment::find($id);
            $update_by = $request['updated_by'] = Auth::user()->id;
            $result = $appointmentEloquent->update(['status' => 2, 'update_by' => $update_by]);
            if ($result) {
                return redirect()->route('admin.appointment-management.appointment-received.index')->with('success', 'Declined');
            } else {
                return redirect()->route('admin.appointment-management.appointment-received.index', [$id])->with('error', 'Declined does not successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

}
