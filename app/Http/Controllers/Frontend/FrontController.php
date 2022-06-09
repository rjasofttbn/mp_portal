<?php

namespace App\Http\Controllers\Frontend;

use App;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function __construct()
    {
       
        // $this->banner = $banner;
        // $this->home_news = $home_news;
        // $this->home_notice = $home_notice;
        // $this->contact = $contact;
    }
    public function index()
    {
    	
    	return view('backend.auth.login');
    }
    

}
