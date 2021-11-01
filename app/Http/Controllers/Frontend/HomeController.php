<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
    	return view('frontend.index');
    }

    public function userLogout(){
    	Auth::logout();
    	return Redirect()->route('login');
    }

    public function userProfile(){
    	$id = Auth::user()->id;
    	$user = User::find($id);
    	return view('frontend.profile.user_profile',compact('user'));
    }

    public function userProfileStore(Request $request){
    	$validated = $request->validate([
        	'name' => 'required|max:25',
        	'email' => 'required',
        	'phone' => 'required',
        	'profile_photo_path' => 'mimes:jpg,jpeg,png',
   		],
   		[
   			'name.required' => 'Please input a valid Name'
   		]);

    	$user_image = $request->file('profile_photo_path');

    	if($user_image){
    	$unique_name = hexdec(uniqid());
    	$file_ext = strtolower($user_image->getClientOriginalExtension());
    	$final_file_name = $unique_name.'.'.$file_ext;
    	$final_img = $final_file_name;
    	$done = $user_image->move(public_path('backend/upload/user'),$final_file_name);


    	User::find(Auth::user()->id)->update([
    		'name' => $request->name,
    		'email' => $request->email,
    		'phone' => $request->phone,
    		'profile_photo_path' => $final_img,
    	]);

    	$notification=array(
	         'message'=>'Profile Updated',
	         'alert-type'=>'success'
	          );
    	return redirect()->route('dashboard')->with($notification);
	    }else{
	    	User::find(Auth::id())->update([
    		'name' => $request->name,
    		'email' => $request->email,
    		'phone' => $request->phone,
    	]);

	    $notification=array(
	         'message'=>'Profile Updated',
	         'alert-type'=>'success'
	          );
    		return redirect()->route('dashboard')->with($notification);
	    }
    }

    public function changePassword(){
        return view('frontend.profile.change_password');
    }

    public function updatePassword(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $userpassword = User::find(Auth::id())->password;
        if(Hash::check($request->old_password,$userpassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification=array(
             'message'=>'Password Updated',
             'alert-type'=>'success'
              );
            return redirect()->route('user.logout')->with($notification);
        }else{
            $notification=array(
             'message'=>'Old password do not Matched',
             'alert-type'=>'error'
              );
            return redirect()->back()->with($notification);
        }
    }
}
