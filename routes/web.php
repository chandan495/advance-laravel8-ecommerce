<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\User\WishlistController;
use App\Models\User;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;


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

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});


Route::middleware(['auth:admin'])->group(function(){



Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');

//admin all route
Route::get('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
Route::get('admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
Route::post('admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

Route::post('update/change/password', [AdminProfileController::class, 'AdminUpdatePassword'])->name('update.change.password');


});
//user all route



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');

//admin brand all route

Route::prefix('brand')->group(function(){
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');

    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('edit.brand');
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');

});
// admin cateory all route
Route::prefix('category')->group(function(){
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');

    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

//all admin sub category

Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');
    Route::post('sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

//});

//all admin sub sub category

Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');
Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubcategory']);
Route::get('/subsubcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubcategory']);
Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
Route::post('/sub/sub/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
    
Route::get('sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');

});

Route::prefix('product')->group(function(){
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
    Route::post('/data/update', [ProductController::class, 'ProductUpdate'])->name('product-update');
    
    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
    Route::post('/thumb/update', [ProductController::class, 'ThumbImageUpdate'])->name('update-product-thumbnail');

    Route::get('/multiimg/delete/{id}', [ProductController::class, 'DeleteMultiImage'])->name('product.multiimg.delete');

    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');

    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');

    Route::get('/view/details/{id}', [ProductController::class, 'ViewProduct'])->name('product.view');
    // Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    // Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    //Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('product.delete');
});
Route::prefix('slider')->group(function(){
    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');

    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('edit.slider');
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');

});

//frontend all language

//multilangauage

Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');
Route::get('/language/hindi', [LanguageController::class, 'Hindi'])->name('hindi.language');

//product details page in frontend
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

Route::get('/product/tag/{tag}', [IndexController::class, 'TagwiseProduct']);

Route::get('/subcategory/product/{subcatid}/{slug}', [IndexController::class, 'CategorywiseProduct']);

Route::get('/subsubcategory/product/{subsubcatid}/{slug}', [IndexController::class, 'SubSubCategorywiseProduct']);

//product view with ajax

Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

//add to cart to store

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlistcart']);

Route::group(['prefix'=>'user', 'middleware'=>['user','auth'], 'namespace'=>'User'], function(){

    Route::get('/wishlist', [WishlistController::class, 'UserWishlist'])->name('wishlist');
    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlist']);

    Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
    

    
});

Route::get('/mycart', [CartPageController::class, 'UserMycart'])->name('mycart');
Route::get('/user/get-mycart-product', [CartPageController::class, 'GetCartProduct']);
Route::get('/cart-increament/{rowId}', [CartPageController::class, 'CartIncreament']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecreament']);

Route::prefix('coupons')->group(function(){
    Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');
    Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
    Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
    Route::post('/update', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
    
    Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
    
    
});

Route::prefix('shipping')->group(function(){
    //Division Route
    Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');
    Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
    Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');
    Route::post('/division/update', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
    Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');

     //District Route
     Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');
     Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
     Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');

     Route::post('/district/update', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
     Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');

     //State Route
     
     Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage-state');

     Route::get('/district/ajax/{district_id}', [ShippingAreaController::class, 'GetDistrict']);

     Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');
     Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');

     Route::post('/state/update', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');
     Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');
    
    
});

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

//checkout route 1
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'GetDistrictAjax']);
Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'GetStateAjax']);
Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout-store');