<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 4/12/20
 * Time: 11:40 AM
 */

namespace App\Http\Controllers\Backend\NoticeManagement;


use App\Model\Department;
use App\Model\ParliamentRule;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\NoticeRulesRequest;
use Auth;


class ParliamentRulesController extends Controller
{

    public function index()
    {
        $data = ParliamentRule::orderBy('id', 'desc')->get();

        return view('backend.noticeManagement.rules.index', compact('data'));
    }



    public function create()
    {
        $data = new ParliamentRule();
        $departments = Department::all();

        return view('backend.noticeManagement.rules.form', compact('data', 'departments'));

    }

    public function store(NoticeRulesRequest $request) {

        try {
            $ruleEloquent = new ParliamentRule();
            $ruleEloquent->fill($request->all());
            $result=$ruleEloquent->save();

            if($result){
                return redirect()->route('admin.notice_management.parliament_rules.index')->with('success','Data Saved successfully');
            }else{
                return redirect()->route('admin.notice_management.parliament_rules.create')->with('error','Data does not save successfully')->withInput();
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
        $data = ParliamentRule::findOrFail($id);
        $departments = Department::all();
        return view('backend.noticeManagement.rules.form', compact('data', 'departments'));

    }

    public function update(NoticeRulesRequest $request, $id) {

        try {
            $ruleEloquent = ParliamentRule::find($id);
            $data = $request->all();
            $data['status']= $request->status ?? 0;
            $result = $ruleEloquent->update($data);

            if($result){
                return redirect()->route('admin.notice_management.parliament_rules.index')->with('success','Data Updated successfully');
            }else{
                return redirect()->route('admin.notice_management.parliament_rules.edit', [$id])->with('error','Data does not update successfully')->withInput();
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
            $ruleEloquent = ParliamentRule::find($id);
            $ruleEloquent->delete();
            return response()->json(["status"=>"success"]);
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }


    public function show($id)
    {
        $data = ParliamentRule::findOrFail($id);
        return view('backend.noticeManagement.rules.details', compact('data'));

    }

}
