<?php


  /*
Author: Naziur Rahman
Date: 22/03/2021

 */
 
namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;


use App\Http\Controllers\Controller;
use App\Model\FlatType;
use Illuminate\Http\Request;
use App\Model\Area;
use App\Model\Flat;
use App\Model\Floor;
use App\Model\AccommodationBuilding;
use DB;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;
use App\Traits\BengaliLibraryTrait;
use Lang;
use Illuminate\Support\Facades\Validator;




class FloorFlatController extends Controller
{
    

    use BengaliLibraryTrait;


    public function index()
    {       
       
     $data = AccommodationBuilding::orderBy('id')->get();
     $buildingIdList = DB::table('accommodation_buildings')->select('id')->whereNull('deleted_at')->get();
        $i=0;
    foreach($buildingIdList as $value) {
      $totalFlat[$i] = Flat::where('building_id', $value->id)->count();
    $i++;
        }     

    return view('backend.accommodation.floor_flat.index', compact('data','totalFlat'));
    }


    public function create()
    {
      
        return view('backend.accommodation.floor_flat.create');


    }




    public function store(Request $request) {

       $rules = [

        'area_id' => 'required',            
        'building_id' => 'required',        
        'floor_id' => 'required',            
        'totalflat' => 'required',
        'startno' => 'required',

        
     
    ];
    $message = [

        'area_id.required' => 'Area field is required.',           
        'building_id.required' => 'Building field is required.',
        'floor_id.required' => 'Floor field is required.',           
        'totalflat.required' => 'Total flat field is required.',
        'startno.required' => 'Start number field is required.',           
    ];
   
    $validator = Validator::make($request->all(), $rules,$message);

    if ($validator->fails()) {
        return response()->json(['status'=>'rulesfail']);

    }
   

        $floorno= $request->input('floor_id');
        $startno= $request->input('startno');
        $totalflat= $request->input('totalflat');
        $building_id= $request->input('building_id');
  

          $flatnumber=array();
          $flatnumberbangla=array();
          $l=0;
          DB::beginTransaction();

          for($c=0;$c<count($floorno);$c++){
          for($i=0,$j=$startno[$c];$i<$totalflat[$c];$i++,$j++){     
              $flatnumber[$l]=$j;
              $flatnumberbangla[$i]= $this->en2bnNumber($flatnumber[$l]);           
              try {
              $flat = new Flat();
              $flat->number = $flatnumber[$l];
              if(Flat::where('number','=',$flatnumber[$l])->where('floor_id','=',$floorno[$c])->exists()){
                DB::rollBack();
                return response()->json(["status"=>"flatexist"]);
              }
              $flat->number_bn = $flatnumberbangla[$i];
              $flat->floor_id = $floorno[$c];
              $flat->building_id = $building_id;
              $flat->area_id = $request->input('area_id');
              $flat->created_by = authInfo()->id;
              $result = $flat->save();
              $l++;   
                 
              if($result){
                  }else{
                    return response()->json(['status'=>'error','message'=>Lang::get('Data Successfully not Insert')]);
                }            
              } catch (\Exception $e) {
                DB::rollBack();
                // dd($e);
                return response()->json(['status'=>'error','message'=>Lang::get('Data Successfully not Insert')]);
              }
          }       
      } 
      
      if($result){
        DB::commit();
        return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);
          }

      }
  
  

    public function edit($id)
    {


        $data=AccommodationBuilding::findOrFail($id);     
        
        $areaName =Area::Where('id', $data->area_id)->value('name');
       
        $totalFloor = AccommodationBuilding::where('id', $id)->value('total_floor');

        $floorData = Floor::select('id', 'name')->orderBy('id', 'asc')->where('id', '<=', $totalFloor)->get();
            
        $floorList = Flat::orderBy('id', 'asc')->where('building_id',$id)->get()->unique('floor_id');
        
        $totalFlat=array();
        $i=0;
        $j=0;

        $flatStartNo=array();
        $floorId=array();

        foreach($floorList as $value){
            
            $floorNo[]=Floor::where('id',$value->floor_id)->value('name');
            $floorId[]=$value->floor_id;
            $totalFlat[$i++] = Flat::where('building_id',$id)->where('floor_id',$value->floor_id)->count();
            $flatStartNo[$j++] = Flat::where('building_id',$id)->where('floor_id',$value->floor_id)->min('number');

        }
       
       return view('backend.accommodation.floor_flat.update', compact('data','floorData','areaName','floorNo','totalFlat','flatStartNo','floorId'));


    }

    public function update(Request $request, $id) {    

         $floorno= $request->input('floor_id'); 
         $existfloordata=DB::table('flats')->where('building_id', $id)->select('floor_id')->get();
       
         foreach($existfloordata as $value) {
            if(!in_array($value, $floorno)) {              
            
                DB::table('flats')->where('building_id', $id)->where('floor_id',$value->floor_id )->delete();

            }
          }

         
        $startno= $request->input('startno'); 
        $totalflat= $request->input('totalflat');       
 
         $flatnumber=array();
         $flatnumberbangla=array();
         $l=0;
        $maxflatnumber=0;
        DB::beginTransaction();

         for($c=0;$c<count($floorno);$c++){                     
         for($i=0,$j=$startno[$c];$i<$totalflat[$c];$i++,$j++){                                   
             $flatnumber[$l]=$j;
             $flatnumberbangla[$i]= $this->en2bnNumber($flatnumber[$l]);        
             $flat = new Flat();
             $flat->number = $flatnumber[$l];
             if(Flat::where('number','=',$flatnumber[$l])->where('floor_id','=',$floorno[$c])->exists()){
              //  return redirect()->route('admin.accommodation.floorflats.edit',[$id])->with('error','Flat Number already Exists!')->withInput();
                $result=true;
             }
             else{

             $flat->number_bn = $flatnumberbangla[$i];             
             $flat->floor_id = $floorno[$c];            
             $flat->building_id = $id; 
             $flat->area_id = $request->input('area_id'); 
             $flat->updated_by = authInfo()->id; 
             $result = $flat->save();     
             $l++;   
             }             
             try {
                 if($result){

                    $maxflatnumber=$j;

                 }else{
                    return response()->json(['status'=>'error','message'=>Lang::get('Data Successfully not Insert')]);
                }            
              
             } catch (\Exception $e) {
                 DB::rollback();
            //dd($e);
            return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully not Updated')]);
     
             }
  
         }  
        
            DB::table('flats')->where('building_id', $id)->where('floor_id',$floorno[$c])->where('number','>',$maxflatnumber)->delete();
            DB::table('flats')->where('building_id', $id)->where('floor_id',$floorno[$c])->where('number','<',$startno[$c])->delete();

     } 

     if($result){
         
        DB::commit();
        return response()->json(['status'=>'success','message'=>Lang::get('Data Successfully Insert')]);

     }

    }

    public function destroy($id)
    {
        try {
            

            $result=DB::table('flats')->where('building_id', $id)->delete();
            
            if($result){
                return response()->json(["status"=>"allflatdelete"]);

            }
       


        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }



}
