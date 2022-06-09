<?php

/*
Author: Naziur Rahman
Date: 22/03/2021

 */

namespace App\Http\Controllers\Backend\Accommodation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccommodationBuilding;
use App\Model\Floor;
use App\Model\Flat;



class AccommodationAjaxController extends Controller
{

    public function accommodationBuildingDatatByAreaId(Request $request)
    {
        $area_id = $request['area_id'];
        $buildingList = AccommodationBuilding::where('Area_id', $area_id)->orderBy('id', 'asc')->get();
        return response()->json(array(
            'data' => $buildingList,
        ));
    }

    public function floorDataByAccommodationBuildingId(Request $request)
    {
        $building_id = $request['building_id'];
        $totalFloor = AccommodationBuilding::where('id', $building_id)->value('total_floor');
        $floorList = Floor::select('id', 'name')->orderBy('id', 'asc')->where('id', '<=', $totalFloor)->get();
        return response()->json(array(
            'data' => $floorList,
        ));
    }

    public function flatDataByAccommodationBuildingId(Request $request)
    {

       

        $building_id = $request['building_id'];
        $flatList = Flat::where('building_id', $building_id)->orderBy('number', 'asc')->get();
        return response()->json(array(
            'data' => $flatList,
        ));
    }


}
