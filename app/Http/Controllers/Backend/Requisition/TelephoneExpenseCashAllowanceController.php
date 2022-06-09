<?php

namespace App\Http\Controllers\Backend\Requisition;

use App\Model\TelephoneExpenseCashAllowancePabx;
use App\Model\Designation;
use App\Http\Controllers\Controller;
use App\cr;
use Illuminate\Http\Request;

class TelephoneExpenseCashAllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TelephoneExpenseCashAllowancePabx::orderBy('id', 'desc')->get();
        return view(
            'backend.requisition.expenses.index',
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
        $data = new TelephoneExpenseCashAllowancePabx();
        $title = "Create";
        $designation = Designation::orderBy('id', 'desc')->get();
        return view('backend.requisition.expenses.form', compact('data', 'title', 'designation'));
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
            $rights = new TelephoneExpenseCashAllowancePabx();
            $request->request->add(['designition_id' => json_encode($request->designition_id)]);
            $rights->fill($request->all());
            $result = $rights->save();

            if ($result) {
                // dd($result);
                return redirect()->route('admin.requisition.telephoneExpensesCashAllowance.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.requisition.telephoneExpensesCashAllowance.create')->with('error', 'Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            // dd($errorMessage)
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
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
        $data = TelephoneExpenseCashAllowancePabx::findOrFail($id);
        $title = "Edit";
        $designation = Designation::orderBy('id', 'desc')->get();
        return view('backend.requisition.expenses.form', compact('data', 'title', 'designation'));
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
            $ministry = TelephoneExpenseCashAllowancePabx::find($id);
            
            $request->request->add(['designition_id' => json_encode($request->designition_id)]);
            $data = $request->all();
            $data['status'] = $request->status ?? 0;
            $result = $ministry->update($data);

            if ($result) {
                return redirect()->route('admin.requisition.telephoneExpensesCashAllowance.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.requisition.telephoneExpensesCashAllowance.edit', [$id])->with('error', 'Data does not update successfully')->withInput();
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
            $ministry = TelephoneExpenseCashAllowancePabx::find($id);
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
