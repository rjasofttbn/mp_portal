<?php
/**
 * Author M. Atoar Rahman
 * Date: 21/01/2021
 * Time: 11:40 AM
 */

namespace App\Http\Controllers\backend\MasterSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\User;
use App\Model\Upazila;
use App\Model\District;
use App\Model\Division;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpazilaRequest;
use Auth;

class UpazilaController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Upazila::orderBy('id', 'desc')->get();
        return view('backend.master_setup.upazila.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Upazila();
        $title="Create";
        $districtList = District::orderBy('name', 'asc')->get();
        $divisionList = Division::orderBy('name', 'asc')->get();
        
        return view('backend.master_setup.upazila.form', compact('data', 'title', 'districtList', 'divisionList'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpazilaRequest $request) {

        //print_r($request->all());
            //exit;

        try {
            if ($request->isMethod("POST")) {
                $upazila = new Upazila();
                $request['created_by']= authInfo()->id;
                //$request['status']= 1;
                $upazila->fill($request->all());
                $result = $upazila->save();

                if($result){
                    return redirect()->route('admin.master_setup.upazilas.index')->with('success','Data Saved successfully');
                }else{
                    return redirect()->route('admin.master_setup.upazilas.create')->with('error','Data does not save successfully')->withInput();
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
        $data = Upazila::findOrFail($id);
        $title ="Edit";

        $districtList = District::orderBy('name', 'asc')->get();
        $divisionList = Division::orderBy('name', 'asc')->get();

        return view('backend.master_setup.upazila.form', compact('data', 'title', 'districtList', 'divisionList'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpazilaRequest $request, $id) {

        try {
            if ($request->isMethod("PUT")) {
                //Process One
                $upazilaEloquent = Upazila::find($id);
                $request['updated_by']= authInfo()->id;
                $result = $upazilaEloquent->update($request->all());

                if($result){
                    return redirect()->route('admin.master_setup.upazilas.index')->with('success','Data Updated successfully');
                }else{
                    return redirect()->route('admin.master_setup.upazilas.edit', [$id])->with('error','Data does not update successfully')->withInput();
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
     * @param  \App\Model\Upazila
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $upazilaEloquent = Upazila::find($id);
            $upazilaEloquent->delete();
            return response()->json(["status"=>"success"]);
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }
}
