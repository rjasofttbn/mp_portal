<?php

namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\HostelBuilding;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\HostelBuildingRequest;
use Illuminate\Support\Facades\Lang;

use Illuminate\Support\Facades\Validator;

class HostelBuildingController extends Controller
{
    //

    public function index()
    {
        $data = HostelBuilding::orderBy('id', 'desc')->get();
        // dd($data);
        return view('backend.accommodation-management.setup.hostel-building.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new HostelBuilding();
        return view('backend.accommodation-management.setup.hostel-building.form', compact('data'));
    }
     
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $u_id = authInfo()['id'];
        // validation
     $rules = [
        'name' => 'required',
        'name_bn' => 'required',
    ];
    $message = [
        'name.required' => 'The name english field is required.',
        'name_bn.required' => 'The name bangla field is required.',
    ];
    $validator = Validator::make($request->all(), $rules, $message);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
            DB::beginTransaction();
                try {
                    extract($_REQUEST);
                    $result=DB::table('hostel_buildings')->insert(
                [
                "name" =>"$name", 
                "name_bn" =>"$name_bn", 
                "total_floor" =>"$total_floor", 
                "created_by"=>$u_id,
                ]
            );
            if($result){
                DB::commit();
                return response()->json(['status'=>'success','message'=>\Lang::get('Data Saved successfully')]);
            }else{
                return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert_Insert')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
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
        $data['editData'] = HostelBuilding::findOrFail($id);
        // $data['areas'] = HostelBuilding::orderBy('name', 'asc')->get();
        return view('backend.accommodation-management.setup.hostel-building.form', $data);
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
        // validation
        $rules = [
            'name' => 'required',
            'name_bn' => 'required',
        ];
        $message = [
            'name_bn.required' => 'The name english field is required.',
            'name_bn.required' => 'The name bangla field is required.',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            
            $building = HostelBuilding::find($id);
            $data = $request->all();
            $data['status']= $request->status ?? 0;
            $result = $building->update($data);
            if($result){
                DB::commit();
                return response()->json(['status'=>'success','message'=>\Lang::get('Data Saved successfully')]);
            }else{
                return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert_Insert')]);
            }
           
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
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
            $building = HostelBuilding::find($id);
            $building->delete();
            return response()->json(["status"=>"success"]);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }



}
