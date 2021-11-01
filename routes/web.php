<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\SubcategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\Frontend\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});


//Admin Routes

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
Route::post('/update/admin/password', [AdminProfileController::class, 'updateAdminPassword'])->name('update.admin.password');

Route::prefix('brand')->group(function(){
	Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
	Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
	Route::get('/edit/{id}', [BrandController::class, 'BrandEdit']);
	Route::post('/update/{id}', [BrandController::class, 'BrandUpdate']);
	Route::get('/delete/{id}', [BrandController::class, 'BrandDelete']);
});


Route::prefix('category')->group(function(){
	Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
	Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
	Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit']);
	Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate']);
	Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete']);
	Route::get('/subcategory/ajax/{category_id}', [SubcategoryController::class, 'GetSubCategory']);
	Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
});

Route::prefix('subcategory')->group(function(){
	Route::get('/view', [SubcategoryController::class, 'SubCategoryView'])->name('all.subcategory');
	Route::post('/store', [SubcategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
	Route::get('/edit/{id}', [SubcategoryController::class, 'SubCategoryEdit']);
	Route::post('/update/{id}', [SubcategoryController::class, 'SubCategoryUpdate']);
	Route::get('/delete/{id}', [SubcategoryController::class, 'SubCategoryDelete']);

	//sub sub-category
	Route::get('sub/view', [SubcategoryController::class, 'SubsubCategoryView'])->name('all.subsubcategory');
	Route::post('sub/store', [SubcategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
	Route::get('/sub/edit/{id}', [SubcategoryController::class, 'SubSubCategoryEdit']);
	Route::post('/sub/update/{id}', [SubcategoryController::class, 'SubSubCategoryUpdate']);
	Route::get('/sub/delete/{id}', [SubcategoryController::class, 'SubSubCategoryDelete']);
});

//Admin products manageent

Route::prefix('product')->group(function(){
	Route::get('/add', [ProductController::class, 'AddProduct'])->name('add.product');
	Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
	Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
	Route::get('/edit/{id}', [ProductController::class, 'ProductEdit']);
	Route::post('/update/{id}', [ProductController::class, 'ProductUpdate']);
	Route::post('/product-image/update', [ProductController::class, 'ProductImageUpdate']);
	Route::post('/product-thumbnail/update/{id}', [ProductController::class, 'ProductThumbnailImageUpdate']);
	Route::get('/multiimage/delete/{id}', [ProductController::class, 'Productmultiimagedelete']);
	Route::get('/status/{id}', [ProductController::class, 'ProductStatus']);
	Route::get('/delete/{id}', [ProductController::class, 'ProductDelete']);
});

//User Routes

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [HomeController::class, 'index']);
Route::get('/user/logout', [HomeController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile', [HomeController::class, 'userProfile'])->name('user.profile');
Route::post('/user/profile/store', [HomeController::class, 'userProfileStore'])->name('user.profile.store');
Route::get('/change/password', [HomeController::class, 'changePassword'])->name('change.password');
Route::post('/update/password', [HomeController::class, 'updatePassword'])->name('update.password');