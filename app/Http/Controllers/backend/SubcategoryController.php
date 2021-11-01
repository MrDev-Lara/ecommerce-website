<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Category;

class SubcategoryController extends Controller
{
    public function SubCategoryView(){
    	$cats = Category::all();
    	$subcategories = Subcategory::latest()->get();
    	return view('backend.subcategory.subcategory_view',compact('subcategories','cats'));
    }

     public function SubCategoryStore(Request $request){
    	$validateData = $request->validate([
    		'category_id' => 'required',
    		'subcategory_name_en' => 'required',
        	'subcategory_name_hin' => 'required',
    	],
    	[
    		'subcategory_name_en.required' => 'Please input a valid SubCategory Name',
    		'subcategory_name_hin.required' => 'Please insert a valid hindi SubCategory name',
    	]);

 
    	Subcategory::insert([
    		'category_id' => $request->category_id,
    		'subcategory_name_en' => $request->subcategory_name_en,
    		'subcategory_name_hin' => $request->subcategory_name_hin,
    		'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
    		'subcategory_slug_hin' => strtolower(str_replace(' ', '-', $request->subcategory_name_hin)),
    	]);

    	$notification=array(
	         'message'=>'SubCategory Successfully Added',
	         'alert-type'=>'success'
	          );
    	return redirect()->back()->with($notification);
    }

     public function SubCategoryEdit($id){
     	$cats = Category::all();
    	$subcategory = Subcategory::findOrFail($id);
    	return view('backend.subcategory.subcategory_edit',compact('subcategory','cats'));
    }

    public function SubCategoryUpdate(Request $request,$id){
    	$validateData = $request->validate([
    		'category_id' => 'required',
    		'subcategory_name_en' => 'required',
        	'subcategory_name_hin' => 'required',
    	],
    	[
    		'subcategory_name_en.required' => 'Please input a valid Sub-Category Name',
    		'subcategory_name_hin.required' => 'Please insert a valid hindi sub-Category name',
    	]);

	    	Subcategory::findOrFail($id)->update([
	    	'category_id' => $request->category_id,
    		'subcategory_name_en' => $request->subcategory_name_en,
    		'subcategory_name_hin' => $request->subcategory_name_hin,
    		'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
    		'subcategory_slug_hin' => strtolower(str_replace(' ', '-', $request->subcategory_name_hin)),
    	]);

	    	$notification=array(
	         'message'=>'Sub-Category Successfully Updated',
	         'alert-type'=>'success'
	          );
    	return redirect()->route('all.subcategory')->with($notification);
    	
    }

     public function SubCategoryDelete($id){
    
    	Subcategory::findOrFail($id)->delete();

    	$notification=array(
	         'message'=>'Sub-Category Successfully Deleted',
	         'alert-type'=>'success'
	          );
    	return redirect()->back()->with($notification);
    	}

    	//Sub sub-category

    	public function SubsubCategoryView(){
    	$cats = Category::all();
    	$subsubcategories = SubSubcategory::latest()->get();
    	return view('backend.subcategory.subsubcategory_view',compact('subsubcategories','cats'));
    }

    public function GetSubCategory($category_id){
    	$subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
     	return json_encode($subcat);
    }

     public function GetSubSubCategory($subcategory_id){

        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
     }


    public function SubSubCategoryStore(Request $request){
    	$validateData = $request->validate([
    		'category_id' => 'required',
    		'subcategory_id' => 'required',
    		'subsubcategory_name_en' => 'required',
        	'subsubcategory_name_hin' => 'required',
    	],
    	[
    		'subsubcategory_name_en.required' => 'Please input a valid Sub sub-Category Name',
    		'subsubcategory_name_hin.required' => 'Please insert a valid hindi Sub sub-Category name',
    	]);

 
    	SubSubcategory::insert([
    		'category_id' => $request->category_id,
    		'subcategory_id' => $request->subcategory_id,
    		'subsubcategory_name_en' => $request->subsubcategory_name_en,
    		'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
    		'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
    		'subsubcategory_slug_hin' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_hin)),
    	]);

    	$notification=array(
	         'message'=>'Sub subCategory Successfully Added',
	         'alert-type'=>'success'
	          );
    	return redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id){
     	$cats = Category::all();
    	$subsubcats = SubSubcategory::findOrFail($id);
    	$cat_id =  SubSubcategory::findOrFail($id)->category_id;
    	$subcats = Subcategory::where('category_id',$cat_id)->get();
    	return view('backend.subcategory.subsubcategory_edit',compact('cats','subcats','subsubcats'));
    }

    public function SubSubCategoryUpdate(Request $request,$id){
    	$validateData = $request->validate([
    		'category_id' => 'required',
    		'subcategory_id' => 'required',
    		'subsubcategory_name_en' => 'required',
        	'subsubcategory_name_hin' => 'required',
    	],
    	[
    		'subsubcategory_name_en.required' => 'Please input a valid Sub sub-Category Name',
    		'subsubcategory_name_hin.required' => 'Please insert a valid hindi sub sub-Category name',
    	]);

	    	SubSubcategory::findOrFail($id)->update([
	    	'category_id' => $request->category_id,
    		'subcategory_id' => $request->subcategory_id,
    		'subsubcategory_name_en' => $request->subsubcategory_name_en,
    		'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
    		'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
    		'subsubcategory_slug_hin' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_hin)),
    	]);

	    	$notification=array(
	         'message'=>'Sub sub-Category Successfully Updated',
	         'alert-type'=>'success'
	          );
    	return redirect()->route('all.subsubcategory')->with($notification);
    	
    }

    public function SubSubCategoryDelete($id){
    
    	SubSubcategory::findOrFail($id)->delete();

    	$notification=array(
	         'message'=>'Sub subp-Category Successfully Deleted',
	         'alert-type'=>'success'
	          );
    	return redirect()->back()->with($notification);
    	}

}
