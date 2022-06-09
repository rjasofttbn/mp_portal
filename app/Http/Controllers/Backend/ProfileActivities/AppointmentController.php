<?php
/**
 * Author M. Atoar Rahman
 * Date: 02/02/2021
 * Time: 09:30 AM
 */
namespace App\Http\Controllers\Backend\ProfileActivities;

use App\Http\Requests\AppointmentRequest;
use App\Model\Appointment;
use App\Model\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $data = Appointment::orderBy('id', 'desc')->get();

        return view('backend.profileActivities.appointment.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Appointment();
        $title="Create";

        $profileList = Profile::orderBy('name_eng', 'asc')->get();

        return view('backend.profileActivities.appointment.form', compact('data', 'title', 'profileList'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request) {

        try {
            if ($request->isMethod("POST")) {
                $appointment = new Appointment();
                //$request['created_by']= authInfo()->id;
                $appointment->fill($request->all());
                $result = $appointment->save();

                if($result){
                    return redirect()->route('admin.profile_activities.appointments.index')->with('success','Data Saved successfully');
                }else{
                    return redirect()->route('admin.profile_activities.appointments.create')->with('error','Data does not save successfully')->withInput();
                }
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
        $data = Appointment::findOrFail($id);
        $title="Edit";

        $profileList = Profile::orderBy('name_eng', 'asc')->get();
        return view('backend.profileActivities.appointment.form', compact('data', 'title', 'profileList'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, $id) {

        try {
            if ($request->isMethod("PUT")) {

                $appointmentEloquent = Appointment::find($id);
                //$request['updated_by']= authInfo()->id;
                $result = $appointmentEloquent->update($request->all());

                if($result){
                    return redirect()->route('admin.profile_activities.appointments.index')->with('success','Data Updated successfully');
                }else{
                    return redirect()->route('admin.profile_activities.appointments.edit', [$id])->with('error','Data does not update successfully')->withInput();
                }
            }
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

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
            return response()->json(["status"=>"success"]);
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }

    public function approved(Request $request, $id){

        try {
            $appointmentEloquent = Appointment::find($id);
            $update_by = $request['updated_by']= authInfo()->id;
            $result = $appointmentEloquent->update(['status' => 1, 'update_by' => $update_by]);
            if($result){
                return redirect()->route('admin.profile_activities.appointments.index')->with('success','Approved');
            }else{
                return redirect()->route('admin.profile_activities.appointments.index', [$id])->with('error','Approved does not successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }


    public function declined(Request $request, $id){
        try {
            $appointmentEloquent = Appointment::find($id);
            $update_by = $request['updated_by']= authInfo()->id;
            $result = $appointmentEloquent->update(['status' => 2, 'update_by' => $update_by]);
            if($result){
                return redirect()->route('admin.profile_activities.appointments.index')->with('success','Declined');
            }else{
                return redirect()->route('admin.profile_activities.appointments.index', [$id])->with('error','Declined does not successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }




}
