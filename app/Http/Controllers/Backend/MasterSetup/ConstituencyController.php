<?php

namespace App\Http\Controllers\Backend\MasterSetup;


use App\Model\District;
use App\Model\Division;
use App\Model\Upazila;
use App\Model\Constituency;
use App\Http\Controllers\Controller;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ConstituencyRequest;
use Auth;

class ConstituencyController extends Controller
{

    public function __construct()
    {

    }


    // Author Rajan Bhatta

    public function index()
    {

        $data =Constituency::orderBy('number', 'asc')->get();

        return view('backend.master_setup.constituency.index', compact('data'));
    }


    public function create(Request $request)
    {
        $data=new Constituency();
        $title="Create";

        $divisionList =Division::orderBy('name', 'asc')->get();
        $districtList =array();
        $upazilaList =array();

        return view('backend.master_setup.constituency.form', compact('data', 'title', 'upazilaList', 'districtList', 'divisionList'));

    }

    public function store(ConstituencyRequest $request) {

     

        try {
            if ($request->isMethod("POST")) {
                $district = new Constituency();
                $request['created_by']= authInfo()->id;
                //$request['status']= 1;
                $district->fill($request->all());
                $result=$district->save();

                if($result){
                    return redirect()->route('admin.master_setup.constituencies.index')->with('success','Data Saved successfully');
                }else{
                    return redirect()->route('admin.master_setup.constituencies.create')->with('error','Data does not save successfully')->withInput();
                }
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
        $data=Constituency::findOrFail($id);
        $title="Edit";

        $divisionList =Division::orderBy('name', 'asc')->get();
        $districtList =District::where('division_id',$data->division->id)->orderBy('name', 'asc')->get();
        $upazilaList =Upazila::where('district_id',$data->district->id)->orderBy('name', 'asc')->get();

        return view('backend.master_setup.constituency.form', compact('data', 'title', 'upazilaList', 'districtList', 'divisionList'));

    }

    public function update(ConstituencyRequest $request, $id) {

        try {
            if ($request->isMethod("PUT")) {

                $ConstituencyEloquent = Constituency::find($id);
                $request['updated_by']= authInfo()->id;
                $result = $ConstituencyEloquent->update($request->all());

                if($result){
                    return redirect()->route('admin.master_setup.constituencies.index')->with('success','Data Updated successfully');
                }else{
                    return redirect()->route('admin.master_setup.constituencies.edit', [$id])->with('error','Data does not update successfully')->withInput();
                }
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
            $ConstituencyEloquent = Constituency::find($id);
            $ConstituencyEloquent->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }

}
