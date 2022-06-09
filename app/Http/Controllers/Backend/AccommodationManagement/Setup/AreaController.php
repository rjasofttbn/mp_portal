<?php


  /*
Author: Naziur Rahman
Date: 22/03/2021

 */
 
 namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use App\Model\Area;
 use App\Model\User;
 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Validator;
 use Auth;
 use Lang;
 use App\Traits\UsefulLibraryTrait;


 class AreaController extends Controller
 {

    use UsefulLibraryTrait;

    public function index()
    {

        $data = Area::orderBy('id', 'desc')->get();

        return view('backend.accommodation-management.setup.area.index', compact('data'));
    }


    public function create()
    {
        $data = new Area();

        return view('backend.accommodation-management.setup.area.form', compact('data'));

    }
    

    public function duplicateDataCheck(Request $request){


        $checkData['table']='areas';
        $checkData['key']='name'; 

        if($request->checkvalue){

            $checkData['key']='name';
            $checkData['value']=$request->checkvalue;

        }

        if($request->checkvalue_bn){

            $checkData['key']='name_bn';
            $checkData['value']=$request->checkvalue_bn;

        }        

        if($request->checkvalue_bn=='except'||$request->checkvalue=='except'){
            return response()->json(true);
        }
        else if($this->duplicateCheck($checkData)){    
            return response()->json(Lang::get('This name already exist'));
        }else{
            return response()->json(true);
        }
    } 

    public function store(Request $request) {


        $rules = [

            'name' => 'required',            
            'name_bn' => 'required',
            
         
        ];
        $message = [

            'name.required' => 'The name field is required.',           
            'name_bn.required' => 'The name field is required.',
        ];
       
        $validator = Validator::make($request->all(), $rules,$message);

        if ($validator->fails()) {
            return response()->json(['status'=>'rulesfail']);

        }
      

        DB::beginTransaction();
        try {
            $area = new Area();
            $area->fill($request->all());
            $result = $area->save();

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
        $data['editData']=Area::findOrFail($id);
        return view('backend.accommodation-management.setup.area.form', $data);

    }

    public function update(Request $request, $id) {

        $rules = [

            'name' => 'required',            
            'name_bn' => 'required',
            
         
        ];
        $message = [

            'name.required' => 'The name field is required.',           
            'name_bn.required' => 'The name field is required.',
        ];
       
        $validator = Validator::make($request->all(), $rules,$message);

        if ($validator->fails()) {
            return response()->json(['status'=>'rulesfail']);

        }
      

        DB::beginTransaction();
        try {
            $area = Area::find($id);
            $data = $request->all();
            $result = $area->update($data);

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
            $area = Area::find($id);
            $area->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }





}
