<?php

namespace App\Http\Controllers\Backend\MasterSetup;


use App\Model\Ministry;
use App\Model\MinistryWings;
use App\Http\Controllers\Controller;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class MinistryWingController extends Controller
{

    public function index()
    {
        $data = DB::table('ministry_wings as mw')
                ->where('mw.status',1)
                ->leftjoin('ministries as m', 'm.id','=','mw.ministry_id')
                ->select('mw.id', 'mw.ministry_id', 'mw.name_bn', 'mw.name_eng', 'mw.status', 'm.name_bn as ministry_name')
                ->get();

        return view('backend.master_setup.ministry_wings.index', compact('data'));
    }


    public function create()
    {
        $data = new MinistryWings();
        $title="Create";
        $ministry_list = Ministry::orderBy('id','desc')->where('status',1)->get();
        return view('backend.master_setup.ministry_wings.form', compact('data', 'title','ministry_list'));

    }

    public function store(Request $request) {

        try {
            $ministry_wings = new MinistryWings();
            $ministry_wings->fill($request->all());
            $result=$ministry_wings->save();

            if($result){
                return redirect()->route('admin.master_setup.ministry_wings.index')->with('success','Data Saved successfully');
            }else{
                return redirect()->route('admin.master_setup.ministry_wings.create')->with('error','Data does not save successfully')->withInput();
            }

        } catch (\Exception $e) {
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }


    public function edit($id)
    {
        $data = MinistryWings::findOrFail($id);
        $title="Edit";
        $ministry_list = Ministry::orderBy('id','desc')->where('status',1)->get();
        return view('backend.master_setup.ministry_wings.form', compact('data', 'title','ministry_list'));

    }

    public function update(Request $request, $id) {

        try {
            $ministry_wings = MinistryWings::find($id);
            $data = $request->all();
            $data['status']= $request->status ?? 0;
            $result = $ministry_wings->update($data);

            if($result){
                return redirect()->route('admin.master_setup.ministry_wings.index')->with('success','Data Updated successfully');
            }else{
                return redirect()->route('admin.master_setup.ministry_wings.edit', [$id])->with('error','Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    public function destroy($id)
    {
        try {
            $ministry_wings = MinistryWings::find($id);
            $ministry_wings->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(['status'=>'error']);
        }
    }

}
