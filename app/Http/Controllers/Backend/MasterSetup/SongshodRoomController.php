<?php

namespace App\Http\Controllers\Backend\MasterSetup;

use App\Http\Controllers\Controller;
use App\cr;
use App\Model\SongshodRoom;
use App\Model\SongshodBlock;
use App\Model\SongshodFloor;
use Illuminate\Http\Request;


class SongshodRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = SongshodRoom::leftJoin('songshod_floors','songshod_floors.id','=','songshod_rooms.floor_id')->leftJoin('songshod_blocks','songshod_blocks.id','=','songshod_rooms.block_id')->select('songshod_rooms.*','songshod_blocks.name','songshod_blocks.name_bn','songshod_floors.name as floor_name', 'songshod_floors.name_bn as floor_name_bn')->orderBy('id', 'desc')->get();
        return view('backend.master_setup.room.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new SongshodRoom();
        $floor = SongshodFloor::where('status',1)->orderBy('id','desc')->get();
        $block = SongshodBlock::where('status',1)->orderBy('id','desc')->get();
        $title = "Create";
        return view('backend.master_setup.room.form', compact('data', 'title','floor','block'));
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
            $block = new SongshodRoom();
            $block->fill($request->all());
            $result = $block->save();

            if ($result) {
                // dd($result);
                return redirect()->route('admin.master_setup.songshodRoom.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.master_setup.songshodRoom.create')->with('error', 'Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SongshodRoom::findOrFail($id);
        $floor = SongshodFloor::where('status',1)->orderBy('id','desc')->get();
        $block = SongshodBlock::where('status',1)->orderBy('id','desc')->get();
        $title = "Edit";
        return view('backend.master_setup.room.form', compact('data', 'title','floor','block'));
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
            $ministry = SongshodRoom::find($id);
            $data = $request->all();
            $data['status'] = $request->status ?? 0;
            $result = $ministry->update($data);

            if ($result) {
                return redirect()->route('admin.master_setup.songshodRoom.index')->with('success', 'Data Updated successfully');
            } else {
                return redirect()->route('admin.master_setup.songshodRoom.edit', [$id])->with('error', 'Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
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
            $ministry = SongshodRoom::find($id);
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
