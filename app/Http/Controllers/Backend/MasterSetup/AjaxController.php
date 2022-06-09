<?php

namespace App\Http\Controllers\Backend\MasterSetup;


use App\Model\District;
use App\Model\Division;
use App\Model\ResidentialFlat;
use App\Model\Floor;
use App\Model\ResidentialBuilding;
use App\Model\HostelBuilding;
use App\Model\Flat;
use App\Model\Upazila;
use App\Model\Constituency;
use App\Model\ParliamentSession;
use App\Model\ParliamentBillSubClause;
use App\Model\ParliamentBillClause;
use App\Http\Controllers\Controller;
use App\Model\AccommodationBuilding;
use App\Model\User;
use App\Model\AccommodationApplication;
use App\Model\AccommodationAsset;
use App\Model\HostelFloor;
use App\Model\OfficeRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Illuminate\Support\Facades\Redirect;




class AjaxController extends Controller
{
    public function clauseByParliamentBillId(Request $request)
    {
        $parliament_bill_id = $request['parliament_bill_id'];

        $clauses = ParliamentBillClause::where('parliament_bill_id', $parliament_bill_id)->orderBy('id', 'asc')->get();
        
        if (isApi()) {
            $data['clauses'] = $clauses;
            
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = $data;
            return response()->json($response);
        }
        return response()->json(array(
            'data' => $clauses,

        ));
    }
    public function subClauseByParliamentBillId(Request $request)
    {
        $parliament_bill_id = $request['parliament_bill_id'];
        $bill_clause_id = $request['bill_clause_id'];

        $subClauses = ParliamentBillSubClause::where('parliament_bill_id', $parliament_bill_id)->where('parliament_bill_clause_id', $bill_clause_id)->orderBy('id', 'asc')->get();
        
        if (isApi()) {
            $data['sub_clauses'] = $subClauses;
            
$response['status'] = 'success';
$response['message'] = '';
$response['api_info']    = $data;
            return response()->json($response);
        }
        return response()->json(array(
            'data' => $subClauses,

        ));
    }


    // Author Rajan Bhatta: Ceated date: 24-01-2021
    // Get District List By Division Id:

    public function districtListByDivisionId(Request $request)
    {
        $division_id = $request['division_id'];

        $divisionList = District::where('division_id', $division_id)->orderBy('name', 'asc')->get();
// dd($divisionList);
        return response()->json(array(
            'data' => $divisionList,

        ));
    }

    public function floorListByBuildingId(Request $request)
    {
        $building_id = $request['building_id'];
        $BuildingList = HostelFloor::where('building_id', $building_id)->orderBy('name', 'asc')->get();
        return response()->json(array(
            'data' => $BuildingList,
        ));
    }

    public function accommodationTypeByAssetNameId(Request $request)
    {
        $accommodation_asset_type_id = $request['accommodation_asset_type_id[]'];
        $acc_ass = AccommodationAsset::where('accommodation_asset_type_id', $accommodation_asset_type_id)->orderBy('name_bn', 'asc')->get();
        return response()->json(array(
            'data' => $acc_ass,
        ));
    }

    
    public function assListByAccAssTypeId(Request $request)
    {
        $accommodation_asset_type_id = $request['accommodation_asset_type_id'];
        $acc_ass_list = AccommodationAsset::where('accommodation_asset_type_id', $accommodation_asset_type_id)->orderBy('name', 'asc')->get();
        return response()->json(array(
            'data' => $acc_ass_list,
        ));
    }

    // public function buildingListByAreaId(Request $request)
    // {
    //     $area_id = $request['area_id'];

    //     $buildingList = AccommodationBuilding::where('Area_id', $area_id)->orderBy('name', 'asc')->get();

    //     return response()->json(array(
    //         'data' => $buildingList,

    //     ));
    // }

    // public function flatListByBuildingId(Request $request)
    // {
    //     $building_id = $request['building_id'];

    //     $flatList = Flat::where('building_id', $building_id)->orderBy('number', 'asc')->get();

    //     return response()->json(array(
    //         'data'=>$flatList,

    //     ));
    //     return Redirect::to('http://heera.it');


    // }




    // Author Rajan Bhatta: Ceated date: 24-01-2021
    // Get Upazila List By District Id:

    public function upazilaListByDistricId(Request $request)
    {
        $district_id = $request['district_id'];

        $districtList = Upazila::where('district_id', $district_id)->orderBy('name', 'asc')->get();

        return response()->json(array(
            'data' => $districtList,

        ));
    }

    // Author sumon-php: Ceated date: 03-02-2021
    // Get constituencies List By District Id:

    public function constituenciesListByDistrictId(Request $request)
    {
        $district_id = $request['district_id'];

        $constituenciesList = Constituency::where('district_id', $district_id)->orderBy('name', 'asc')->get();

        return response()->json(array(
            'data' => $constituenciesList,

        ));
    }

    // Author M. Atoar Rahman: Ceated date: 23-01-2021
    // Get Floor List By Building Id:

    public function residentilaFlatListByBuildingId(Request $request)
    {
        $building_id = $request['building_id'];
        $floorData = ResidentialBuilding::select('total_floor')->where('id', $building_id)->get();
        foreach ($floorData as $floorData) {
            $totalFloor = $floorData->total_floor;
        }
        $floorList = Floor::select('id', 'name')->orderBy('id', 'asc')->limit($totalFloor)->get();

        return response()->json(array(
            'data' => $floorList,
        ));
    }

    // Author M. Atoar Rahman: Ceated date: 23-01-2021
    // Get Floor List By Building Id:

    public function residentilaFlatByBuildingId(Request $request)
    {
        $building_id = $request['building_id'];

        $flatData = ResidentialFlat::where('building_id', $building_id)->orderBy('id', 'asc')->get();

        return response()->json(array(
            'data' => $flatData,

        ));
    }

    // Author M. Atoar Rahman: Ceated date: 03-02-2021
    // Get Constituency List By District Id:

    public function constituencyListByDistricId(Request $request)
    {
        $district_id = $request['district_id'];

        $constituencyData = Constituency::where('district_id', $district_id)->orderBy('id', 'asc')->get();

        return response()->json(array(
            'data' => $constituencyData,

        ));
    }



    // Author Rajan Bhatta: Ceated date: 27-01-2021
    // Get Floor List By Hostel Building Id:

    // public function floorListByHostelBuildingID(Request $request)
    // {
    //     $building_id = $request['building_id'];
    //     $floorData = HostelBuilding::select('total_floor')->where('id', $building_id)->first();
    //     $totalFloor=$floorData['total_floor'];

    //     $floorList = Floor::select('id','name')->orderBy('id', 'asc')->where('id','<=', $totalFloor)->get();

    //     return response()->json(array(
    //         'data'=>$floorList,
    //     ));

    // }

    public function floorListByAccommodationBuildingId(Request $request)
    {
        $building_id = $request['building_id'];
        $floorData = AccommodationBuilding::select('total_floor')->where('id', $building_id)->first();
        $totalFloor = $floorData['total_floor'];

        $floorList = Floor::select('id', 'name')->orderBy('id', 'asc')->where('id', '<=', $totalFloor)->get();
        return response()->json(array(
            'data' => $floorList,
        ));
    }




    // Author Rajan Bhatta: Ceated date: 01-02-2021
    // Get District List By Division Id:

    public function sessionListByParliamentId(Request $request)
    {
        $parliament_id = $request['parliament_id'];

        $sessionList = ParliamentSession::where('parliament_id', $parliament_id)->orderBy('id', 'desc')->get();

        dd($sessionList);

        return response()->json(array(
            'data' => $sessionList,

        ));
    }


    // Author Rajan Bhatta: Ceated date: 02-02-2021
    //  Parliament session date by session ID:

    public function sessionDateBySessionId(Request $request)
    {
        $session_id = $request['session_id'];
        $sessionList = ParliamentSession::where('id', $session_id)->orderBy('id', 'desc')->first();
        dd($sessionList);
        return response()->json(array(
            'data' => $sessionList,
        ));
    }

    /* Author Md. Omar Faruk: Ceated date: 30-03-2021*/
    /* Get Building List By Area Id: Start*/
    public function buildingListByAreaId(Request $request)
    {
        $area_id = $request['area_id'];
        $buildingList = AccommodationBuilding::where('Area_id', $area_id)->orderBy('name', 'asc')->get();
        return response()->json(array(
            'data' => $buildingList,
        ));
    }

    public function buildingListByArea(Request $request)
    {
        $area_id = $request->area_id;
        $buildings = AccommodationBuilding::where('area_id', $area_id)->orderBy('name', 'asc')->get();
        
        $html = "<option value=''>বিল্ডিং নির্বাচন করুন</option>";
        foreach ($buildings as $key => $list) {
        $html .= "<option value=''>".$list->name_bn."</option>";
        }
        return $html;
    }

   

    public function flatListByBuildingId(Request $request)
    {

       

        $building_id = $request['building_id'];
        $flatList = Flat::where('building_id', $building_id)->orderBy('number', 'asc')->get();
        return response()->json(array(
            'data' => $flatList,
        ));
    }
    
    public function officeRoomListByFloorId(Request $request)
    {
        $hostel_floor_id = $request['floor_id'];
        $officeRoomList = OfficeRoom::where('hostel_floor_id', $hostel_floor_id)->orderBy('number_bn', 'asc')->get();
        // dd($officeRoomList);
        return response()->json(array(
            'data' => $officeRoomList,
        ));
    }

    public function floorListByFlatId(Request $request)
    {
        $flat_id = $request['flat_id'];
        $floorList = Floor::where('flat_id', $flat_id)->orderBy('name', 'asc')->get();
        return response()->json(array(
            'data' => $floorList,
        ));
    }
    /* end*/

    // public function hostelBuildingListByAreaId(Request $request)
    // {
    //     $area_id = $request['area_id'];

    //     $buildingList = HostelBuilding::where('Area_id', $area_id)->orderBy('name', 'asc')->get();

    //     return response()->json(array(
    //         'data' => $buildingList,

    //     ));
    // }



   public function accommodationFlatListByBuilding(Request $request)
    {
    $where = [];
    if($request->area_id){
        $where[] = ['area_id','=',$request->area_id];
    }
    if($request->building_id){
        $where[] = ['building_id','=',$request->building_id];
    } 
    $data['accommodation_application_id'] = $request->accommodation_application_id;
    $data['flats'] = Flat::where($where)->orderBy('number','asc')->get();
     return view('backend.accommodation.department.approve_application_data', $data);
    }
   public function accommodationFlatListByBuildingId(Request $request)
    {

         
   
    $building_id = $request['building_id'];


     $allocatedflatList = DB::table('flats')
    ->join ('floors', 'floors.id', '=', 'flats.floor_id')
    ->join('flat_types', 'flat_types.id', '=', 'flats.flat_type_id')
    ->where('building_id',$building_id)->where('status_id', 3)
    ->select('flats.id as id', 'flats.number as number', 'floors.name as floorname', 'flat_types.size as size', 'flats.status_id as status')->get();  
     

    $assignedflatList = DB::table('flats')
    ->join ('floors', 'floors.id', '=', 'flats.floor_id')
    ->join('flat_types', 'flat_types.id', '=', 'flats.flat_type_id')
    ->where('building_id',$building_id)->where('status_id', 1)
    ->select('flats.id as id', 'flats.number as number', 'floors.name as floorname', 'flat_types.size as size', 'flats.status_id as status')->get();  
    


    
/*  
    foreach ($allocatedflatList as $value){
       
       $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
        
        $allocatedflatList = $allocatedflatList->map(function($item) use ($data) {
       
        $item->constituencyname = $data ;
        return $item;
      });   
        
    }
 
 */

 
    
     
    $notallocatedflatList = DB::table('flats')
    ->join ('floors', 'floors.id', '=', 'flats.floor_id')
    ->join('flat_types', 'flat_types.id', '=', 'flats.flat_type_id') 
    ->where('building_id',$building_id)->where('status_id', 15)
    ->select('flats.id as id', 'flats.number as number', 'floors.name as floorname', 'flat_types.size as size', 'flats.status_id as status')->get(); 
 
 

          $totalflat=DB::table('flats')->where('building_id',$building_id )->whereNotNull('flat_type_id')->count();

          $allocatedflat=DB::table('flats')->where('building_id',$building_id )->whereNotNull('flat_type_id')->where('status_id',3 )->count();

          $availableflat=DB::table('flats')->where('building_id',$building_id )->whereNotNull('flat_type_id')->where('status_id',2 )->count();

          

      
            $flatdata = array(array("totalflat"=>$totalflat, "allocatedflat"=>$allocatedflat, "availableflat"=>$availableflat));
            


    $merged = $notallocatedflatList->merge($allocatedflatList)->merge($assignedflatList);
   


    $flatList = $merged->all();  
    

       return response()->json(array(
         'data' => $flatList,
         'flatdata'=>$flatdata

        ));
    }

    public function confirmApplicationByAccommodationDepartment(Request $request)
    {
        $flat_id = $request->flat_id;
        $accommodation_application_id = $request->accommodation_application_id;
        $allocateddate = date('Y-m-d',strtotime($request->allocateddate));

        $update = AccommodationApplication::find($accommodation_application_id);
        $update->flat_id = $flat_id;
        $update->department_ar_date = $allocateddate;
        $update->department_ar_by = authInfo()->id;
        $update->status = 2;
        $update->save();
        return response()->json(["status"=>"success"]);
    }


    public function confirmUpdatedApplicationByWhip(Request $request)
    {

     
   
    $flatid = $request['id'];
    $mpid=$request['mpid'];
    $appid=$request['appid'];
    $allocateddate=$request['allocateddate'];
    $date = date_format(date_create($allocateddate), 'Y-m-d');

    DB::table('flats')
              ->where('id', $flatid)
              ->update(['user_id' => $mpid,
              'is_available'=> 0,
              'allocated_date'=>$date,
              'apply_status' => 2
              
              
              
              ]);
     DB::table('accommodation_applications')
              ->where('id', $appid)
              ->update(['status' => 5
             
              
                ]);      


    
     return response()->json(["status"=>"success"]);
    }
    





    public function applicationListByAccommodationDepartment(Request $request)
    {
    $type = $request['type'];
    $start = $request['start'];
    $applisttype = $request['applisttype'];
    $approve = $request['approve'];

    if($applisttype=='2'){
        

        $data = DB::table('accommodation_applications')
        ->join ('users', 'users.id', '=', 'accommodation_applications.application_from')
        ->join('areas', 'areas.id', '=', 'accommodation_applications.area_id')
        ->join('accommodation_application_types', 'accommodation_application_types.id', '=', 'accommodation_applications.application_type_id')
        ->select('accommodation_applications.id as id','accommodation_applications.status as status', 'accommodation_application_types.name as applicationsubject','accommodation_application_types.name_bn as applicationsubject_bn', 'accommodation_applications.date as applicationdate', 'accommodation_applications.date_bn as applicationdate_bn','users.id as mpid', 'users.name as mpname', 'users.name_bn as mpname_bn', 'areas.name as areaname','areas.name_bn as areaname_bn')
        ->where('accommodation_applications.status',1)->get(); 

    
    
    }

   

    if($type=='#approved'|| $approve=='success'){
        $data = DB::table('accommodation_applications')
        ->join ('users', 'users.id', '=', 'accommodation_applications.application_from')
        ->join('areas', 'areas.id', '=', 'accommodation_applications.area_id')
        ->join('accommodation_application_types', 'accommodation_application_types.id', '=', 'accommodation_applications.application_type_id')
        ->select('accommodation_applications.id as id','accommodation_applications.status as status', 'accommodation_application_types.name as applicationsubject','accommodation_application_types.name_bn as applicationsubject_bn', 'accommodation_applications.date as applicationdate', 'accommodation_applications.date_bn as applicationdate_bn','users.id as mpid', 'users.name as mpname', 'users.name_bn as mpname_bn', 'areas.name as areaname','areas.name_bn as areaname_bn')
        ->where('accommodation_applications.status',9)->get();    


    }

    if($type=='#pending'|| $start==1){
     

         $data = DB::table('accommodation_applications')
        ->join ('users', 'users.id', '=', 'accommodation_applications.application_from')
        ->join('areas', 'areas.id', '=', 'accommodation_applications.area_id')
        ->join('accommodation_application_types', 'accommodation_application_types.id', '=', 'accommodation_applications.application_type_id')
        ->select('accommodation_applications.id as id','accommodation_applications.status as status', 'accommodation_application_types.name as applicationsubject','accommodation_application_types.name_bn as applicationsubject_bn', 'accommodation_applications.date as applicationdate', 'accommodation_applications.date_bn as applicationdate_bn','users.id as mpid', 'users.name as mpname', 'users.name_bn as mpname_bn', 'areas.name as areaname','areas.name_bn as areaname_bn')
        ->where('accommodation_applications.status',1)->get();  
        
        
      

}

    if($type=='#rejected'){
        $data = DB::table('accommodation_department_applications')
        ->join ('accommodation_applications', 'accommodation_applications.id', '=', 'accommodation_department_applications.application_id')
        ->join('accommodation_application_types', 'accommodation_application_types.id', '=', 'accommodation_applications.application_type_id')        
        ->join ('users', 'users.id', '=', 'accommodation_applications.application_from')
        ->join('areas', 'areas.id', '=', 'accommodation_applications.area_id')
        ->select('accommodation_applications.id as id','accommodation_department_applications.status as status', 'accommodation_application_types.name as applicationsubject','accommodation_application_types.name_bn as applicationsubject_bn', 'accommodation_applications.date as applicationdate','users.name as mpname', 'users.name_bn as mpname_bn', 'areas.name as areaname','areas.name_bn as areaname_bn')
        ->where('accommodation_department_applications.status',2)
        ->get();  
     

}



       return response()->json(array(
         'data' => $data,

        ));
    }



    public function accommodationApplicationListForWhip(Request $request)
    {
    $type = $request['type'];
    $start = $request['start'];
    $approve = $request['approve'];


   

    if($type=='#approved' || $approve=='success'){


        
        $dataList1 = DB::table('accommodation_department_applications')
        ->join ('users', 'users.id', '=', 'accommodation_applications.application_from')
        ->join('profiles', 'profiles.user_id', '=', 'accommodation_applications.application_from')
        ->select('accommodation_applications.id as id','users.id as mpid','profiles.constituency_id as constituencyid','accommodation_applications.status as status', 'accommodation_applications.subject as applicationsubject', 'users.name as mpname','accommodation_department_applications.allocated_date as allocateddate')
        ->where('accommodation_applications.status',5)
        ->get(); 
        
        

        foreach ($dataList1 as $value){
       
            $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
             
             $dataList1 = $dataList1->map(function($item) use ($data) {
            
             $item->constituencyname = $data ;
             return $item;
           });   
             
         }



         $dataList2 = DB::table('flats')
         ->join('areas', 'areas.id', '=', 'flats.area_id')
         ->join('floors', 'floors.id', '=', 'flats.floor_id')
         ->join('flat_types', 'flat_types.id', '=', 'flats.flat_type_id')
         ->select('areas.name as areaname', 'floors.name as floorname', 'flat_types.size as flatsize', 'flats.number as flatnumber', 'flats.allocated_date as allocateddate')
         ->where('flats.apply_status',2)
         ->get(); 




    }

    if($type=='#pending' || $start==1){



        $dataList1 = DB::table('accommodation_department_applications')
        ->join ('accommodation_applications', 'accommodation_applications.id', '=', 'accommodation_department_applications.application_id')
        ->join('users', 'users.id', '=', 'accommodation_applications.application_from')
        ->join('profiles', 'profiles.user_id', '=', 'users.id')
        ->select('accommodation_department_applications.id as id','users.id as mpid','profiles.constituency_id as constituencyid','accommodation_department_applications.status_id as status', 'accommodation_applications.subject as applicationsubject', 'users.name as mpname','accommodation_department_applications.allocated_date as allocateddate')
        ->where('accommodation_department_applications.status_id',9)
        ->get(); 
        
        

        foreach ($dataList1 as $value){
       
            $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
             
             $dataList1 = $dataList1->map(function($item) use ($data) {
            
             $item->constituencyname = $data ;
             return $item;
           });   
             
         }



          $dataList2 = DB::table('flats')
         ->join('accommodation_department_applications', 'accommodation_department_applications.flat_id', '=', 'flats.id')
         ->join('areas', 'areas.id', '=', 'flats.area_id')
         ->join('floors', 'floors.id', '=', 'flats.floor_id')
         ->join('flat_types', 'flat_types.id', '=', 'flats.flat_type_id')
         ->select('areas.name as areaname', 'flats.id as flatid','floors.name as floorname', 'flat_types.size as flatsize', 'flats.number as flatnumber')
         ->get(); 
 

       


}

    if($type=='#rejected'){
      

        $dataList1 = DB::table('accommodation_applications')
        ->join ('users', 'users.id', '=', 'accommodation_applications.application_from')
        ->join('profiles', 'profiles.user_id', '=', 'accommodation_applications.application_from')
        ->select('accommodation_applications.id as id','users.id as mpid','profiles.constituency_id as constituencyid','accommodation_applications.status as status', 'accommodation_applications.subject as applicationsubject', 'users.name as mpname')
        ->where('accommodation_applications.status',2)
        ->get(); 
        
        

        foreach ($dataList1 as $value){
       
            $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
             
             $dataList1 = $dataList1->map(function($item) use ($data) {
            
             $item->constituencyname = $data ;
             return $item;
           });   
             
         }



         $dataList2 = DB::table('flats')
         ->join('areas', 'areas.id', '=', 'flats.area_id')
         ->join('floors', 'floors.id', '=', 'flats.floor_id')
         ->join('flat_types', 'flat_types.id', '=', 'flats.flat_type_id')
         ->select('areas.name as areaname', 'floors.name as floorname', 'flat_types.size as flatsize', 'flats.number as flatnumber', 'flats.allocated_date as allocateddate')
         ->where('flats.apply_status',1)
         ->get(); 





}


                return response()->json(array(
                     'data' => $dataList1,
                     'data2' => $dataList2                  

   ));


    }





    public function hostelApplicationList(Request $request)
    {
    $type = $request['type'];
    $start = $request['start'];
    $approve = $request['approve'];


   

    if($type=='#approved' || $approve =='success'){


        
        $dataList1 = DB::table('hostel_applications')
        ->join ('users', 'users.id', '=', 'hostel_applications.application_from')
        ->join('profiles', 'profiles.user_id', '=', 'hostel_applications.application_from')
        ->join('hostel_buildings', 'hostel_buildings.id', '=', 'hostel_applications.hostel_building_id')
        ->select('hostel_applications.id as id','users.id as mpid','hostel_buildings.name as hostelbuildingname','hostel_applications.date as date','profiles.constituency_id as constituencyid','hostel_applications.status as status', 'hostel_applications.subject as applicationsubject', 'users.name as mpname')
        ->where('hostel_applications.status',5)
        ->orwhere('hostel_applications.status',6)


        ->get();
        
        

        foreach ($dataList1 as $value){
       
            $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
             
             $dataList1 = $dataList1->map(function($item) use ($data) {
            
             $item->constituencyname = $data ;
             return $item;
           });   
             
         }



   




    }

    if($type=='#pending' || $start==1){



        $dataList1 = DB::table('hostel_applications')
        ->join ('users', 'users.id', '=', 'hostel_applications.application_from')
        ->join('profiles', 'profiles.user_id', '=', 'hostel_applications.application_from')
        ->join('hostel_buildings', 'hostel_buildings.id', '=', 'hostel_applications.hostel_building_id')
        ->select('hostel_applications.id as id','users.id as mpid','hostel_buildings.name as hostelbuildingname','hostel_applications.date as date','profiles.constituency_id as constituencyid','hostel_applications.status as status', 'hostel_applications.subject as applicationsubject', 'users.name as mpname')
        ->where('hostel_applications.status',1)
        ->get(); 
        
        

        foreach ($dataList1 as $value){
       
            $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
             
             $dataList1 = $dataList1->map(function($item) use ($data) {
            
             $item->constituencyname = $data ;
             return $item;
           });   
             
         }



       


       


}

    if($type=='#rejected'){
      

        $dataList1 = DB::table('hostel_applications')
        ->join ('users', 'users.id', '=', 'hostel_applications.application_from')
        ->join('profiles', 'profiles.user_id', '=', 'hostel_applications.application_from')
        ->join('hostel_buildings', 'hostel_buildings.id', '=', 'hostel_applications.hostel_building_id')
        ->select('hostel_applications.id as id','users.id as mpid','hostel_buildings.name as hostelbuildingname','hostel_applications.date as date','profiles.constituency_id as constituencyid','hostel_applications.status as status', 'hostel_applications.subject as applicationsubject', 'users.name as mpname')
        ->where('hostel_applications.status',2)
        ->get(); 
        
        

        foreach ($dataList1 as $value){
       
            $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
             
             $dataList1 = $dataList1->map(function($item) use ($data) {
            
             $item->constituencyname = $data ;
             return $item;
           });   
             
         }




}


                return response()->json(array(
                     'data' => $dataList1
                   

   ));


    }





    public function hostelOfficeRoomListByHostelBuildingId(Request $request)
    {

         
   
    $hostel_building_id = $request['hostel_building_id'];


    $allocatedOfficeRoomList = DB::table('office_rooms')
    ->join('office_room_types', 'office_room_types.id', '=', 'office_rooms.office_room_type_id')
    ->join('hostel_floors', 'hostel_floors.id', '=', 'office_rooms.hostel_floor_id')
    ->where('office_rooms.building_id',$hostel_building_id)->where('status_id', 16)
    ->select('office_rooms.id as id','hostel_floors.name as floorname', 'office_rooms.number as number','office_room_types.name as officeroomtypename',  'office_rooms.status_id as status_id')->get();  
    


    $assignedOfficeRoomList = DB::table('office_rooms')
    ->join('office_room_types', 'office_room_types.id', '=', 'office_rooms.office_room_type_id')
    ->join('hostel_floors', 'hostel_floors.id', '=', 'office_rooms.hostel_floor_id')
    ->where('office_rooms.building_id',$hostel_building_id)->where('status_id', 14)
    ->select('office_rooms.id as id','hostel_floors.name as floorname', 'office_rooms.number as number','office_rooms.allocated_date as allocateddate','office_room_types.name as officeroomtypename',  'office_rooms.status_id as status_id')->get();  
    

    
    
 
    foreach ($allocatedOfficeRoomList as $value){
       
       $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
        
        $allocatedOfficeRoomList = $allocatedOfficeRoomList->map(function($item) use ($data) {
       
        $item->constituencyname = $data ;
        return $item;
      });   
        
    }
 



    
     
    $notAllocatedOfficeRoomList = DB::table('office_rooms')   
    ->join('office_room_types', 'office_room_types.id', '=', 'office_rooms.office_room_type_id')
    ->join('hostel_floors', 'hostel_floors.id', '=', 'office_rooms.hostel_floor_id')
    ->where('office_rooms.building_id',$hostel_building_id)->where('status_id', 15)
    ->select('office_rooms.id as id', 'office_rooms.number as number','office_room_types.name as officeroomtypename','hostel_floors.name as floorname',  'office_rooms.status_id as status_id')->get();  
 
    

          $totalofficeroom=DB::table('office_rooms')->where('building_id',$hostel_building_id )->count();

          $allocatedofficeroom=DB::table('office_rooms')->where('building_id',$hostel_building_id )->where('status_id',16 )->count();

          $availableofficeroom=DB::table('office_rooms')->where('building_id',$hostel_building_id )->where('status_id',15 )->count();

          

      
            $officeroomdata = array(array("totalofficeroom"=>$totalofficeroom, "allocatedofficeroom"=>$allocatedofficeroom, "availableofficeroom"=>$availableofficeroom));
            


    $merged = $notAllocatedOfficeRoomList->merge($allocatedOfficeRoomList)->merge($assignedOfficeRoomList);

    $officeRoomList = $merged->all();  
    
       return response()->json(array(
         'data' => $officeRoomList,
         'officeroomdata'=>$officeroomdata

        ));
    }







    public function confirmApplicationByHostelDepartment(Request $request)
    {

         //hostel department
   
    $officeroomid = $request['id'];
    $appid=$request['appid'];
    $allocateddate=$request['allocateddate'];
    $date = date_format(date_create($allocateddate), 'Y-m-d');



    try {
 
        
        DB::table('hostel_department_applications')
        ->insert([
          'application_id' => $appid,
          'office_room_id' => $officeroomid,
          'allocated_date'=>$date,
          'status_id'=> 9,
          'created_by'=> authInfo()->id            
        ]);

DB::table('hostel_applications')
        ->where('id', $appid)
        ->update(['status' => 9 
       
        
          ]);     
          
DB::table('office_rooms')
          ->where('id', $officeroomid)
          ->update(['status_id' => 14
         
          
            ]); 


    
     return response()->json(["status"=>"success"]);
    }catch (\Exception $e) {

        $errorMessage=$e->getMessage();
        $customMessage="Exception! Something went wrong please try again!";

        \Session::flash('error', $errorMessage, true);
        return response()->json(["status"=>$errorMessage]);
    } 



}






    public function hostelApplicationListForWhip(Request $request)
    {
    $type = $request['type'];
    $start = $request['start'];
    $approve = $request['approve'];

   

    if($type=='#approved'|| $approve=='success'){


   
        $dataList1 = DB::table('hostel_department_applications')
        ->join ('users', 'users.id', '=', 'hostel_applications.application_from')
        ->join('profiles', 'profiles.user_id', '=', 'hostel_applications.application_from')
        ->select('hostel_applications.id as id','users.id as mpid','hostel_applications.date as date','profiles.constituency_id as constituencyid','hostel_applications.status as status', 'hostel_applications.subject as applicationsubject', 'users.name as mpname')
        ->where('hostel_applications.status',5)
        ->get(); 
        
        

        foreach ($dataList1 as $value){
       
            $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
             
             $dataList1 = $dataList1->map(function($item) use ($data) {
            
             $item->constituencyname = $data ;
             return $item;
           });   
             
         }



         $dataList2 = DB::table('office_rooms')
         ->join('hostel_buildings', 'hostel_buildings.id', '=', 'office_rooms.building_id')
         ->join('hostel_floors', 'hostel_floors.id', '=', 'office_rooms.hostel_floor_id')
         ->join('office_room_types', 'office_room_types.id', '=', 'office_rooms.office_room_type_id')
         ->select('hostel_buildings.name as hostelbuildingname', 'hostel_floors.name as hostelfloorname','office_rooms.number as officeroomnumber', 'office_room_types.name as officeroomtype')
         ->where('office_rooms.apply_status',2)
         ->get(); 



       




    }

    if($type=='#pending' || $start==1){



        $dataList1 = DB::table('hostel_department_applications')
        ->join ('hostel_applications', 'hostel_applications.id', '=', 'hostel_department_applications.application_id')
        ->join('users', 'users.id', '=', 'hostel_applications.application_from')
        ->join('profiles', 'profiles.user_id', '=', 'users.id')
        ->select('hostel_department_applications.id as id','users.id as mpid','profiles.constituency_id as constituencyid','hostel_department_applications.status_id as status', 'hostel_applications.subject as applicationsubject', 'users.name as mpname','hostel_department_applications.allocated_date as date')
        ->where('hostel_department_applications.status_id',9)
        ->get(); 
        
        

        foreach ($dataList1 as $value){
       
            $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
             
             $dataList1 = $dataList1->map(function($item) use ($data) {
            
             $item->constituencyname = $data ;
             return $item;
           });   
             
         }



         $dataList2 = DB::table('office_rooms')
         ->join('hostel_department_applications', 'hostel_department_applications.office_room_id', '=', 'office_rooms.id')
         ->join('hostel_buildings', 'hostel_buildings.id', '=', 'office_rooms.building_id')
         ->join('hostel_floors', 'hostel_floors.id', '=', 'office_rooms.hostel_floor_id')
         ->join('office_room_types', 'office_room_types.id', '=', 'office_rooms.office_room_type_id')
         ->select('hostel_buildings.name as hostelbuildingname','office_rooms.id as officeroomid', 'hostel_floors.name as hostelfloorname','office_rooms.number as officeroomnumber', 'office_room_types.name as officeroomtype')
         ->where('office_rooms.status_id',14)
         ->get();  



       


}

    if($type=='#rejected'){
      

      
        $dataList1 = DB::table('hostel_applications')
        ->join ('users', 'users.id', '=', 'hostel_applications.application_from')
        ->join('profiles', 'profiles.user_id', '=', 'hostel_applications.application_from')
        ->select('hostel_applications.id as id','users.id as mpid','hostel_applications.date as date','profiles.constituency_id as constituencyid','hostel_applications.status as status', 'hostel_applications.subject as applicationsubject', 'users.name as mpname')
        ->where('hostel_applications.status',2)
        ->get(); 
        
        

        foreach ($dataList1 as $value){
       
            $data=DB::table('constituencies')->where('id',$value->constituencyid )->value('name');
             
             $dataList1 = $dataList1->map(function($item) use ($data) {
            
             $item->constituencyname = $data ;
             return $item;
           });   
             
         }



         $dataList2 = DB::table('office_rooms')
         ->join('hostel_buildings', 'hostel_buildings.id', '=', 'office_rooms.building_id')
         ->join('hostel_floors', 'hostel_floors.id', '=', 'office_rooms.hostel_floor_id')
         ->join('office_room_types', 'office_room_types.id', '=', 'office_rooms.office_room_type_id')
         ->select('hostel_buildings.name as hostelbuildingname', 'hostel_floors.name as hostelfloorname','office_rooms.number as officeroomnumber', 'office_room_types.name as officeroomtype')
         ->where('office_rooms.apply_status',1)
         ->get(); 







}


                return response()->json(array(
                     'data' => $dataList1,
                     'data2' => $dataList2

                   

   ));


    }







    public function confirmUpdatedHostelApplicationByWhip(Request $request)
    {

         
   
    $officeroomid = $request['id'];
    $mpid=$request['mpid'];
    $appid=$request['appid'];
    $allocateddate=$request['allocateddate'];
    $date = date_format(date_create($allocateddate), 'Y-m-d');


    try{
    DB::table('office_rooms')
              ->where('id', $officeroomid)
              ->update(['user_id' => $mpid,
              'allocated_date'=>$date,
              'apply_status'=> 2,
              'is_available'=> 0
              

              
              
              
              ]);
     DB::table('hostel_applications')
              ->where('id', $appid)
              ->update(['status' => 5
             
              
                ]);      


    
     return response()->json(["status"=>"success"]);
    }catch (\Exception $e) {

        $errorMessage=$e->getMessage();
        $customMessage="Exception! Something went wrong please try again!";

        \Session::flash('error', $errorMessage, true);
        return response()->json(["status"=>"error"]);
    } 

    }












}



    
 