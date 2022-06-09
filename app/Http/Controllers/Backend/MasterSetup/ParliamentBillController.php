<?php

namespace App\Http\Controllers\Backend\MasterSetup;

use App\Http\Controllers\Controller;
use App\Model\ParliamentBill;
use App\Model\ParliamentBillClause;
use App\Model\ParliamentBillSubClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParliamentBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = ParliamentBill::all();
        return view('backend.master_setup.parliament_bills.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('backend.master_setup.parliament_bills.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $this->billData($request);
            DB::commit();
            return redirect()->back()->with('success', 'successfully created');
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
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
        $data['editData'] = ParliamentBill::find($id);
        return view('backend.master_setup.parliament_bills.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        // dd($request->all());
        DB::beginTransaction();
        try {
            // dd($request->deletedRows);
            // dd($deletedClauses);
            if ($request->deletedRows) {
                $deletedClauses = explode(',', $request->deletedRows);
                if (empty(end($deletedClauses))) {
                    unset($deletedClauses[count($deletedClauses) - 1]);
                }
                // dd($deletedClauses);
                ParliamentBillSubClause::whereIn('parliament_bill_clause_id', $deletedClauses)->forceDelete();
                ParliamentBillClause::whereIn('id', $deletedClauses)->forceDelete();
            }
            $this->billData($request, $id);
            DB::commit();
            return redirect()->back()->with('success', 'successfully updated');
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
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
        //
    }

    protected function billData($request, $id = null)
    {
        $params = $request->only('name', 'name_bn');
        if ($file = $request->file('attachment')) {
            $extension = $file->getClientOriginalExtension();
            $filename = 'parliament_bill' . '_' . time() . random_int(0, 1000) . '.' . $file->getClientOriginalExtension(); // Make a file name
            $folder = public_path('/backend/attachment/parliament_bills/'); // Define folder path
            $file->move($folder, $filename); // Upload image
            $params['attachment'] = $filename;
        }

        if ($id) {
            $bill = ParliamentBill::find($id);
            $bill->update($params);
        }else{
            $bill = ParliamentBill::create($params);
        }
        
        if (count($request->title) > 0) {
            foreach ($request->title as $key => $value) {
                if ($value) {
                    
                    if ($request->clause_ids[$key]) {
                        $clause = ParliamentBillClause::find($request->clause_ids[$key]);
                        ParliamentBillSubClause::where('parliament_bill_clause_id', $request->clause_ids[$key])->forceDelete();
                    }else{
                        $clause = new ParliamentBillClause;
                    }
                    // dd($clause->toArray());
                    $clause->title = $value;
                    $clause->parliament_bill_id = $bill->id;
                    $clause->number = $request->number[$key];
                    $clause->status = $request->clause_status[$key];
                    $clause->save();
                    for ($i = 1; $i <= $request->sub_clause_qty[$key]; $i++) {
                        $subClause = new ParliamentBillSubClause;
                        $subClause->parliament_bill_id = $bill->id;
                        $subClause->parliament_bill_clause_id = $clause->id;
                        $subClause->number = $i;
                        $subClause->save();
                    }
                }
            }
        }
        
    }
}
