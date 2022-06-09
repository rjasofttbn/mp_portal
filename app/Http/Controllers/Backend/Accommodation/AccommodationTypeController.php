<?php

/* 
Author: Naziur Rahman 
Date: 8/03/2021
 */

namespace App\Http\Controllers\backend\Accommodation;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AccommodationTypeRequest;
use App\Model\AccommodationType;
use Auth;

class AccommodationTypeController extends Controller
{
   
    public function index()
    {      
        $data = AccommodationType::orderBy('id', 'desc')->get();
        return view('backend.accommodation.accommodation_type.index', compact('data'));
    }

    
 
}
