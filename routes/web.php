<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\RunnerController;
use App\Http\Controllers\TerritoryController;
use Spatie\Backtrace\Backtrace;

/*  
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/allLogin', function () {
  return view('allLogin');
});

Route::get('/operation', function () {
  return view('auth.login');
});

Route::post('login', [AuthController::class, 'login']);
Route::get('logout', function () {
  Session::flush();
  Auth::logout();
  return redirect('/operation');
});


Route::get('user-logout', function () {
  Session::flush();
  Auth::logout();
  return redirect('/user-login');
});


Route::get('forget-password', [AuthController::class, 'forget_password']);
Route::post('forget-password', [AuthController::class, 'sendPasswordResetLink']);
Route::get('reset-password/{token}', [AuthController::class, 'create'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'store']);

Route::get('home',[UserController::class, 'index']);
Route::get('user-login',[UserController::class, 'login']);
Route::post('user-login',[UserController::class, 'user_login']);

Route::get('about',[UserController::class, 'about']);
Route::get('product',[UserController::class, 'product']);
Route::get('infrastructure',[UserController::class, 'infrastructure']);

Route::any('products', [UserController::class, 'products']);
Route::any('filter-products', [UserController::class, 'filter_products']);
Route::any('filter-products-auth', [UserController::class, 'filter_products_auth']);
Route::get('product/{id}', [UserController::class, 'product_details']);

Route::post('cart/add/', [UserController::class, 'cart']);
Route::any('users/total-carts', [UserController::class, 'total_carts']);
Route::get('deletecart/{id}', [UserController::class, 'cart_delete']);
Route::get('checkout', [UserController::class, 'checkout']);


Route::any('order-details/{id}', [UserController::class, 'orders_details']);

Route::any('my-account', [UserController::class, 'profile']);
Route::any('users/get-outlets', [UserController::class, 'get_outlets']);
Route::any('users/order-status', [UserController::class, 'check_order_status']);
Route::any('users/create-orders', [UserController::class, 'create_order']);

Route::get('about', [UserController::class, 'about']);
Route::get('contact', [UserController::class, 'contact']);
Route::post('contact', [UserController::class, 'contact_submit']);
Route::get('forget-password', [UserController::class, 'forgetpassword']);
Route::post('forgetpassword', [UserController::class, 'forget_password']);

Route::group(['middleware' => ['VerifySuperadmin'],'prefix' => 'superadmin'], function () {
  // ...............Admin Route..............
  Route::get('logout', function () {
    Session::flush();
    Auth::logout();
    return redirect('admin/login');
  });
  Route::get('/login', function () {
    return view('auth.login');
  });

  Route::post('login', [AuthController::class, 'login']);
  Route::get('dashboard', [SuperAdminController::class, 'index']);

  Route::get('users', [SuperAdminController::class, 'users']);
  Route::get('add-users', [SuperAdminController::class, 'create_users']);
  Route::post('add-users', [SuperAdminController::class, 'save_users']);
  Route::get('edit-users/{email}', [SuperAdminController::class, 'edit_users']);
  Route::post('edit-users/{email}', [SuperAdminController::class, 'update_users']);
  Route::any('delete-users/{id}', [SuperAdminController::class, 'delete_users']);

  Route::get('customers', [SuperAdminController::class, 'customers']);
  Route::get('add-customers', [SuperAdminController::class, 'create_customers']);
  Route::post('add-customers', [SuperAdminController::class, 'save_customers']);
  Route::get('edit-customers/{email}', [SuperAdminController::class, 'edit_customers']);
  Route::post('edit-customers/{email}', [SuperAdminController::class, 'update_customers']); 
  Route::any('delete-customers/{email}', [SuperAdminController::class, 'delete_customers']);
  Route::any('discount-customers/{email}', [SuperAdminController::class, 'discount_customers']);
  Route::any('get-outlets', [SuperAdminController::class, 'get_outlets_with_discount']);
  Route::get('/customerdetails/{email}', [SuperAdminController::class, 'customerdetails']);

  Route::get('coupons', [SuperAdminController::class, 'coupons']);
  Route::get('add-coupon', [SuperAdminController::class, 'create_coupon']);
  Route::post('add-coupon', [SuperAdminController::class, 'save_coupon']);
  Route::get('edit-coupon/{id}', [SuperAdminController::class, 'edit_coupon']);
  Route::post('edit-coupon/{id}', [SuperAdminController::class, 'update_coupon']);
  Route::any('delete-coupon/{id}', [SuperAdminController::class, 'delete_coupon']);

  Route::get('category', [SuperAdminController::class, 'category']);
  Route::get('add-category', [SuperAdminController::class, 'create_category']);
  Route::post('add-category', [SuperAdminController::class, 'save_category']);
  Route::get('edit-category/{id}', [SuperAdminController::class, 'edit_category']);
  Route::post('edit-category/{id}', [SuperAdminController::class, 'update_category']);
  Route::any('delete-category/{id}', [SuperAdminController::class, 'delete_category']);

  Route::get('products', [SuperAdminController::class, 'products']);
  Route::get('add-product', [SuperAdminController::class, 'create_product']);
  Route::post('add-product', [SuperAdminController::class, 'save_product']);
  Route::get('edit-product/{id}', [SuperAdminController::class, 'edit_product']);
  Route::post('edit-product/{id}', [SuperAdminController::class, 'update_product']);
  Route::any('delete-product/{id}', [SuperAdminController::class, 'delete_product']);
  Route::any('product-details/{id}', [SuperAdminController::class, 'product_details']);
  Route::any('filter-products', [SuperAdminController::class, 'filter_products']);

  Route::any('orders', [SuperAdminController::class, 'orders']);
  Route::any('fetch-products', [SuperAdminController::class, 'fetch_products']);
  Route::any('fetch-user-details', [SuperAdminController::class, 'fetch_user_details']);
  Route::any('edit-orders/{id}', [SuperAdminController::class, 'edit_orders']);
  Route::any('delete-orders/{id}', [SuperAdminController::class, 'delete_orders']);
  Route::any('orders-details/{id}', [SuperAdminController::class, 'orders_details']);
  Route::any('filter-orders', [SuperAdminController::class, 'filter_orders']);

  Route::any('correction', [SuperAdminController::class, 'correction']);
  Route::any('correctiondetails/{email}', [SuperAdminController::class, 'correctiondetails']);
  Route::any('carts', [SuperAdminController::class, 'carts']);
  Route::any('fetch-carts', [SuperAdminController::class, 'fetch_carts']);

  Route::post('add-to-carts', [SuperAdminController::class, 'add_to_carts']);
  Route::post('delete-carts', [SuperAdminController::class, 'delete_carts']);
  Route::any('total-carts', [SuperAdminController::class, 'total_carts']);

  Route::any('cartsdata', [SuperAdminController::class, 'fetch_carts']);
  Route::any('create-orders', [SuperAdminController::class, 'create_order']);
  Route::post('filter-correction', [SuperAdminController::class, 'filtercorrection']);
  Route::post('filter-roles', [SuperAdminController::class, 'filterroles']);
  Route::post('filter-city', [SuperAdminController::class, 'filter_city']);

  
  Route::any('check-fda-number', [SuperAdminController::class, 'validateFDANumber']);
  Route::any('check-gst-number', [SuperAdminController::class, 'verifyGSTNumber']);

  Route::get('/invoice/{id}',[SuperAdminController::class,'invoice']);
  Route::get('/generate_pdf/{id}', [SuperAdminController::class, 'generatePDF']);

  Route::get('product-availability', [SuperAdminController::class, 'product_availability']);
  Route::any('add-product-availability', [SuperAdminController::class, 'add_product_availability']);
  Route::any('edit-product-availability/{id}', [SuperAdminController::class, 'edit_product_availability']);
  Route::get('delete-product-availability/{id}', [SuperAdminController::class, 'delete_product_availability']);

  Route::post('/importpincode',[SuperAdminController::class,'importpincode']); 
  Route::get('/exportpincode',[SuperAdminController::class,'exportpincode']);
  Route::get('/report',[SuperAdminController::class,'report']);
  Route::post('/filter-sales',[SuperAdminController::class,'filter_sales']);

  Route::get('get-fda-licence',[SuperAdminController::class,'checkFdaLicenceExpiry']);
  Route::post('changestatus/{email}',[SuperAdminController::class,'changestatus']);
  Route::get('/salesexport',[SuperAdminController::class,'salesexport']);

  Route::any('warehouse',[SuperAdminController::class,'warehouse']);
  Route::any('filter-warehouse',[SuperAdminController::class,'filter_warehouse']);
  Route::post('filter-product_id',[SuperAdminController::class,'filter_product_id']);
  Route::any('inventory-details/{id}',[SuperAdminController::class,'inventory_details']);

 
  Route::post('/import',[SuperAdminController::class, 'import'])->name('importsuperadmin'); 
  Route::get('/export-users',[SuperAdminController::class, 'exportUsers'])->name('exportsuperadmin');
  Route::get('/truncateproduct',[SuperAdminController::class,'truncateproduct']);
  Route::post('/vehiclesimport',[SuperAdminController::class,'vehiclesimport']); 
  Route::get('/vehiclesexport',[SuperAdminController::class,'vehiclesexport']);

  Route::post('/rolesimport',[SuperAdminController::class,'rolesimport']); 
  Route::get('/rolesexport',[SuperAdminController::class,'rolesexport']);
  
  Route::post('/importcustomers',[SuperAdminController::class,'importcustomers']); 
  Route::get('/exportcustomers',[SuperAdminController::class,'exportcustomers']);

  Route::post('/outletsimport',[SuperAdminController::class,'outletsimport']); 
  Route::get('/outletsexport',[SuperAdminController::class,'outletsexport']);

  Route::post('/discountimport',[SuperAdminController::class,'discountimport']); 
  Route::get('/discountexport',[SuperAdminController::class,'discountexport']);

  Route::post('/fetch-sub-categories',[SuperAdminController::class,'fetch_sub_categories']);


 
});
Route::group(['middleware' => ['VerifyAdmin'],'prefix' => 'admin'], function () {

  Route::any('correctiondetails/{email}', [AdminController::class, 'correctiondetails']);

  Route::get('customers', [AdminController::class, 'customers']);
  Route::get('add-customers', [AdminController::class, 'create_customers']);
  Route::post('add-customers', [AdminController::class, 'save_customers']);
  Route::get('edit-customers/{email}', [AdminController::class, 'edit_customers']);
  Route::post('edit-customers/{email}', [AdminController::class, 'update_customers']);
  Route::any('delete-customers/{email}', [AdminController::class, 'delete_customers']);
  Route::any('discount-customers/{email}', [AdminController::class, 'discount_customers']);
  Route::any('get-outlets', [AdminController::class, 'get_outlets_with_discount']);
  Route::get('/customerdetails/{email}', [AdminController::class, 'customerdetails']);

  Route::any('orders', [AdminController::class, 'orders']);
  Route::any('fetch-products', [AdminController::class, 'fetch_products']);
  Route::any('fetch-user-details', [AdminController::class, 'fetch_user_details']);
  Route::any('create-orders', [AdminController::class, 'create_order']);
  Route::any('edit-orders/{order_id}', [AdminController::class, 'edit_orders']);
  Route::any('delete-orders/{id}', [AdminController::class, 'delete_orders']);
  Route::any('orders-details/{id}', [AdminController::class, 'orders_details']);
  Route::post('filter-orders', [AdminController::class, 'filter_orders']);

  Route::get('vehicle', [AdminController::class, 'vehicle']);
  Route::get('addVehicle', [AdminController::class, 'addVehicle']);
  Route::post('addvehicle', [AdminController::class, 'savevehicle']);

  Route::get('products', [AdminController::class, 'products']);
  Route::get('add-product', [AdminController::class, 'create_product']);
  Route::post('add-product', [AdminController::class, 'save_product']);
  Route::get('edit-product/{id}', [AdminController::class, 'edit_product']);
  Route::post('edit-product/{id}', [AdminController::class, 'update_product']);
  Route::any('delete-product/{id}', [AdminController::class, 'delete_product']);
  Route::any('product-details/{id}', [AdminController::class, 'product_details']);
  Route::any('filter-products', [AdminController::class, 'filter_products']);

  Route::get('category', [AdminController::class, 'category']);
  Route::any('add-category', [AdminController::class, 'create_category']);
  Route::any('edit-category/{id}', [AdminController::class, 'edit_category']);
  Route::any('delete-category/{id}', [AdminController::class, 'delete_category']);

  Route::get('users', [AdminController::class, 'users']);
  Route::get('add-users', [AdminController::class, 'create_users']);
  Route::post('add-users', [AdminController::class, 'save_users']);
  Route::any('edit-users/{id}', [AdminController::class, 'edit_users']);
  Route::any('delete-users/{id}', [AdminController::class, 'delete_users']);

  Route::post('filter-roles', [AdminController::class, 'filterroles']);
  Route::any('/fetch-warename', [AdminController::class, 'fetch_warename']);
  Route::post('filter-correction', [AdminController::class, 'filtercorrection']);

  Route::get('correction', [AdminController::class, 'correction']);
  Route::any('correctiondetails/{email}', [AdminController::class, 'correctiondetails']);
  Route::post('changestatus/{email}',[AdminController::class,'changestatus']);

  Route::any('carts', [AdminController::class, 'carts']);
  Route::post('add-to-carts', [AdminController::class, 'add_to_carts']);
  Route::post('delete-carts', [AdminController::class, 'delete_carts']);
  Route::any('total-carts', [AdminController::class, 'total_carts']);

  Route::get('product-availability', [AdminController::class, 'product_availability']);
  Route::any('add-product-availability', [AdminController::class, 'add_product_availability']);
  Route::any('edit-product-availability/{id}', [AdminController::class, 'edit_product_availability']);
  Route::get('delete-product-availability/{id}', [AdminController::class, 'delete_product_availability']);
  Route::post('filter-city', [AdminController::class, 'filter_city']);

  Route::post('/fetch-sub-categories',[AdminController::class,'fetch_sub_categories']);


  Route::any('warehouse',[AdminController::class,'warehouse']);
  Route::any('filter-warehouse',[AdminController::class,'filter_warehouse']);
  Route::post('filter-product_id',[AdminController::class,'filter_product_id']);
  Route::any('inventory-details/{id}',[AdminController::class,'inventory_details']);

 


  Route::post('/importproductavailabilty',[AdminController::class,'importproductavailabilty']); 
  Route::get('/exportproductavailabilty',[AdminController::class,'exportproductavailabilty']);
  Route::get('/invoice/{id}',[AdminController::class,'invoice']);
  Route::post('filter-pincode', [SuperAdminController::class, 'filterpincode']);
  Route::get('/generate_pdf/{id}', [AdminController::class, 'generatePDF']);

  Route::post('/import',[AdminController::class, 'import'])->name('importadmin'); 
  Route::get('/export-users',[AdminController::class, 'exportUsers'])->name('exportadmin');
  Route::get('/truncateproduct',[AdminController::class,'truncateproduct']);
  Route::post('/vehiclesimport',[AdminController::class,'vehiclesimport']); 
  Route::get('/vehiclesexport',[AdminController::class,'vehiclesexport']);

  Route::post('/rolesimport',[AdminController::class,'rolesimport']); 
  Route::get('/rolesexport',[AdminController::class,'rolesexport']);
  
  Route::post('/importcustomers',[AdminController::class,'importcustomers']); 
  Route::get('/exportcustomers',[AdminController::class,'exportcustomers']);

  Route::post('/outletsimport',[AdminController::class,'outletsimport']); 
  Route::get('/outletsexport',[AdminController::class,'outletsexport']);

  Route::post('/discountimport',[AdminController::class,'discountimport']); 
  Route::get('/discountexport',[AdminController::class,'discountexport']);

  Route::any('check-fda-number', [AdminController::class, 'validateFDANumber']);
  Route::any('check-gst-number', [AdminController::class, 'verifyGSTNumber']);
});

//...............Warehouse Route..............
Route::group(['middleware' => ['VerifyWarehouse'], 'prefix' => 'warehouse'], function () {

  Route::get('reeivedorders', [WarehouseController::class, 'index']);
  Route::get('runner', [WarehouseController::class, 'runner']);
  Route::get('vehicle', [WarehouseController::class, 'vehicle']);
  Route::get('/addvehicle', [WarehouseController::class, 'addvehicle']);
  Route::post('/addvehicle', [WarehouseController::class, 'savevehicle']);
  Route::get('deliverylist', [WarehouseController::class, 'deliverylist']);
  Route::get('orderdetails', [WarehouseController::class, 'orderdetails']);
  Route::get('addrunner', [WarehouseController::class, 'addrunner']);
  Route::post('addrunner', [WarehouseController::class, 'saverunner']);
  Route::get('delivery-order-details/{id}', [WarehouseController::class, 'delivery_order_details']);
  Route::any('orders-details/{id}', [WarehouseController::class, 'orders_details']);
  Route::any('filter-orders', [WarehouseController::class, 'filter_orders']);
  Route::post('changestatus/{id}', [WarehouseController::class, 'changestatus']);
  Route::post('send-to-runner', [WarehouseController::class, 'send_to_runner']);
  Route::get('receivedGoods', [WarehouseController::class, 'receivedGoods']);
  Route::get('showpdf/{purchase_id}',[WarehouseController::class,'showpdf']);
  Route::get('purchaseorderdetails/{purchase_id}',[WarehouseController::class,'purchaseorderdetails']);
  Route::post('edit-batch/{id}',[WarehouseController::class,'edit_batch']);
  Route::post('add-grn/{purchase_id}',[WarehouseController::class,'add_grn']);
  Route::post('add-maingrn/{purchase_id}',[WarehouseController::class,'add_maingrn']);
  Route::post('update-received/',[WarehouseController::class,'update_received']);
  Route::post('update-no/',[WarehouseController::class,'update_no']);
  Route::get('inventory', [WarehouseController::class, 'stocks']);
  Route::get('inventory-details/{id}', [WarehouseController::class, 'stocks_details']);
  Route::any('upgrade-inventory', [WarehouseController::class, 'upgrade_inventory']);
  Route::any('filter-inventory', [WarehouseController::class, 'filter_stocks']);
  Route::get('/invoice/{id}',[WarehouseController::class,'invoice']);
  Route::get('/generate_pdf/{id}', [WarehouseController::class, 'generatePDF']);

  Route::post('/updateqty/{id}',[WarehouseController::class,'updateqty']);
  Route::post('/updatebatch/{id}',[WarehouseController::class,'updatebatch']);

  Route::post('/add-multiple-batch/{id}',[WarehouseController::class,'add_multiple_batch']);
  Route::post('/update-multiple-batch/{id}',[WarehouseController::class,'update_multiple_batch']);
  Route::post('/batchdelete', [WarehouseController::class, 'batchdelete']);
  Route::get('/addmultiprodbatch/{id}', [WarehouseController::class, 'addmultiprodbatch']);
  Route::get('/editmultiprodbatch/{id}', [WarehouseController::class, 'editmultiprodbatch']);
});

 
//...............Backoffice Route..............
Route::group(['middleware' => ['VerifyBackoffice'], 'prefix' => 'backoffice'], function () {


  Route::get('customers', [BackofficeController::class, 'customers']);
  Route::get('add-customers', [BackofficeController::class, 'create_customers']);
  Route::post('add-customers', [BackofficeController::class, 'save_customers']);
  Route::get('edit-customers/{email}', [BackofficeController::class, 'edit_customers']);
  Route::post('edit-customers/{email}', [BackofficeController::class, 'update_customers']);
  Route::any('delete-customers/{email}', [BackofficeController::class, 'delete_customers']);
  Route::any('discount-customers/{email}', [BackofficeController::class, 'discount_customers']);
  Route::any('get-outlets', [BackofficeController::class, 'get_outlets_with_discount']);

  Route::any('carts', [BackofficeController::class, 'carts']);
  Route::any('total-carts', [BackofficeController::class, 'total_carts']);
  Route::post('add-to-carts', [BackofficeController::class, 'add_to_carts']);
  Route::any('create-orders', [BackofficeController::class, 'create_order']);
  Route::post('delete-carts', [BackofficeController::class, 'delete_carts']);

  Route::any('orders', [BackofficeController::class, 'orders']);
  Route::any('fetch-products', [BackofficeController::class, 'fetch_products']);
  Route::any('fetch-user-details', [BackofficeController::class, 'fetch_user_details']);
  Route::any('edit-orders/{id}', [BackofficeController::class, 'edit_orders']);
  Route::any('delete-orders/{id}', [BackofficeController::class, 'delete_orders']);
  Route::any('orders-details/{id}', [BackofficeController::class, 'orders_details']);
  Route::any('filter-orders', [BackofficeController::class, 'filter_orders']);

  Route::get('products', [BackofficeController::class, 'products']);
  Route::get('add-product', [BackofficeController::class, 'create_product']);
  Route::post('add-product', [BackofficeController::class, 'save_product']);
  Route::get('edit-product/{id}', [BackofficeController::class, 'edit_product']);
  Route::post('edit-product/{id}', [BackofficeController::class, 'update_product']);
  Route::any('delete-product/{id}', [BackofficeController::class, 'delete_product']);
  Route::any('product-details/{id}', [BackofficeController::class, 'product_details']);
  Route::any('filter-products', [BackofficeController::class, 'filter_products']);

  Route::get('category', [BackofficeController::class, 'category']);
  Route::get('add-category', [BackofficeController::class, 'create_category']);
  Route::post('add-category', [BackofficeController::class, 'save_category']);
  Route::get('edit-category/{id}', [BackofficeController::class, 'edit_category']);
  Route::post('edit-category/{id}', [BackofficeController::class, 'update_category']);
  Route::any('delete-category/{id}', [BackofficeController::class, 'delete_category']);

  Route::get('/vehicle', [BackofficeController::class, 'vehicle']);
  Route::get('/addvehicle', [BackofficeController::class, 'addvehicle']);
  Route::post('/addvehicle', [BackofficeController::class, 'savevehicle']);

  Route::get('/roles', [BackofficeController::class, 'roles']);
  Route::get('/addroles', [BackofficeController::class, 'addroles']);
  Route::post('/addroles', [BackofficeController::class, 'saveroles']);

  Route::get('/customerdetails/{email}', [BackofficeController::class, 'customerdetails']);
  Route::get('/correction', [BackofficeController::class, 'correction']);

  Route::get('/customerapproval/{email}', [BackofficeController::class, 'customerapproval']);
  Route::post('/changestatus/{email}', [BackofficeController::class, 'changestatus']);
  Route::any('/fetch-warename', [BackofficeController::class, 'fetch_warename']);
  Route::get('/search', [BackofficeController::class, 'search']);
  Route::post('filter-roles', [BackofficeController::class, 'filterroles']);

  Route::post('/fetch-sub-categories',[BackofficeController::class,'fetch_sub_categories']);
  Route::any('check-fda-number', [BackofficeController::class, 'validateFDANumber']);
  Route::any('check-gst-number', [BackofficeController::class, 'verifyGSTNumber']);
///--------------------Excel File upload------------------------------------------------------------>
  Route::get('/file-import',[BackofficeController::class,
    'importView'])->name('import-view'); 
  Route::post('/import',[BackofficeController::class,
    'import'])->name('import'); 
  Route::get('/export-users',[BackofficeController::class,
    'exportUsers'])->name('export');

  Route::get('/truncateproduct',[BackofficeController::class,'truncateproduct']);

  Route::post('/vehiclesimport',[BackofficeController::class,'vehiclesimport']); 
  Route::get('/vehiclesexport',[BackofficeController::class,'vehiclesexport']);

  Route::post('/rolesimport',[BackofficeController::class,'rolesimport']); 
  Route::get('/rolesexport',[BackofficeController::class,'rolesexport']);
  
  Route::post('/importcustomers',[BackofficeController::class,'importcustomers']); 
  Route::get('/exportcustomers',[BackofficeController::class,'exportcustomers']);

  Route::post('/outletsimport',[BackofficeController::class,'outletsimport']); 
  Route::get('/outletsexport',[BackofficeController::class,'outletsexport']);

  Route::post('/discountimport',[BackofficeController::class,'discountimport']); 
  Route::get('/discountexport',[BackofficeController::class,'discountexport']);

  Route::get('/invoice/{id}',[BackofficeController::class,'invoice']);
  Route::get('/generate_pdf/{id}', [BackofficeController::class, 'generatePDF']);  
  Route::get('get-fda-licence',[BackofficeController::class,'checkFdaLicenceExpiry']);


  Route::get('purchaseorders',[BackofficeController::class,'purchaseorders']);
  Route::get('add-purchase',[BackofficeController::class,'addpurchase']); 
  Route::post('add-purchaseorder',[BackofficeController::class,'addpurchaseorder']);
  Route::get('edit-purchaseorders/{id}',[BackofficeController::class,'edit_purchaseorders']);
  Route::post('edit-purchaseorders/{purchase_id}',[BackofficeController::class,'update_purchaseorders']);
  Route::get('delete-purchaseorders/{purchase_id}',[BackofficeController::class,'delete_purchaseorders']);
  Route::post('upload-invoice/{purchase_id}',[BackofficeController::class,'upload_invoice']);
  Route::get('purchaseorderdetails/{purchase_id}',[BackofficeController::class,'purchaseorderdetails']);
  Route::post('getproductdetails',[BackofficeController::class,'get_product_details']);
  Route::get('showpdf/{purchase_id}',[BackofficeController::class,'showpdf']);
  Route::get('getproduct',[BackofficeController::class,'getproduct']);
  Route::post('remarks',[BackofficeController::class, 'remarks']);
});


//...............Runner Route..............
Route::group(['middleware' => ['VerifyRunner']], function () {
  Route::post('runner/login', [RunnerController::class, 'runnerLogin']);
  Route::get('runner/order', [RunnerController::class, 'index']);
  Route::get('runner/orderDetails', [RunnerController::class, 'orderDetails']);
  Route::any('runner/orders-details/{id}', [RunnerController::class, 'orders_details']);
  Route::post('runner/changestatus', [RunnerController::class, 'verifyContact']);
  Route::post('runner/sendOTP',[RunnerController::class, 'store']);
  Route::post('runner/remarks',[RunnerController::class, 'remarks']);
});


//...............Territory Route..............
Route::group(['middleware' => ['VerifyTerriory']], function () {

  Route::get('territory/orders', [TerritoryController::class, 'index']);
  Route::get('territory/correction', [TerritoryController::class, 'correction']);
  Route::get('territory/listofrm', [TerritoryController::class, 'listofrm']);
  Route::get('territory/productforOrder', [TerritoryController::class, 'productforOrder']);
  Route::get('territory/product-details/{id}', [TerritoryController::class, 'productDetails']);
  Route::get('territory/orders-details/{id}', [TerritoryController::class, 'orderDetails']);
  Route::get('territory/customerapproval/{email}', [TerritoryController::class, 'customerapproval']);
  Route::post('territory/changestatus/{email}', [TerritoryController::class, 'changestatus']);
  Route::any('territory/filter-orders', [TerritoryController::class, 'filter_orders']);
  Route::post('territory/add-to-carts', [TerritoryController::class, 'add_to_carts']);
  Route::any('territory/total-carts', [TerritoryController::class, 'total_carts']);
  Route::any('territory/carts', [TerritoryController::class, 'carts']);
});


// ...............Relationship Route..............
Route::group(['middleware' => ['VerifyRelationship']], function () {

  Route::get('relation/orders', [RelationshipController::class, 'index']);
  Route::get('relation/orders-details/{id}', [RelationshipController::class, 'orderdetails']);
  Route::get('relation/customer', [RelationshipController::class, 'customer']);
  Route::get('relation/filter-status/status={status}', [RelationshipController::class, 'filter_status']);
  Route::any('relation/filter-orders', [RelationshipController::class, 'filter_orders']);

});


// ...............Inventory Route..............
Route::group(['prefix' => 'inventory'], function () {

  Route::get('orders', [InventoryController::class, 'orders']);
  Route::get('stocks', [InventoryController::class, 'stocks']);
  Route::any('upgrade-stocks', [InventoryController::class, 'upgrade_stocks']);
  Route::any('filter-stocks', [InventoryController::class, 'filter_stocks']);


});

Route::group(['middleware' => ['VerifyHR'], 'prefix' => 'hr'], function () {
  Route::get('roles', [HRController::class, 'roles']);
  Route::get('add-users', [HRController::class, 'create_users']);
  Route::post('add-users', [HRController::class, 'save_users']);
  Route::get('edit-users/{email}', [HRController::class, 'edit_users']);
  Route::post('edit-users/{email}', [HRController::class, 'update_users']);
  Route::any('delete-users/{id}', [HRController::class, 'delete_users']);
  Route::post('filter-roles', [HRController::class, 'filterroles']);

});



