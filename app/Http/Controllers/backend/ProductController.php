<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductMultiImage;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    	public function AddProduct(){
		$categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		return view('backend.product.product_add',compact('categories','brands'));


	}

		public function StoreProduct(Request $request){
		$image = $request->file('product_thambnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
    	$save_url = 'upload/products/thambnail/'.$name_gen;

      $product_id = Product::insertGetId([
      	'brand_id' => $request->brand_id,
      	'category_id' => $request->category_id,
      	'subcategory_id' => $request->subcategory_id,
      	'subsubcategory_id' => $request->subsubcategory_id,
      	'product_name_en' => $request->product_name_en,
      	'product_name_hin' => $request->product_name_hin,
      	'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
      	'product_slug_hin' => str_replace(' ', '-', $request->product_name_hin),
      	'product_code' => $request->product_code,

      	'product_qty' => $request->product_qty,
      	'product_tags_en' => $request->product_tags_en,
      	'product_tags_hin' => $request->product_tags_hin,
      	'product_size_en' => $request->product_size_en,
      	'product_size_hin' => $request->product_size_hin,
      	'product_color_en' => $request->product_color_en,
      	'product_color_hin' => $request->product_color_hin,

      	'selling_price' => $request->selling_price,
      	'discount_price' => $request->discount_price,
      	'short_descp_en' => $request->short_descp_en,
      	'short_descp_hin' => $request->short_descp_hin,
      	'long_descp_en' => $request->long_descp_en,
      	'long_descp_hin' => $request->long_descp_hin,

      	'hot_deals' => $request->hot_deals,
      	'featured' => $request->featured,
      	'special_offer' => $request->special_offer,
      	'special_deals' => $request->special_deals,

      	'product_thambnail' => $save_url,
      	'status' => 1,
      	'created_at' => Carbon::now(),  
      	]); 	 

         ////////// Multiple Image Upload Start ///////////

      $images = $request->file('multi_img');
      foreach ($images as $img) {
      	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
    	$uploadPath = 'upload/products/multi-image/'.$make_name;

    	ProductMultiImage::insert([

    		'product_id' => $product_id,
    		'photo_name' => $uploadPath,
    		'created_at' => Carbon::now(), 

    	]);
}
    	    $notification = array(
			'message' => 'Product Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

      ////////// Een Multiple Image Upload Start ///////////
		}

		public function ManageProduct(){

		$products = Product::latest()->get();
		return view('backend.product.product_view',compact('products'));
	}

	public function ProductEdit($id){

		$multiImgs = ProductMultiImage::where('product_id',$id)->get();
		$categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		$subcategory = SubCategory::latest()->get();
		$subsubcategory = SubSubCategory::latest()->get();
		$products = Product::findOrFail($id);
		return view('backend.product.product_edit',compact('multiImgs','categories','brands','subcategory','subsubcategory','products'));

	}

	public function ProductUpdate(Request $request, $id){
		 Product::findOrFail($id)->update([
      	'brand_id' => $request->brand_id,
      	'category_id' => $request->category_id,
      	'subcategory_id' => $request->subcategory_id,
      	'subsubcategory_id' => $request->subsubcategory_id,
      	'product_name_en' => $request->product_name_en,
      	'product_name_hin' => $request->product_name_hin,
      	'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
      	'product_slug_hin' => str_replace(' ', '-', $request->product_name_hin),
      	'product_code' => $request->product_code,

      	'product_qty' => $request->product_qty,
      	'product_tags_en' => $request->product_tags_en,
      	'product_tags_hin' => $request->product_tags_hin,
      	'product_size_en' => $request->product_size_en,
      	'product_size_hin' => $request->product_size_hin,
      	'product_color_en' => $request->product_color_en,
      	'product_color_hin' => $request->product_color_hin,

      	'selling_price' => $request->selling_price,
      	'discount_price' => $request->discount_price,
      	'short_descp_en' => $request->short_descp_en,
      	'short_descp_hin' => $request->short_descp_hin,
      	'long_descp_en' => $request->long_descp_en,
      	'long_descp_hin' => $request->long_descp_hin,

      	'hot_deals' => $request->hot_deals,
      	'featured' => $request->featured,
      	'special_offer' => $request->special_offer,
      	'special_deals' => $request->special_deals,

      	'status' => 1,
      	'created_at' => Carbon::now(),  
      	]); 	 

		 $notification = array(
			'message' => 'Product Updated Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('manage-product')->with($notification);
	}

/// Multiple Image Update
	public function ProductImageUpdate(Request $request){
		$imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
	    $imgDel = ProductMultiImage::findOrFail($id);
	    unlink($imgDel->photo_name);

    	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
    	$uploadPath = 'upload/products/multi-image/'.$make_name;

    	ProductMultiImage::where('id',$id)->update([
    		'photo_name' => $uploadPath,
    		'updated_at' => Carbon::now(),

    	]);

	 } // end foreach

       $notification = array(
			'message' => 'Product Image Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

	} // end mehtod 

	public function ProductThumbnailImageUpdate(Request $request, $id){

 	unlink(Product::findOrFail($id)->product_thambnail);

    $image = $request->file('product_thambnail');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
    	$save_url = 'upload/products/thambnail/'.$name_gen;

    	Product::findOrFail($id)->update([
    		'product_thambnail' => $save_url,
    		'updated_at' => Carbon::now(),

    	]);

         $notification = array(
			'message' => 'Product Image Thambnail Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);
	}

	public function Productmultiimagedelete($id){
		unlink(ProductMultiImage::findOrFail($id)->photo_name);
		ProductMultiImage::findOrFail($id)->delete();

		$notification = array(
			'message' => 'Product Image deleted Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);
	}

	public function ProductStatus($id){
		$product_status = Product::findOrFail($id)->status;
		if($product_status == 1){
			Product::findOrFail($id)->update(['status' => 0]);
		}else{
			Product::findOrFail($id)->update(['status' => 1]);
		}

		$notification = array(
			'message' => 'Product Status updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);
	}

	public function ProductDelete($id){
		$products = Product::findOrFail($id);
		unlink($products->product_thambnail);
		product::findOrFail($id)->delete();

		$images = ProductMultiImage::where('product_id',$id)->get();
		foreach($images as $img){
			unlink($img->photo_name);
			ProductMultiImage::where('product_id',$id)->delete();
		}

		$notification = array(
			'message' => 'Product Dedleted Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);
	}
}
