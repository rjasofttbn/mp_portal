<?php

namespace App\Http\Controllers\Backend\ProfileActivities;

use App\Model\Designation;
use App\Traits\ProfileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Model\Profile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    use ProfileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = $this->all();
        //dd($data['allData']->toArray());
        return view('backend.profileActivities.profiles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['designations'] = Designation::all();
        return view('backend.profileActivities.profiles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mpProfile = $this->creationProfile($request);

        if ($mpProfile['status'] == true) {
            return redirect()->back()->with('success', 'Successfully created');
        } else {
            //dd($mpProfile['message']);
            //return redirect()->back()->withInput();
            return redirect()->back()->withInput();
            //return redirect()->back()->with('error', $mpProfile['message']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['editData'] = $this->getProfile($id);
        // dd($data['editData']->toARray());
        return view('backend.profileActivities.profiles.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mpProfile = $this->creationProfile($request, $id);

        if ($mpProfile['status'] == true) {
            return redirect()->back()->with('success', 'Successfully updated');
        } else {
            dd($mpProfile['message']);
            return redirect()->back()->with('error', $mpProfile['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
