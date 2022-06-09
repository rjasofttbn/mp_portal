<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 4/12/20
 * Time: 11:40 AM
 */

namespace App\Http\Controllers\Backend\MasterSetup;


use App\Model\District;
use App\Model\Division;
use App\Http\Controllers\Controller;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DistrictRequest;
use Auth;

class DistrictController extends Controller
{

    public function __construct()
    {

    }


    // Author Rajan Bhatta

    public function index()
    {

        $data =District::orderBy('id', 'desc')->get();

        return view('backend.master_setup.district.index', compact('data'));
    }


    public function create()
    {
        $data=new District();
        $title="Create";

        $divisionList =Division::orderBy('name', 'asc')->get();

        return view('backend.master_setup.district.form', compact('data', 'title', 'divisionList'));

    }

    public function store(DistrictRequest $request) {

        //print_r($request->all());
            //exit;

        try {
            if ($request->isMethod("POST")) {
                $district = new District();
                $request['created_by']= authInfo()->id;
                //$request['status']= 1;
                $district->fill($request->all());
                $result=$district->save();

                if($result){
                    return redirect()->route('admin.master_setup.districts.index')->with('success','Data Saved successfully');
                }else{
                    return redirect()->route('admin.master_setup.districts.create')->with('error','Data does not save successfully')->withInput();
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
        $data=District::findOrFail($id);
        $title="Edit";

        $divisionList =Division::orderBy('name', 'asc')->get();
        return view('backend.master_setup.district.form', compact('data', 'title', 'divisionList'));

    }

    public function update(DistrictRequest $request, $id) {

        try {
            if ($request->isMethod("PUT")) {

                $districtEloquent = District::find($id);
                $request['updated_by']= authInfo()->id;
                $result = $districtEloquent->update($request->all());

                if($result){
                    return redirect()->route('admin.master_setup.districts.index')->with('success','Data Updated successfully');
                }else{
                    return redirect()->route('admin.master_setup.districts.edit', [$id])->with('error','Data does not update successfully')->withInput();
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

            $districtEloquent = District::find($id);
            $districtEloquent->delete();
            return response()->json(["status"=>"success"]);
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }

}
