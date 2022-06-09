<?php
/**
 * Author M. Atoar Rahman
 * Date: 01/02/2021
 * Time: 09:25 AM
 */
namespace App\Http\Controllers\Backend\MasterSetup;

use App\Model\Parliament;
use App\Model\User;
use App\Model\ParliamentSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParliamentSessionRequest;
use App\Model\ParliamentSessionAttachment;
use Auth;

class ParliamentSessionController extends Controller
{
    public function __construct()
    {
        $lDate = date('Y-m-d');
        ParliamentSession::where('date_to', '<', $lDate)->update(['status' => 0]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ParliamentSession::orderBy('id', 'desc')->get();
        $attachments = ParliamentSessionAttachment::all();

        return view('backend.master_setup.parliamentSession.index', compact('data', 'attachments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new ParliamentSession();
        $parliamentList = Parliament::orderBy('id', 'asc')->get();
        $session_list = [];
        for($i=1; $i<=20; $i++){
            $session_list[] = array(
                'id'=>$i,
                'name'=>$this->ordinal($i)
            );
        }
        return view('backend.master_setup.parliamentSession.form', compact('data', 'parliamentList','session_list'));
    }

    private function ordinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }
    //Example Usage
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParliamentSessionRequest $request)
    {
        try {
            $parliamentSession = new ParliamentSession();
            $request['created_by']= authInfo()->id;
            $parliamentSession->fill($request->all());
            $result = $parliamentSession->save();
            $parliament_session_id = $parliamentSession->id;
            
            if ($request->hasfile('attachment')) {

                if ($files = $request->file('attachment')) {
                    foreach ($files as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'parliament_session' . '_' . time() . random_int(0, 1000) . '.' . $extension; // Make a file name
                        $folder = public_path('/backend/attachment/'); // Define folder path
                        $file->move($folder, $filename); // Upload image

                        // Insert Data to Attachment Table
                        $sessionAttachment = new ParliamentSessionAttachment();
                        $sessionAttachment->parliament_session_id = $parliament_session_id;
                        $sessionAttachment->attachment = $filename; // Set file path in database to filePath
                        $sessionAttachment->save();
                    }
                }
            }
            
            if($result){
                return redirect()->route('admin.master_setup.parliament_sessions.index')->with('success','Data Saved successfully');
            }else{
                return redirect()->route('admin.master_setup.parliament_sessions.create')->with('error','Data does not save successfully')->withInput();
            }
        } catch (\Exception $e) {
            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

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
        $data = ParliamentSession::findOrFail($id);
        $parliamentList = Parliament::orderBy('id', 'asc')->get();
        $attachments = ParliamentSessionAttachment::where('parliament_session_id', $id)->get();
        $session_list = [];
        for($i=1; $i<=20; $i++){
            $session_list[] = array(
                'id'=>$i,
                'name'=>$this->ordinal($i)
            );
        }

        return view('backend.master_setup.parliamentSession.form', compact('data', 'parliamentList', 'session_list', 'attachments'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParliamentSessionRequest $request, $id) {

        try {
            $parliamentSessionEloquent = ParliamentSession::find($id);
            $data = $request->all();
            $data['status']= $request->status ?? 0;

            if ($request->hasfile('attachment')) {

                // Delete Data to Notice Attachment Table
                $sessionAllAttachment = ParliamentSessionAttachment::where('parliament_session_id', $id)->get();
                foreach ($sessionAllAttachment as $attachmentFile) {
                    $folder = public_path('/backend/attachment/');
                    @unlink($folder . $attachmentFile->attachment);
                }
                ParliamentSessionAttachment::where('parliament_session_id', $id)->delete();

                if ($files = $request->file('attachment')) {
                    foreach ($files as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'parliament_session' . '_' . time() . random_int(0, 1000) . '.' . $extension; // Make a file name
                        $folder = public_path('/backend/attachment/'); // Define folder path
                        $file->move($folder, $filename); // Upload image

                        // Insert Data to Notice Attachment Table
                        $sessionAttachment = new ParliamentSessionAttachment();
                        $sessionAttachment->parliament_session_id = $id;
                        $sessionAttachment->attachment = $filename; // Set file path in database to filePath
                        $sessionAttachment->save();
                    }
                }
            }

            $result = $parliamentSessionEloquent->update($data);

            if($result){
                return redirect()->route('admin.master_setup.parliament_sessions.index')->with('success','Data Updated successfully');
            }else{
                return redirect()->route('admin.master_setup.parliament_sessions.edit', [$id])->with('error','Data does not update successfully')->withInput();
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
            $parliamentSessionEloquent = ParliamentSession::find($id);
            $parliamentSessionEloquent->delete();
            // Delete Data from Attachment Table
            $sessionAllAttachment = ParliamentSessionAttachment::where('parliament_session_id', $id)->get();
            foreach ($sessionAllAttachment as $attachmentFile) {
                $folder = public_path('/backend/attachment/');
                @unlink($folder . $attachmentFile->attachment);
            }
            ParliamentSessionAttachment::where('parliament_session_id', $id)->delete();
            return response()->json(["status"=>"success"]);

        } catch (\Exception $e) {

            $errorMessage=$e->getMessage();
            $customMessage="Exception! Something went wrong please try again!";

            \Session::flash('error', $customMessage, true);
            return response()->json(["status"=>"error"]);
        }
    }
}
