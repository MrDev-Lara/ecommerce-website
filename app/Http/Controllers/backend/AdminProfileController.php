<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function adminProfile(){
    	$admin = Admin::find(1);
    	return view('admin.admin_profile_view',compact('admin'));
    }

    public function adminProfileEdit(){
    	$adminData = Admin::find(1);
    	return view('admin.admin_profile_edit',compact('adminData'));
    }

     public function adminProfileStore(Request $request){
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;


        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    	
    }

    public function adminChangePassword(){
    	return view('admin.admin_change_password');
    }

    public function updateAdminPassword(Request $request){
    	$validated = $request->validate([
        	'old_password' => 'required',
        	'password' => 'required|confirmed',
   		]);

    	$AdminDataPassword = Admin::find(1)->password;
    	if(Hash::check($request->old_password,$AdminDataPassword)){
    		$admin = Admin::find(1);
    		$admin->password = Hash::make($request->password);
    		$admin->save();
    		Auth::logout();

    		$notification=array(
	         'message'=>'Password Updated',
	         'alert-type'=>'success'
	          );
    		return redirect()->route('admin.logout')->with($notification);
	    }else{
	    	$notification=array(
	         'message'=>'Old password do not Matched',
	         'alert-type'=>'error'
	          );
	    	return redirect()->back()->with($notification);
	    }
    }
}
