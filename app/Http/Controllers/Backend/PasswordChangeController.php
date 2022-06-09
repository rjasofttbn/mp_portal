<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
use Session;
use Auth;

class PasswordChangeController extends Controller
{
    //
    public function changePassword()
    {
    	return view('backend.change_password.change-password');
    } 

    public function storePassword(Request $request)
    {

    	$request->validate([
    		'new_password' => 'required|min:8|regex:/^(?=\S*[a-z])(?=\S*[\d])\S*$/',
    		'confirm_password' => 'required|same:new_password',
    	]);
    	
    	$auth_id = authInfo()->id;
    	// dd($auth_id);
    	if($request->new_password == $request->confirm_password)
    	{
    		$previous_password = authInfo()->password;

    		if(Hash::check($request->old_password,$previous_password))
    		{	
    			$user = User::find($auth_id);
    			$password = Hash::make($request->new_password);
    			// dd($password);
    			$user->password = $password;
    			$user->update();
    			session()->flash('info', 'Password Change Successfully!');
    			return redirect()->route('profile-management.change.password');

    		}
    		else
    		{
    			session()->flash('msg', 'Password does not match with previous password');
    			return redirect()->back();
    		}

    	}

    	// return view('backend.change_password.change-password');
    }

}
