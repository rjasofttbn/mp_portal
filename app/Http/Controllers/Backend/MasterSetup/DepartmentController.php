<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 4/12/20
 * Time: 11:40 AM
 */

namespace App\Http\Controllers\Backend\MasterSetup;


use App\Model\Department;
use App\Http\Controllers\Controller;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DepartmentRequest;
use Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['departments'] = Department::orderBy('id', 'desc')->get();

        return view('backend.master_setup.department.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['department'] = new Department();
        $data['title'] = 'Create';
        return view('backend.master_setup.department.form', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request) {

        try {
            $department = new Department();
            $department->fill($request->all());
            $result=$department->save();

            if($result){
                return redirect()->route('admin.master_setup.departments.index')->with('success','Data Saved successfully');
            }else{
                return redirect()->route('admin.master_setup.departments.create')->with('error','Data does not save successfully')->withInput();
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
        $data['department'] = Department::findOrFail($id);
        $data['title'] = 'Update';
        return view('backend.master_setup.department.form', $data);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id) {

        try {

            $department = Department::find($id);
            $result = $department->update($request->all());

            if($result){
                return redirect()->route('admin.master_setup.departments.index')->with('success','Data Updated successfully');
            }else{
                return redirect()->route('admin.master_setup.departments.edit', [$id])->with('error','Data does not update successfully')->withInput();
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
     * @param  \App\Model\Department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $department = Department::find($id);
            $department->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }

}
