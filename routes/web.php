<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
<<<<<<< HEAD
use App\Http\Controllers\Backend\ShippingController;
=======
>>>>>>> a0b402d16655456ed68d58f1b2999e62c658e4f1
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;


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

Route::middleware(['auth:admin'])->group(function(){
    
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
    Route::post('/data/update/{id}', [ProductController::class, 'UpdateProduct'])->name('product-update');
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
    Route::post('/store' , [SliderController::class , 'SliderStore'])->name('store.slider');
    Route::get('/edit/{id}' , [SliderController::class , 'SLiderEdit'])->name('slider.edit');
    Route::post('/update/{id}' , [SliderController::class , 'SliderUpdate'])->name('slider.update');
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInActive'])->name('slider.inactive');
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
    Route::get('/delete/{id}' , [SliderController::class , 'SliderDelete'])->name('slider.delete');

});

// All Coupon Routes

Route::prefix('coupon')->group(function(){
    Route::get('/view' , [CouponController::class , 'CouponView'])->name('manage-coupon');
    Route::post('/store' , [CouponController::class , 'CouponStore'])->name('store.coupon');
<<<<<<< HEAD
    Route::get('/edit/{id}' , [CouponController::class , 'CouponEdit'])->name('coupon.edit');
    Route::post('/update/{id}' , [CouponController::class , 'CouponUpdate'])->name('coupon.update');
    Route::get('/delete/{id}' , [CouponController::class , 'CouponDelete'])->name('coupon.delete');

});

// All Shipping Routes

Route::prefix('shipping')->group(function(){
    
    // Ship Division Routes

    Route::get('/division/view' , [ShippingController::class , 'DivisionView'])->name('manage-division');
    Route::post('division/store' , [ShippingController::class , 'DivisionStore'])->name('store.division');
    Route::get('/division/edit/{id}' , [ShippingController::class , 'DivisionEdit'])->name('division.edit');
    Route::post('/division/update/{id}' , [ShippingController::class , 'DivisionUpdate'])->name('division.update');
    Route::get('/delete/{id}' , [ShippingController::class , 'DivisionDelete'])->name('division.delete');


    // Ship District Routes

    Route::get('/district/view' , [ShippingController::class , 'DistrictView'])->name('manage-district');
    Route::post('district/store' , [ShippingController::class , 'DistrictStore'])->name('store.district');
    Route::get('/district/edit/{id}' , [ShippingController::class , 'DistrictEdit'])->name('district.edit');
    Route::post('/district/update/{id}' , [ShippingController::class , 'DistrictUpdate'])->name('district.update');
    Route::get('/district/delete/{id}' , [ShippingController::class , 'DistrictDelete'])->name('district.delete');

    // Ship State Routes

    Route::get('/state/view' , [ShippingController::class , 'StateView'])->name('manage-state');
    Route::post('state/store' , [ShippingController::class , 'StateStore'])->name('store.state');
    Route::get('/state/edit/{id}' , [ShippingController::class , 'StateEdit'])->name('state.edit');
    Route::post('/state/update/{id}' , [ShippingController::class , 'StateUpdate'])->name('state.update');
    Route::get('/state/delete/{id}' , [ShippingController::class , 'StateDelete'])->name('state.delete');
    
    Route::get('/district/ajax/{id}' , [ShippingController::class , 'GetDistrictData']);
  
    

 
});

=======
    Route::get('/edit/{id}' , [SliderController::class , 'SLiderEdit'])->name('slider.edit');
    Route::post('/update/{id}' , [SliderController::class , 'SliderUpdate'])->name('slider.update');
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInActive'])->name('slider.inactive');
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
    Route::get('/delete/{id}' , [SliderController::class , 'SliderDelete'])->name('slider.delete');

});

>>>>>>> a0b402d16655456ed68d58f1b2999e62c658e4f1




});
// end middleware


// All Frontend Routes

Route::get('language/urdu' ,[LanguageController::class , 'Urdu'])->name('urdu.language');
Route::get('language/english' ,[LanguageController::class , 'english'])->name('english.language');

// ALL Products Deatils Routes

Route::get('product/detail/{id}/{slug} ' ,[IndexController::class , 'ProductDetails']);

// ALL Tagwise Products Routes

Route::get('product/tag/{tag} ' ,[IndexController::class , 'TagWiseProduct']);

// ALL SubCategoryWise  Products Routes

Route::get('subcategory/product/{subcat_id}/{slug} ' ,[IndexController::class , 'SubCatgeoryWiseProduct']);

// ALL Sub-SubCategoryWise Products Routes

Route::get('subsubcategory/product/{subcat_id}/{slug} ' ,[IndexController::class , 'SubSubCatgeoryWiseProduct']);

// ALL Add To Cart Products Routes

Route::get('/product/view/modal/{id}' , [IndexController::class , 'ProductViewAjax']);
Route::post('/cart/data/store/{id}' ,[CartController::class , 'AddToCart']);
Route::get('/product/mini/cart' ,[CartController::class , 'AddMiniCart']);
Route::get('/minicart/product/remove/{rowId}' ,[CartController::class , 'MiniCartRemove']);

// All Add To Wishlist Routes

    Route::post('/add-to-wishlist/{product_id}',[CartController::class , 'AddToWishlist']);
Route::group(['prefix'=>'user' , 'middleware'=>['user','auth'] , 'namespace'=>'User'] ,function(){
    Route::get('/wishlist',[WishlistController::class , 'ViewWishlist'])->name('wishlist');
    Route::get('/get-wishlist-product',[WishlistController::class , 'GetWishlistProduct']);
    Route::get('/wishlist/remove/{id}',[WishlistController::class , 'wishlistRemove']);
  
});

// All Cart View Page Routes
    Route::get('/mycart',[CartPageController::class , 'MyCart'])->name('mycart');
    Route::get('/user/get-cartpage-product',[CartPageController::class , 'GetCartProduct']);
    Route::get('/user/cart/product/remove/{id}',[CartPageController::class , 'CartProductRemove']);
    Route::get('/cart-increment/{id}',[CartPageController::class , 'CartIncrement']);
    Route::get('/cart-decrement/{id}',[CartPageController::class , 'CartDecrement']);


// Coupon Routes

Route::post('/coupon_apply',[CartController::class , 'Coupon_apply']);
Route::get('/coupon_calculation',[CartController::class , 'Coupon_calc']);

// All Frontend Routes ends ///////


// User All Routes

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function() {
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

