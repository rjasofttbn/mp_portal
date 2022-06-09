<?php

 /*
Author: Naziur Rahman
Date: 6/05/2021

 */

namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Flat;
use App\Model\Floor;
use App\Model\FlatType;
use App\User;
use App\Model\AccommodationBuilding;
use App\Model\Area;
use Illuminate\Support\Facades\Validator;
use Lang;





class FlatController extends Controller
{
    
    public function index()
    {

        $data = Flat::orderBy('id', 'asc')->get();
       
      
        return view('backend.accommodation.flat.index', compact('data'));
    }


    public function create()
    {
        $flatTypeList = FlatType::orderBy('name', 'asc')->get();
       
        return view('backend.accommodation.flat.create', compact('flatTypeList'));


    }




    public function store(Request $request) {

        $rules = [

            'area_id' => 'required',            
            'building_id' => 'required',
            'flat_type_id' => 'required',            
            'select_flat' => 'required',
            
         
        ];
        $message = [

            'area_id.required' => 'This field is required.',           
            'building_id.required' => 'This field is required.',
            'flat_type_id.required' => 'This field is required.',           
            'select_flat.required' => 'This field is required.',
        ];
       
        $validator = Validator::make($request->all(), $rules,$message);

        if ($validator->fails()) {
            return response()->json(['status'=>'rulesfail']);

        }

        DB::beginTransaction();

        try {
            
            $flatlist = $request->select_flat;
            $flatTypeId= $request->flat_type_id;
            foreach($flatlist as $id){
            $result=DB::table('flats')
              ->where('id', $id)
              ->update(['flat_type_id' => $flatTypeId]);
            }           
          

            if($result){
                DB::commit();
                return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);
            }else{
                return response()->json(['status'=>'error','message'=>Lang::get('Data Successfully not Insert')]);
            }
        } catch (\Exception $e) {

            DB::rollback();
            // dd($e);
            return response()->json(['status'=>'error','message'=>Lang::get('Data Successfully not Insert')]);
        }


    }


    public function edit($id)
    {
        $data=Flat::findOrFail($id);        
        $flatTypeList = FlatType::orderBy('name', 'asc')->get();   

       return view('backend.accommodation.flat.edit', compact('data','flatTypeList'));

    }

    public function update(Request $request, $id) {

        $rules = [
            'flat_type_id' => 'required',            
            
         
        ];
        $message = [
            'flat_type_id.required' => 'This field is required.',           
        ];
       
        $validator = Validator::make($request->all(), $rules,$message);

        if ($validator->fails()) {
            return response()->json(['status'=>'rulesfail']);

        }


        $flatTypeId= $request->flat_type_id;
        DB::beginTransaction();

        try {
            
            $result=DB::table('flats')
            ->where('id', $id)
            ->update(['flat_type_id' => $flatTypeId]);
           

            if($result){
                
                DB::commit();
                return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);
            }else{
                return response()->json(['status'=>'error','message'=>Lang::get('Data Successfully not Insert')]);
            }
        } catch (\Exception $e) {

            DB::rollback();
            // dd($e);
            return response()->json(['status'=>'error','message'=>Lang::get('Data Successfully not Insert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $flat = Flat::find($id);

            $flat->delete();

            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }






}
