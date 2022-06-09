<?php

namespace App\Http\Controllers\Backend\Accommodation;

use App\Http\Controllers\Controller;
use App\Model\OfficeRoomType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

class OfficeRoomTypeController extends Controller
{
    //

    public function index()
    {
        $data = OfficeRoomType::orderBy('id', 'desc')->get();

        return view('backend.accommodation.office_room_type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('backend.accommodation.office_room_type.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $rules = [
            'name' => 'required',
           
        ];
        $message = [
            'name.required' => 'The name field is required.',
         
        ];


        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $building = new OfficeRoomType();

          
                $building->created_by=Auth::id();
                $building->fill($request->all());
                



            $result = $building->save();


            if ($result) {
                return redirect()->route('admin.accommodation.office_room_types.index')->with('success', 'Data Saved successfully');
            } else {
                return redirect()->route('admin.accommodation.office_room_types.create')->with('error', 'Data does not save successfully')->withInput();
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
        $data['editData'] = OfficeRoomType::findOrFail($id);
       
       
        return view('backend.accommodation.office_room_type.form', $data);
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
        // validation
        $rules = [
            'name' => 'required',
            
        ];
        $message = [
            'name.required' => 'The name field is required.',
           
        
            
        ];


        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {




            $building = OfficeRoomType::find($id);

        
            $data = $request->all();
            $data['status']= $request->status ?? 0;
            $result = $building->update($data);

            if ($result) {
                return redirect()->route('admin.accommodation.office_room_types.index')->with('success', 'Data Updated successfully');
            } else {
                return redirect()->route('admin.accommodation.office_room_types.edit', [$id])->with('error', 'Data does not update successfully')->withInput();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = OfficeRoomType::find($id);
            $data->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            $customMessage = "Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status" => "error"]);
        }
    }




}
