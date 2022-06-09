<?php

namespace App\Http\Controllers\Backend\MasterSetup;

use App\Http\Controllers\Controller;
use App\cr;
use App\Model\SongshodFloor;
use Illuminate\Http\Request;


class SongshodFloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = SongshodFloor::orderBy('id', 'desc')->get();
        return view('backend.master_setup.floor.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new SongshodFloor();
        $title = "Create";
        return view('backend.master_setup.floor.form', compact('data', 'title'));
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
            $floor = new SongshodFloor();
            $floor->fill($request->all());
            $result = $floor->save();

            if ($result) {
                // dd($result);
                return redirect()->route('admin.master_setup.songshodFloor.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.master_setup.songshodFloor.create')->with('error', 'Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return redirect()->back()->withInput(); //If you want to go back

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SongshodFloor::findOrFail($id);
        $title = "Edit";
        return view('backend.master_setup.floor.form', compact('data', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $floor = SongshodFloor::find($id);
            $data = $request->all();
            $data['status'] = $request->status ?? 0;
            $result = $floor->update($data);

            if ($result) {
                return redirect()->route('admin.master_setup.songshodFloor.index')->with('success', 'Data Updated successfully');
            } else {
                return redirect()->route('admin.master_setup.songshodFloor.edit', [$id])->with('error', 'Data does not update successfully')->withInput();
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
            $ministry = SongshodFloor::find($id);
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
