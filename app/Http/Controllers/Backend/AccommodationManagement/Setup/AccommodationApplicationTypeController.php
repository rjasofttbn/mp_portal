<?php

/*
Author: Naziur Rahman
Date: 6/05/2021

 */


namespace App\Http\Controllers\Backend\AccommodationManagement\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AccommodationApplicationType;



class AccommodationApplicationTypeController extends Controller
{
    
    public function index()
    {
        $data = AccommodationApplicationType::orderby('id','asc')->get();
       
        
        return view('backend.accommodation.application_types.index', compact('data'));
    }

   
}