<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function BrandView(){
    	$brands = Brand::latest()->get();
    	return view('backend.brand.brand_view',compact('brands'));
    }

    public function BrandStore(Request $request){
    	$validateData = $request->validate([
    		'brand_name_en' => 'required',
        	'brand_name_hin' => 'required',
        	'brand_image' => 'required|mimes:jpg,jpeg,png',
    	],
    	[
    		'brand_name_en.required' => 'Please input a valid Brand Name',
    		'brand_name_hin.required' => 'Please insert a valid hindi Brand name',
    	]);

    	$image = $request->file('brand_image');
    	$unique_name = hexdec(uniqid());
    	$file_ext = strtolower($image->getClientOriginalExtension());
    	$final_file_name = $unique_name.'.'.$file_ext;
    	Image::make($image)->resize(300,300)->save('upload/brand/'.$final_file_name);
    	$saveURL = 'upload/brand/'.$final_file_name;

    	Brand::insert([
    		'brand_name_en' => $request->brand_name_en,
    		'brand_name_hin' => $request->brand_name_hin,
    		'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
    		'brand_slug_hin' => strtolower(str_replace(' ', '-', $request->brand_name_hin)),
    		'brand_image' => $saveURL,
    	]);

    	$notification=array(
	         'message'=>'Brand Successfully Added',
	         'alert-type'=>'success'
	          );
    	return redirect()->back()->with($notification);
    }

    public function BrandEdit($id){
    	$brand = Brand::findOrFail($id);
    	return view('backend.brand.brand_edit',compact('brand'));
    }

    public function BrandUpdate(Request $request,$id){
    	$validateData = $request->validate([
    		'brand_name_en' => 'required',
        	'brand_name_hin' => 'required',
        	'brand_image' => 'mimes:jpg,jpeg,png',
    	],
    	[
    		'brand_name_en.required' => 'Please input a valid Brand Name',
    		'brand_name_hin.required' => 'Please insert a valid hindi Brand name',
    	]);

    	if($request->file('brand_image')){
    		$old_image = Brand::find($id)->brand_image;
    		unlink($old_image);
    		$image = $request->file('brand_image');
    		$unique_name = hexdec(uniqid());
	    	$file_ext = strtolower($image->getClientOriginalExtension());
	    	$final_file_name = $unique_name.'.'.$file_ext;
	    	Image::make($image)->resize(300,300)->save('upload/brand/'.$final_file_name);
	    	$saveURL = 'upload/brand/'.$final_file_name;

	    	Brand::findOrFail($id)->update([
    		'brand_name_en' => $request->brand_name_en,
    		'brand_name_hin' => $request->brand_name_hin,
    		'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
    		'brand_slug_hin' => strtolower(str_replace(' ', '-', $request->brand_name_hin)),
    		'brand_image' => $saveURL,
    	]);

	    	$notification=array(
	         'message'=>'Brand Successfully Updated',
	         'alert-type'=>'success'
	          );
    	return redirect()->route('all.brand')->with($notification);
    	}else{
    		Brand::findOrFail($id)->update([
    		'brand_name_en' => $request->brand_name_en,
    		'brand_name_hin' => $request->brand_name_hin,
    		'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
    		'brand_slug_hin' => strtolower(str_replace(' ', '-', $request->brand_name_hin)),
    	]);

    		$notification=array(
	         'message'=>'Brand Successfully Updated',
	         'alert-type'=>'success'
	          );
    	return redirect()->route('all.brand')->with($notification);
    	}
    }

    public function BrandDelete($id){
    	$old_image = Brand::findOrFail($id)->brand_image;
    	unlink($old_image);
    	Brand::findOrFail($id)->delete();

    	$notification=array(
	         'message'=>'Brand Successfully Deleted',
	         'alert-type'=>'success'
	          );
    	return redirect()->back()->with($notification);
    	}
    }
