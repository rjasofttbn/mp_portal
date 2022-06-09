<?php
/**
 * Author Md. Omar Faruk
 * Date: 18/04/2021
 * Time: 09:49 AM
 */
namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\HostelBuilding;
use App\Model\HostelFloor;
use App\Model\OfficeRoomType;
use Illuminate\Support\Facades\Auth;

use DB;
use Illuminate\Support\Facades\Validator;

class OfficeRoomTypeController extends Controller
{
    
    public function index()
   
    { 
        $datas = OfficeRoomType::orderBy('id', 'desc')->get();
       return view('backend.accommodation-management.setup.office-room-type.index', compact('datas'));
    }

    public function create()
    {
        $data = new OfficeRoomType();
        return view('backend.accommodation-management.setup.office-room-type.create', compact('data'));   
    }

   
    public function store(Request $request)
    {
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
        try {
            extract($_REQUEST);
            $result=DB::table('office_room_types')->insert(
        ["service_charge" =>"$service_charge",
        "name" =>"$name", 
        "name_bn" =>"$name_bn", 
        "created_by"=>Auth::id(),
        ]
    );
    if($result){
        DB::commit();
        return response()->json(['status'=>'success','message'=>\Lang::get('Data Saved successfully')]);
    }else{
        return response()->json(['status'=>'error','message'=>\Lang::get('Data Successfully not Insert_Insert')]);
    }
            // if($result){
            //     return redirect()->route('admin.accommodation-management.setup.office_room_types.index')->with('success','Data Saved successfully');
            // }else{
            //     return redirect()->route('admin.accommodation-management.setup.office_room_types.create')->with('error','Data does not save successfully')->withInput();
            // }
        } catch (\Exception $e) {
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
       $data= OfficeRoomType::findOrFail($id); 
        return view('backend.accommodation-management.setup.office-room-type.edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
     
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


            $OfficeRoomType = OfficeRoomType::find($id);
            $data = $request->all();
          
            $data['name_bn']= $request['name_bn'];
            $data['status']= $request->status ?? 0;
            $result = $OfficeRoomType->update($data);

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

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    public function destroy($id)
    {
        try {
            $office = OfficeRoomType::find($id);
            $office->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }
    
}
