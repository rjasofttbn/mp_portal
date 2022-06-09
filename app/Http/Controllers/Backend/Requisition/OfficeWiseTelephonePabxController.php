<?php

namespace App\Http\Controllers\Backend\Requisition;

use App\Model\OfficeWiseTelephonePabx;
use App\Model\SongshodBlock;
use App\Model\SongshodRoom;
use App\Model\SongshodFloor;
use App\Model\HostelFloor;

use App\Http\Controllers\Controller;
use App\cr;
use Illuminate\Http\Request;


class OfficeWiseTelephonePabxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = OfficeWiseTelephonePabx::leftJoin('songshod_rooms', 'office_wise_telephone_pabxes.room_id', '=', 'songshod_rooms.id')->select('office_wise_telephone_pabxes.*', 'room', 'room_bn')->orderBy('id', 'desc')->get();
        return view(
            'backend.requisition.office_wise.index',
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
        $data = new OfficeWiseTelephonePabx();
        $title = "Create";
        $hostelFloor = HostelFloor::orderBy('id', 'desc')->get();
        $songshodBlock = SongshodBlock::orderBy('id', 'desc')->get();
        $songshodFloor = SongshodFloor::orderBy('id', 'desc')->get();
        $songshodRoom = SongshodRoom::orderBy('id', 'desc')->get();
        return view('backend.requisition.office_wise.form', compact('data', 'title', 'hostelFloor', 'songshodBlock', 'songshodFloor', 'songshodRoom'));
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
            $rights = new OfficeWiseTelephonePabx();
            if($request->hblock_id){
                $request->request->add(['block_id' => $request->hblock_id,'floor_id'=>0,'room_id'=>0]);
            }
            $rights->fill($request->all());
            $result = $rights->save();

            if ($result) {
                // dd($result);
                return redirect()->route('admin.requisition.office_wise_telephone_pabx.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.requisition.office_wise_telephone_pabx.create')->with('error', 'Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            dd($errorMessage);
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }

    public function getRoom(Request $request)
    {
        $rooms = SongshodRoom::where('block_id', $request->block_id)->where('floor_id', $request->floor_id)->orderBy('id', 'desc')->get();
        $option = "";
        if (count($rooms) > 0) {
            foreach ($rooms as $room) {
                $option .= "<option value='$room->id'>$room->room</option>";
            }
        }else{
            return 0;
        }   
        return $option;
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
    public function edit($id)
    {
        $data = OfficeWiseTelephonePabx::findOrFail($id);
        $title = "Edit";
        $hostelFloor = HostelFloor::orderBy('id', 'desc')->get();
        $songshodBlock = SongshodBlock::orderBy('id', 'desc')->get();
        $songshodFloor = SongshodFloor::orderBy('id', 'desc')->get();
        $songshodRoom = SongshodRoom::orderBy('id', 'desc')->get();
        return view('backend.requisition.office_wise.form', compact('data', 'title', 'hostelFloor', 'songshodBlock', 'songshodFloor', 'songshodRoom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        try {
            $ministry = OfficeWiseTelephonePabx::find($id);
            if($request->hblock_id){
                $request->request->add(['block_id' => $request->hblock_id,'floor_id'=>0,'room_id'=>0]);
            }
            $data = $request->all();
            // $data['status'] = $request->status ?? 0;
            $result = $ministry->update($data);

            if ($result) {                
                return redirect()->route('admin.requisition.office_wise_telephone_pabx.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.requisition.office_wise_telephone_pabx.edit', [$id])->with('error', 'Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            dd($errorMessage);
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ministry = OfficeWiseTelephonePabx::find($id);
            $ministry->delete();
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {
    
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";
    
            \Session::flash('error', $customMessage, true);
            return response()->json(['status' => 'error']);
        
        }
    }
}
