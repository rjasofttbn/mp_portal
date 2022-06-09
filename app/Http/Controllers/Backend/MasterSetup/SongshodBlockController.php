<?php

namespace App\Http\Controllers\Backend\MasterSetup;

use App\Http\Controllers\Controller;
use App\cr;
use App\Model\SongshodBlock;
use Illuminate\Http\Request;


class SongshodBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = SongshodBlock::orderBy('id', 'desc')->get();
        return view('backend.master_setup.block.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new SongshodBlock();
        $title = "Create";
        return view('backend.master_setup.block.form', compact('data', 'title'));
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
            $block = new SongshodBlock();
            $block->fill($request->all());
            $result = $block->save();

            if ($result) {
                // dd($result);
                return redirect()->route('admin.master_setup.songshodBlock.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.master_setup.songshodBlock.create')->with('error', 'Data does not save successfully')->withInput();
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
        $data = SongshodBlock::findOrFail($id);
        $title = "Edit";
        return view('backend.master_setup.block.form', compact('data', 'title'));
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
            $ministry = SongshodBlock::find($id);
            $data = $request->all();
            $data['status'] = $request->status ?? 0;
            $result = $ministry->update($data);

            if ($result) {
                return redirect()->route('admin.master_setup.songshodBlock.index')->with('success', 'Data Updated successfully');
            } else {
                return redirect()->route('admin.master_setup.songshodBlock.edit', [$id])->with('error', 'Data does not update successfully')->withInput();
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
            $ministry = SongshodBlock::find($id);
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
