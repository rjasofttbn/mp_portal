<?php
/**
 * Author M. Atoar Rahman
 * Date: 01/02/2021
 * Time: 04:25 AM
 */
namespace App\Http\Controllers\Backend\MasterSetup;

use App\Model\User;
use App\Http\Requests\PoliticalPartiesRequest;
use App\Model\PoliticalParty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PoliticalPartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PoliticalParty::orderBy('id', 'desc')->get();

        return view('backend.master_setup.politicalParties.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new PoliticalParty();

        return view('backend.master_setup.politicalParties.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PoliticalPartiesRequest $request)
    {
        try {
            $parties = new PoliticalParty();
            $parties->fill($request->all());
            $result = $parties->save();

            if($result){
                return redirect()->route('admin.master_setup.political_parties.index')->with('success','Data Saved successfully');
            }else{
                return redirect()->route('admin.master_setup.political_parties.create')->with('error','Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
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
        $data = PoliticalParty::findOrFail($id);
        return view('backend.master_setup.politicalParties.form', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PoliticalPartiesRequest $request, $id) {

        try {
            $partiesEloquent = PoliticalParty::find($id);
            $data = $request->all();
            $data['status']= $request->status ?? 0;
            $result = $partiesEloquent->update($data);

            if($result){
                return redirect()->route('admin.master_setup.political_parties.index')->with('success','Data Updated successfully');
            }else{
                return redirect()->route('admin.master_setup.political_parties.edit', [$id])->with('error','Data does not update successfully')->withInput();
            }
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

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
            $partiesEloquent = PoliticalParty::find($id);
            $partiesEloquent->delete();
            return response()->json(["status"=>"success"]);
        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }
}
