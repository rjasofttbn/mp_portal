<?php


 /*
Author: Naziur Rahman
Date: 22/03/2021

 */


namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;


use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use App\Model\AccommodationBuilding;
 use App\Model\User;
 use App\Model\FlatType;
 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Validator;
 use Auth;
 use Lang;
 use App\Traits\UsefulLibraryTrait;

class FlatTypeController extends Controller
{
    
    use UsefulLibraryTrait;

    public function index()
    {
        $data = FlatType::orderBy('id', 'desc')->get();
       return view('backend.accommodation.flat_type.index', compact('data'));
    }

    public function create()
    {
        $data = new FlatType();

        return view('backend.accommodation.flat_type.form', compact('data'));   
    }


    public function duplicateDataCheck(Request $request){


       
     

        $checkData['table']='flat_types';
        
            


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
           
       
    } 
   
    public function store(Request $request) {

        $rules = [

            'name' => 'required',            
            'name_bn' => 'required',
            'size' => 'required',
            'service_charge' => 'required'

            
         
        ];
        $message = [

            'name.required' => 'The name field is required.',           
            'name_bn.required' => 'The name field is required.',
            'size.required' => 'Flat size is required',
            'service_charge.required' => 'Service charge is required'

        ];
       
        $validator = Validator::make($request->all(), $rules,$message);

        if ($validator->fails()) {
            return response()->json(['status'=>'rulesfail']);

        }
        
        DB::beginTransaction();

        try {

            $flattype = new FlatType();
            $flattype->fill($request->all());
            $result = $flattype->save();

            if ($result) {
                DB::commit();
                return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);
            } else {
                return response()->json(['status'=>'error','message'=>Lang::get('Data Successfully not Insert')]);
            }

             } catch (\Exception $e) {
                DB::rollback();
                 //dd($e);
                return response()->json(['status'=>'error','message'=>Lang::get('Data Successfully not Insert')]);

           

             }


    }


  
    public function edit($id)
    {

        $data['editData'] = FlatType::findOrFail($id);
        
        return view('backend.accommodation.flat_type.form', $data);
    }

    
   
    public function update(Request $request, $id) {



        $rules = [

            'name' => 'required',            
            'name_bn' => 'required',
            'size' => 'required',
            'service_charge' => 'required'

            
         
        ];
        $message = [

            'name.required' => 'The name field is required.',           
            'name_bn.required' => 'The name field is required.',
            'size.required' => 'Flat size is required',
            'service_charge.required' => 'Service charge is required'

        ];
       
        $validator = Validator::make($request->all(), $rules,$message);

        if ($validator->fails()) {
            return response()->json(['status'=>'rulesfail']);

        }

        DB::beginTransaction();

        try {

            $flattypes = FlatType::find($id);


            $data = $request->all();


            $result = $flattypes->update($data);

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
            $flattypes = FlatType::find($id);
            $flattypes->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }
    
}
