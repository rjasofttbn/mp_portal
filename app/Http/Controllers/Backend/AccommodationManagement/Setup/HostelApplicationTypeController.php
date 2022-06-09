<?php

namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\HostelApplicationType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HostelApplicationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = HostelApplicationType::orderBy('id', 'desc')->get();
        //$data['accommodationType'] = AccommodationType::orderBy('id', 'desc')->get();
        //dd($data['accommodationType']);
        return view('backend.accommodation-management.setup.hostel-application-type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.accommodation-management.setup.hostel-application-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        // validation
        $rules = [
            'subject' => 'required',
            // 'type_name' => 'required',
        ];
        $message = [
            'subject.required' => 'The Application Subject field is required.',
            // 'type_name.required' => 'The Application Type Name field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $hostelApplicationType = new HostelApplicationType();
            $hostelApplicationType->fill($request->all());

            $result = $hostelApplicationType->save();
            if($result){
                DB::commit();
                return response()->json(['status'=>'success','message'=>\Lang::get('Data Saved successfully')]);
            }else{
                return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert_Insert')]);
            }
           
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
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
        $data['editData'] = HostelApplicationType::findOrFail($id);
        return view('backend.accommodation-management.setup.hostel-application-type.edit', $data);
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
            'subject' => 'required',
            // 'type_name' => 'required',
        ];
        $message = [
            'subject.required' => 'The Application Subject field is required.',
            // 'type_name.required' => 'The Application Type Name field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {

            $hostelApplicationType = HostelApplicationType::find($id);
            $data = $request->all();
            $data['status'] = $request->status ?? 0;
            $result = $hostelApplicationType->update($data);

            if($result){
                DB::commit();
                return response()->json(['status'=>'success','message'=>\Lang::get('Data Saved successfully')]);
            }else{
                return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert_Insert')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
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
            $area = HostelApplicationType::find($id);
            $area->delete();
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }
}
