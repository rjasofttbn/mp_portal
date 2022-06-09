<?php

namespace App\Http\Controllers\Backend\MasterSetup;

use App\User;
use App\Model\MpPs;
use App\Model\Profile;
use App\Traits\ProfileTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PersonalSecretaryController extends Controller
{
    use ProfileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = User::with(['psMpInfo'])->where('usertype', 'ps')->get();
        // dd($data['allData']->toArray());
        return view('backend.master_setup.personal_secretaries.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['mpUsers'] = User::where('usertype', 'mp')->get();
        // dd($data['mpUsers']);
        return view('backend.master_setup.personal_secretaries.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateData($request);

        // dd($request->all());
        DB::beginTransaction();
        try {
            $ps = new User;
            $ps->name = $request->name;
            $ps->email = $request->email;
            $ps->password = bcrypt($request->password);
            $ps->usertype = 'ps';
            $ps->save();
            if ($ps) {
                // $mp = Profile::where('user_id', $request->mp_user_id)->first();
                $mpPS = new MpPs;
                $mpPS->mp_user_id = $request->mp_user_id;
                $mpPS->ps_user_id = $ps->id;

                $mpPS->save();
            }
            DB::commit();
            $alert = "success";
            $message = "Created successfully";
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            $alert = "success";
            $message = $th->getMessage();
        }

        return redirect()->back()->with($alert, $message);
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
        $data['mpUsers'] = User::where('usertype', 'mp')->get();
        $data['editData'] = User::find($id);
        // dd($data['editData']['psMpInfo']);
        // dd($data['editData']->toArray());
        return view('backend.master_setup.personal_secretaries.edit', $data);
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
        $this->validateData($request, $id);

        // dd($request->all());
        DB::beginTransaction();
        try {
            $ps = User::find($id);
            $ps->name = $request->name;
            $ps->email = $request->email;
            $ps->password = bcrypt($request->password);
            $ps->update();
            if ($ps) {
                $mpPS = MpPs::where('ps_user_id', $id)->first();
                $mpPS->mp_user_id = $request->mp_user_id;
                $mpPS->ps_user_id = $ps->id;

                $mpPS->update();
            }
            DB::commit();
            $alert = "success";
            $message = "updated successfully";
        } catch (\Throwable $th) {
            DB::rollback();
            // dd($th);
            $alert = "success";
            $message = $th->getMessage();
        }

        return redirect()->back()->with($alert, $message);
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

    protected function validateData($request, $id = null){
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'mp_user_id' => ['required'],
        ];

        if ($request->isMethod('post')) {
            $rules['email'] = ['required','string','email','max:255','unique:users'];
            $rules['password'] = ['required', 'string', 'min:4', 'confirmed'];
        }
        if ($request->isMethod('PUT')) {
            $rules['email'] = ['required','string','email','max:255',Rule::unique('users')->ignore($id)];
        }

        $request->validate($rules);
    }
}
