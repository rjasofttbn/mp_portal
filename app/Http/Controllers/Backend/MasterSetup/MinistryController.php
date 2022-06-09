<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 4/12/20
 * Time: 11:40 AM
 */

namespace App\Http\Controllers\Backend\MasterSetup;


use App\Model\Ministry;
use App\Http\Controllers\Controller;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MinistryRequest;
use Auth;

class MinistryController extends Controller
{

    public function index()
    {
        $data = Ministry::orderBy('id', 'desc')->get();
        return view('backend.master_setup.ministry.index', compact('data'));
    }


    public function create()
    {
        $data = new Ministry();
        $title="Create";
        return view('backend.master_setup.ministry.form', compact('data', 'title'));

    }

    public function store(MinistryRequest $request) {

        try {
            $ministry = new Ministry();
            $ministry->fill($request->all());
            $result=$ministry->save();

            if($result){
                return redirect()->route('admin.master_setup.ministries.index')->with('success','Data Saved successfully');
            }else{
                return redirect()->route('admin.master_setup.ministries.create')->with('error','Data does not save successfully')->withInput();
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
        $data = Ministry::findOrFail($id);
        $title="Edit";
        return view('backend.master_setup.ministry.form', compact('data', 'title'));

    }

    public function update(MinistryRequest $request, $id) {

        try {
            $ministry = Ministry::find($id);
            $data = $request->all();
            $data['status']= $request->status ?? 0;
            $result = $ministry->update($data);

            if($result){
                return redirect()->route('admin.master_setup.ministries.index')->with('success','Data Updated successfully');
            }else{
                return redirect()->route('admin.master_setup.ministries.edit', [$id])->with('error','Data does not update successfully')->withInput();
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
            $ministry = Ministry::find($id);
            $ministry->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(['status'=>'error']);
        }
    }

}
