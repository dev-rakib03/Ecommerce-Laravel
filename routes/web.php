<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\shareController;
use App\Http\Controllers\Admin\SelfOrderController;

use App\Http\Controllers\Front\FrontController;

use Illuminate\Support\Facades\Route;

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

//Pages
Route::get('/',[FrontController::class,'index']);
Route::get('category/{id}',[FrontController::class,'category']);
Route::post('place_order',[FrontController::class,'place_order']);

//Product
Route::get('product/{id}',[FrontController::class,'product']);
Route::post('get-attribute-id',[FrontController::class,'get_attribute_id']);

//cart
Route::post('add-to-cart',[FrontController::class,'add_to_cart'])->name('cart.add');
Route::post('cart-qty-update',[FrontController::class,'cart_qty_change']);
Route::post('cart-remove-product',[FrontController::class,'cart_remove_product']);
Route::post('cart-clear',[FrontController::class,'cart_clear']);
Route::get('cart',[FrontController::class,'cart']);

//Order
Route::post('checkout',[FrontController::class,'checkout']);
Route::get('order-placed',[FrontController::class,'order_placed']);
Route::get('order-tracking',[FrontController::class,'order_tracking']);
Route::post('order-tracking-find',[FrontController::class,'order_tracking_find']);

//Social order
Route::get('order/{slag}',[FrontController::class,'share_order']);

//Search
Route::get('search/{str}',[FrontController::class,'search']);

//get customer by phone
Route::post('get-customer-by-phone',[FrontController::class,'getcustomer']);

//Admin
Route::get('admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

//After Admin login
Route::group(['middleware'=>'admin_auth'],function(){
    //Dashboard
    Route::get('admin/dashboard',[AdminController::class,'dashboard']);

    //Profile
    Route::get('admin/account',[AdminController::class,'account_controller']);
    Route::post('admin/password-change',[AdminController::class,'change_password']);

    //Self Order
    Route::get('admin/self-order',[SelfOrderController::class,'index']);
    Route::get('admin/self-order/update-cart-html',[SelfOrderController::class,'update_cart_html']);
    Route::post('admin/selforder',[SelfOrderController::class,'checkout']);

    //Category
    Route::get('admin/category',[CategoryController::class,'index']);
    Route::get('admin/category/manage_category',[CategoryController::class,'manage_category']);
    Route::get('admin/category/manage_category/{id}',[CategoryController::class,'manage_category']);
    Route::post('admin/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
    Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);
    Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);

    //Share place
    Route::get('admin/order-place',[shareController::class,'index']);
    Route::post('admin/order-place/save',[shareController::class,'store']);
    Route::get('admin/order-place/delete/{id}',[shareController::class,'delete']);


    //Size
    Route::get('admin/size',[SizeController::class,'index']);
    Route::get('admin/size/manage_size',[SizeController::class,'manage_size']);
    Route::get('admin/size/manage_size/{id}',[SizeController::class,'manage_size']);
    Route::post('admin/size/manage_size_process',[SizeController::class,'manage_size_process'])->name('size.manage_size_process');
    Route::get('admin/cousizepon/delete/{id}',[SizeController::class,'delete']);
    Route::get('admin/size/status/{status}/{id}',[SizeController::class,'status']);

    //Color
    Route::get('admin/color',[ColorController::class,'index']);
    Route::get('admin/color/manage_color',[ColorController::class,'manage_color']);
    Route::get('admin/color/manage_color/{id}',[ColorController::class,'manage_color']);
    Route::post('admin/color/manage_color_process',[ColorController::class,'manage_color_process'])->name('color.manage_color_process');
    Route::get('admin/color/delete/{id}',[ColorController::class,'delete']);
    Route::get('admin/color/status/{status}/{id}',[ColorController::class,'status']);

    //Product
    Route::get('admin/product',[ProductController::class,'index']);
    Route::get('admin/product/manage_product',[ProductController::class,'manage_product']);
    Route::get('admin/product/manage_product/{id}',[ProductController::class,'manage_product']);
    Route::post('admin/product/manage_producty_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process');
    Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
    Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);
    Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
    Route::get('admin/product/product_images_delete/{paid}/{pid}',[ProductController::class,'product_images_delete']);

    //Brand
    Route::get('admin/brand',[BrandController::class,'index']);
    Route::get('admin/brand/manage_brand',[BrandController::class,'manage_brand']);
    Route::get('admin/brand/manage_brand/{id}',[BrandController::class,'manage_brand']);
    Route::post('admin/brand/manage_brand_process',[BrandController::class,'manage_brand_process'])->name('brand.manage_brand_process');
    Route::get('admin/brand/delete/{id}',[BrandController::class,'delete']);
    Route::get('admin/brand/status/{status}/{id}',[BrandController::class,'status']);

    //Tax
    Route::get('admin/tax',[TaxController::class,'index']);
    Route::get('admin/tax/manage_tax',[TaxController::class,'manage_tax']);
    Route::get('admin/tax/manage_tax/{id}',[TaxController::class,'manage_tax']);
    Route::post('admin/tax/manage_tax_process',[TaxController::class,'manage_tax_process'])->name('tax.manage_tax_process');
    Route::get('admin/tax/delete/{id}',[TaxController::class,'delete']);
    Route::get('admin/tax/status/{status}/{id}',[TaxController::class,'status']);

    //users
    Route::get('admin/users',[CustomerController::class,'all_order_users']);

    //Website Settings
    Route::get('admin/website-settings',[SettingsController::class,'index']);
    Route::post('admin/website-settings/update',[SettingsController::class,'update'])->name('websitesetting.update');

    //Custom Code Settings
    Route::get('admin/custom-code',[SettingsController::class,'customcode']);
    Route::post('admin/custom-code/update',[SettingsController::class,'customcodeupdate'])->name('customcodesetting.update');

    //Home banner
    Route::get('admin/home_banner',[HomeBannerController::class,'index']);
    Route::get('admin/home_banner/manage_home_banner',[HomeBannerController::class,'manage_home_banner']);
    Route::get('admin/home_banner/manage_home_banner/{id}',[HomeBannerController::class,'manage_home_banner']);
    Route::post('admin/home_banner/manage_home_banner_process',[HomeBannerController::class,'manage_home_banner_process'])->name('home_banner.manage_home_banner_process');
    Route::get('admin/home_banner/delete/{id}',[HomeBannerController::class,'delete']);
    Route::get('admin/home_banner/status/{status}/{id}',[HomeBannerController::class,'status']);

    //Order
    Route::get('admin/order',[OrderController::class,'index']);
    Route::post('admin/update-order-status',[OrderController::class,'update_order_status']);
    Route::get('admin/order-detail/{id}',[OrderController::class,'order_detail']);
    Route::get('admin/order/edit/{id}',[OrderController::class,'order_edit']);
    Route::post('admin/order/update-save',[OrderController::class,'order_update_save']);
    Route::get('admin/order/delete/{id}',[OrderController::class,'delete_order']);
    Route::get('order-pdfview/{id}',[OrderController::class,'download_pdf']);
    Route::post('admin/order-qty-update',[OrderController::class,'order_qty_update']);
    Route::post('admin/order-price-update',[OrderController::class,'order_price_update']);

    //Logout
    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error','Logout sucessfully');
        return redirect('admin');
    });

});

//Other
Route::get('cache-clear', function () {
    \Artisan::call('optimize:clear');
    echo "cache clear done";
});
use Illuminate\Support\Facades\File;
Route::get('storage-link', function () {
    $storage_path = public_path('storage');
    if (!is_link($storage_path)) {
        \File::deleteDirectory($storage_path);
    }
    \Artisan::call('storage:link');
    \Artisan::call('optimize:clear');
    echo "=>storage link done";
});
