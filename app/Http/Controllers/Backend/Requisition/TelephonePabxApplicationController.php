<?php

namespace App\Http\Controllers\Backend\Requisition;

use App\Model\TelephonePabxApplication;
use App\Model\SongshodBlock;
use App\Model\SongshodRoom;
use App\Model\SongshodFloor;
use App\Model\HostelFloor;
use App\Http\Controllers\Controller;
use App\cr;
use Illuminate\Http\Request;

class TelephonePabxApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TelephonePabxApplication::orderBy('id', 'desc')->get();
        return view(
            'backend.requisition.application.index',
            compact('data')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new TelephonePabxApplication();
        $title = "Create";
        $hostelFloor = HostelFloor::orderBy('id', 'desc')->get();
        $songshodBlock = SongshodBlock::orderBy('id', 'desc')->get();
        $songshodFloor = SongshodFloor::orderBy('id', 'desc')->get();
        $songshodRoom = SongshodRoom::orderBy('id', 'desc')->get();
        // $designation = Designation::orderBy('id', 'desc')->get();
        return view('backend.requisition.application.form', compact('data', 'title', 'hostelFloor', 'songshodBlock', 'songshodFloor', 'songshodRoom'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rights = new TelephonePabxApplication();
            if($request->hblock_id){
                $request->request->add(['block_id' => $request->hblock_id]);
            }
            $rights->fill($request->all());
            $result = $rights->save();

            if ($result) {
                // dd($result);
                return redirect()->route('admin.requisition.telephone_pabx_application.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.requisition.telephone_pabx_application.create')->with('error', 'Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $errorMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
