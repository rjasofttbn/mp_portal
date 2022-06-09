<?php

namespace App\Http\Controllers\Backend\Accommodation;


use App\Http\Controllers\Controller;
use App\Model\Application;
use App\Model\AccommodationApplication;
use App\Model\AccommodationApplicationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ApplicationController extends Controller
{

    public function index()
    {

        $data['applications'] = DB::table('applications')->get();
        $data['applicationType'] = AccommodationApplicationType::all();

        return view('backend.accommodation.application.index',$data );
    }

    public function applicationtype(Request $request)
    {
        $type = $request->input('type');
        if ($type == 1) {
            return view('backend.accommodation.application.newApplication.create');
        }
        if ($type == 2) {
            $name = authInfo()->name;
            //dd($name);
            return view('backend.accommodation.application.cancelApplication.create', compact('name'));
        }
        if ($type == 3) {
            return view('backend.accommodation.application.exchangeApplication.create');
        }
    }


    public function cancel(Request $request)
    {
        $created_by = authInfo()->id;

      dd('fgh');

        // validation
        $rules = [

            'cancel_reason' => 'required',
            'expected_cancel_date' => 'required',
        ];
        $message = [

            'cancel_reason.required' => 'The Cancel Reason field is required.',
            'expected_cancel_date.required' => 'This Expected Cancel Date field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

             extract($_REQUEST);
                $result=DB::table('accommodation_applications')->insert(
            [
                    "expected_cancel_date" => "$expected_cancel_date",
                    "cancel_reason" => "$cancel_reason",
                    "appliction_type" => "C",
                    "created_by" => "$created_by"
                
                ]);

        if($result){
            return redirect()->route('admin.accommodation.applications.index')->with('success','Data Saved successfully');
        }else{
            return redirect()->route('backend.accommodation.application.cancelApplication.create')->with('error','Data does not save successfully')->withInput();
        }
    } catch (\Exception $e) {
        $errorMessage=$e->getMessage();
        $customMessage="Exception! Something went wrong please try again!";

        \Session::flash('error', $errorMessage, true);
        return redirect()->back()->withInput(); //If you want to go back

    }
    }

    //Created by Md. Omar Faruk 09-03-2021
    public function change(Request $request)
    {

        $id = 2;
        $created_by = authInfo()->id;

        try {
            $appEloquent = Application::find($id);
            $id = $appEloquent['id'];
            extract($_REQUEST);
            $result = DB::table('applications')
                ->where('id', $id)
                ->update([
                    "id" => "$id",
                    "expected_change_date" => "$expected_change_date",
                    "change_reason" => "$change_reason",
                    "appliction_type" => "Ch",
                    "created_by" => "$created_by"
                ]);

            if ($result) {
                return redirect()->route('admin.accommodation.applications.index')->with('success', 'Exchange request successfully');
            } else {
                return redirect()->route('backend.accommodation.application.cancelApplication.create', [$id])->with('error', 'Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    public function updateCancel(Request $request)
    {
        dd('here');
        $created_by = authInfo()->id;
        try {
            $id = 1;
            $data['appl'] = Application::where('id', $id)->first();
            $id = $data['appl']->id;
            extract($_REQUEST);

            $result = DB::table('applications')
                ->where('id', $id)
                ->update([
                    "id" => "$id",
                    "expected_cancel_date" => "$expected_cancel_date",
                    "cancel_reason" => "$cancel_reason",
                    "created_by" => "$created_by"
                ]);

            if ($result) {
                return redirect()->route('admin.accommodation.applications.index')->with('success', 'Data Updated successfully');
            } else {
                return redirect()->route('backend.accommodation.application.cancelApplication.create', [$id])->with('error', 'Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }
}
