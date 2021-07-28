<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\IndexController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix'=>'admin' , 'middleware'=>['admin:admin']] , function(){
    Route::get('/login',[AdminController::class, 'loginForm']);
    Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    
    return view('admin.index');
})->name('dashboard');

// All Admin Routes

Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('/admin/profile',[AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit',[AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store',[AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password',[AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/update/change/password',[AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');




// User All Routes

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
        $users = User::find($id);
    return view('dashboard' ,compact('users'));
})->name('dashboard');

Route::get('/' , [IndexController::class , 'index']);
Route::get('/user/logout' , [IndexController::class , 'UserLogout'])->name('user.logout');
Route::get('/user/profile' , [IndexController::class , 'UserProfile'])->name('user.profile');
Route::post('/user/profile/update' , [IndexController::class , 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password' , [IndexController::class , 'UserChangePassword'])->name('user.change.password');
Route::post('/user/password/update' , [IndexController::class , 'UserPasswordUpdate'])->name('user.profile.update');


// All Backend Brand Routes

Route::prefix('brand')->group(function(){
    Route::get('/view' , [BrandController::class , 'BrandView'])->name('all.brand');
    Route::post('/store' , [BrandController::class , 'BrandStore'])->name('store.brand');
    Route::get('/edit/{id}' , [BrandController::class , 'BrandEdit'])->name('brand.edit');
    Route::post('/update/{id}' , [BrandController::class , 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}' , [BrandController::class , 'BrandDelete'])->name('brand.delete');
});

// All Backend Category Routes

Route::prefix('category')->group(function(){
    Route::get('/view' , [CategoryController::class , 'CategoryView'])->name('all.category');
    Route::post('/store' , [CategoryController::class , 'CategoryStore'])->name('store.category');
    Route::get('/edit/{id}' , [CategoryController::class , 'CategoryEdit'])->name('category.edit');
    Route::post('/update/{id}' , [CategoryController::class , 'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}' , [CategoryController::class , 'CategoryDelete'])->name('category.delete');

    // All Sub Category Routes

    Route::get('/sub/view' , [SubCategoryController::class , 'SubCategoryView'])->name('all.subcategory');
    Route::post('/sub/store' , [SubCategoryController::class , 'SubCategoryStore'])->name('store.subcategory');
    Route::get('/sub/edit/{id}' , [SubCategoryController::class , 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update/{id}' , [SubCategoryController::class , 'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}' , [SubCategoryController::class , 'SubCategoryDelete'])->name('subcategory.delete');

    // All Sub -> Sub Category Routes
    Route::get('/sub/sub/view' , [SubCategoryController::class , 'SubSubCategoryView'])->name('all.subsubcategory');
    Route::get('/subcategory/ajax/{category_id}' , [SubCategoryController::class , 'GetSubCategory']);
    Route::get('/subsubcategory/ajax/{subcategory_id}' , [SubCategoryController::class , 'GetSubSubCategory']);
    Route::post('/sub/sub/store' , [SubCategoryController::class , 'SubSubCategoryStore'])->name('store.subsubcategory');
    Route::get('/sub/sub/edit/{id}' , [SubCategoryController::class , 'SubSubCategoryEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update/{id}' , [SubCategoryController::class , 'SubSubCategoryUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}' , [SubCategoryController::class , 'SubSubCategoryDelete'])->name('subsubcategory.delete');

});

// All Products Routes

Route::prefix('product')->group(function(){
    Route::get('/view', [ProductController::class , 'AddProduct'])->name('add-product');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
    Route::post('/data/update', [ProductController::class, 'UpdateProduct'])->name('product-update');
    Route::post('/Image/update', [ProductController::class, 'MultiImageUpdate'])->name('product-update-images');
    Route::post('/thumbnail/update', [ProductController::class, 'ThumbailImageUpdate'])->name('product-update-thumbnail');
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInActive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
});

// All Slider Routes

Route::prefix('slider')->group(function(){
    Route::get('/view' , [SliderController::class , 'SliderView'])->name('manage-slider');
    Route::post('/store' , [BrandController::class , 'BrandStore'])->name('store.brand');
    Route::get('/edit/{id}' , [BrandController::class , 'BrandEdit'])->name('brand.edit');
    Route::post('/update/{id}' , [BrandController::class , 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}' , [BrandController::class , 'BrandDelete'])->name('brand.delete');
});