<?php

namespace App\Http\Controllers\Backend\Requisition;

use App\Model\TelephonePabx;
use App\Model\Designation;
use App\Http\Controllers\Controller;
use App\cr;
use Illuminate\Http\Request;

class TelephonePabxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TelephonePabx::leftJoin('designations', 'designations.id', '=', 'telephone_pabxes.designition_id')->select('telephone_pabxes.*', 'designations.name', 'designations.name_bn')->orderBy('id', 'desc')->get();
        return view(
            'backend.requisition.rights.index',
            compact('data')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new TelephonePabx();
        $title = "Create";
        $designation = Designation::orderBy('id', 'desc')->get();
        return view('backend.requisition.rights.form', compact('data', 'title', 'designation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rights = new TelephonePabx();
            $rights->fill($request->all());
            $result = $rights->save();

            if ($result) {
                // dd($result);
                return redirect()->route('admin.requisition.telephone_pabx_rights.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.requisition.telephone_pabx_rights.create')->with('error', 'Data does not save successfully')->withInput();
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
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TelephonePabx::findOrFail($id);
        $title = "Edit";
        $designation = Designation::orderBy('id', 'desc')->get();
        return view('backend.requisition.rights.form', compact('data', 'title', 'designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $ministry = TelephonePabx::find($id);
            $data = $request->all();
            $data['status'] = $request->status ?? 0;
            $result = $ministry->update($data);

            if ($result) {
                return redirect()->route('admin.requisition.telephone_pabx_rights.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.requisition.telephone_pabx_rights.edit', [$id])->with('error', 'Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            dd($errorMessage);
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ministry = TelephonePabx::find($id);
            $ministry->delete();
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(['status' => 'error']);
        }
    }
}
