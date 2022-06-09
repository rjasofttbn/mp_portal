<?php

namespace App\Http\Controllers\Backend\ProfileActivities;

use App\Http\Controllers\Controller;
use App\Model\Profile;
use Illuminate\Http\Request;

class MpBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.profileActivities.mpBook.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        // $data = Profile::where('designation_id', $designation_id)
        // ->orWhere('constituency_id', $constituency_id)
        // ->orWhere('name_eng', 'LIKE', '%' . $search_by . '%')
        // ->orWhereHas('constituency', function ($q) use ($division_id) {
        //     $q->where('division_id', $division_id);
        // })
        // ->orWhereHas('constituency', function ($q) use ($district_id) {
        //     $q->where('district_id', $district_id);
        // })
        // ->get();

        $designation_id = $request->input('designation_id');
        $division_id = $request->input('division_id');
        $district_id = $request->input('district_id');
        $constituency_id = $request->input('constituency_id');
        $search_by = $request->input('search_by');
        $where = [];
        $whereHas = [];

       if($request->constituency_id){
            $where = ['constituency_id' => $constituency_id];
        }elseif($request->district_id){
            $where = ['designation_id' => $designation_id];
            $whereHas = ['district_id' => $district_id];
        }elseif ($request->division_id) {
            $where = ['designation_id' => $designation_id];
            $whereHas = ['division_id' => $division_id];
        }elseif($request->designation_id){
            $where = ['designation_id' => $designation_id];
        }else {
            $data = [];
        }
        // dd($where);
        if($where && $request->search_by){
            $data = Profile::where($where)
            ->whereHas('constituency', function ($q) use ($whereHas) {
                    $q->where($whereHas);
            })
            ->where('name_eng', 'LIKE', '%' . $search_by . '%')
            ->get();
        }elseif($where){
            $data = Profile::where($where)
            ->whereHas('constituency', function ($q) use ($whereHas) {
                    $q->where($whereHas);
            })
            ->get();
        }elseif($request->search_by){
            $data = Profile::where('name_eng', 'LIKE', '%' . $search_by . '%')
            ->get();
        }else{
            $data = [];
        }

        // dd($data->toArray());
        return view('backend.profileActivities.mpBook.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
