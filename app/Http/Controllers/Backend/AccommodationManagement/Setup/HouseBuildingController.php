<?php

/* 
Author: Naziur Rahman
Date: 22/03/2021

*/

namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;


use App\Model\Area;
use Illuminate\Http\Request;
use App\Traits\UsefulLibraryTrait;
use App\model\AccommodationType;
use App\Http\Controllers\Controller;
use App\Model\HouseBuilding;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Lang;


class HouseBuildingController extends Controller
{
    use UsefulLibraryTrait;



    public function index()
    {


            
        $data = HouseBuilding::orderBy('id', 'desc')->get();

        return view('backend.accommodation.house_building.index', compact('data'));
    }


    public function create()
    {
        $data = new HouseBuilding();

        return view('backend.accommodation.house_building.form', compact('data'));


    }

    public function duplicateDataCheck(Request $request){


       
     

        $checkData['table']='house_buildings';
        
            


        if($request->checkname_bn=='except'||$request->checkname=='except'){
            return response()->json(true);
        }

        else if($request->checkname){

            $checkData['key']='name';
            $checkData['value']=$request->checkname;
           if($this->duplicateCheck($checkData)){
            
            return response()->json(Lang::get('This Name already exist'));

           }
           else{
            return response()->json(true);



           }

        }

        else if($request->checkname_bn){

            $checkData['key']='name_bn';
            $checkData['value']=$request->checkname_bn;
            if($this->duplicateCheck($checkData)){
            
                return response()->json(Lang::get('This Name already exist'));
    
               }
               else{
                return response()->json(true);



               }

        }    
        else if($request->checkbuilding_no){

            $checkData['key']='building_no';
            $checkData['value']=$request->checkbuilding_no;
            if($this->duplicateCheck($checkData)){
            

                return response()->json(Lang::get('This Building No. already exist!'));
    
               }else{
                return response()->json(true);



               }

        }        
       
    } 


    public function store(Request $request) {

        $rules = [

            'name' => 'required',            
            'name_bn' => 'required',
            'building_no' => 'required',
            'area_id' => 'required'

            
         
        ];
        $message = [

            'name.required' => 'The name field is required.',           
            'name_bn.required' => 'The name field is required.',
            'building_no.required' => 'Building No is required',
            'area_id.required' => 'Area is required'

        ];
       
        $validator = Validator::make($request->all(), $rules,$message);

        if ($validator->fails()) {
            return response()->json(['status'=>'rulesfail']);

        }
        
        DB::beginTransaction();

        try {

            $housebuilding = new HouseBuilding();
            $housebuilding->fill($request->all());
            $result = $housebuilding->save();

            if ($result) {
                DB::commit();
                return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);
            } else {
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
        $data['editData'] = HouseBuilding::findOrFail($id);
        
        return view('backend.accommodation.house_building.form', $data);
    }


    public function update(Request $request, $id) {







        $rules = [

            'name' => 'required',            
            'name_bn' => 'required',
            'building_no' => 'required',
            'area_id' => 'required'

            
         
        ];
        $message = [

            'name.required' => 'The name field is required.',           
            'name_bn.required' => 'The name field is required.',
            'building_no.required' => 'Building No is required',
            'area_id.required' => 'Area is required'

        ];
       
        $validator = Validator::make($request->all(), $rules,$message);

        if ($validator->fails()) {
            return response()->json(['status'=>'rulesfail']);

        }

        DB::beginTransaction();

        try {

            $housebuilding = HouseBuilding::find($id);


            $data = $request->all();


            $result = $housebuilding->update($data);

            if($result){
                DB::commit();
                return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Updated')]);
            }else{
                return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully not Updated')]);


            }
        } catch (\Exception $e) {
            DB::rollback();
            //dd($e);
            return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully not Updated')]);
        }
    }

    public function destroy($id)
    {
        try {
            $housebuilding = HouseBuilding::find($id);

            $housebuilding->delete();

            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }




}
