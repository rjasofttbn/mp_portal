<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */

namespace App\Http\Controllers\Backend\MasterSetup;

use Illuminate\Http\Request;
use App\Model\Division;
use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DivisionRequest;
use Auth;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

    }

    public function index()
    {
        $data = Division::orderBy('id', 'desc')->get();

        return view('backend.master_setup.division.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=new Division();

        return view('backend.master_setup.division.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DivisionRequest $request)
    {
        try {
            if ($request->isMethod("POST")) {
                $division = new Division();
                $request['created_by']= authInfo()->id;
                $division->fill($request->all());
                $result = $division->save();

                if($result){
                    return redirect()->route('admin.master_setup.divisions.index')->with('success','Data Saved successfully');
                }else{
                    return redirect()->route('admin.master_setup.divisions.create')->with('error','Data does not save successfully')->withInput();
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
        $data = Division::findOrFail($id);
        return view('backend.master_setup.division.form', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DivisionRequest $request, $id) {

        try {
            if ($request->isMethod("PUT")) {
                //Process One
                $divisionEloquent = Division::find($id);
                $request['updated_by']= authInfo()->id;
                $result = $divisionEloquent->update($request->all());

                if($result){
                    return redirect()->route('admin.master_setup.divisions.index')->with('success','Data Updated successfully');
                }else{
                    return redirect()->route('admin.master_setup.divisions.edit', [$id])->with('error','Data does not update successfully')->withInput();
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
            $divisionEloquent = Division::find($id);
            $divisionEloquent->delete();
            return response()->json(["status"=>"success"]);
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }
}
