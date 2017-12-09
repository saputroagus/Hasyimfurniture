<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== Stores ================== */
	Route::resource(config('laraadmin.adminRoute') . '/stores', 'LA\StoresController');
	Route::get(config('laraadmin.adminRoute') . '/store_dt_ajax', 'LA\StoresController@dtajax');

	/* ================== Categories ================== */
	Route::resource(config('laraadmin.adminRoute') . '/categories', 'LA\CategoriesController');
	Route::get(config('laraadmin.adminRoute') . '/category_dt_ajax', 'LA\CategoriesController@dtajax');

	/* ================== Cats ================== */
	Route::resource(config('laraadmin.adminRoute') . '/cats', 'LA\CatsController');
	Route::get(config('laraadmin.adminRoute') . '/cat_dt_ajax', 'LA\CatsController@dtajax');

	/* ================== Products ================== */
	Route::resource(config('laraadmin.adminRoute') . '/products', 'LA\ProductsController');
	Route::get(config('laraadmin.adminRoute') . '/product_dt_ajax', 'LA\ProductsController@dtajax');

	/* ================== Woods ================== */
	Route::resource(config('laraadmin.adminRoute') . '/woods', 'LA\WoodsController');
	Route::get(config('laraadmin.adminRoute') . '/wood_dt_ajax', 'LA\WoodsController@dtajax');

	/* ================== Deliveries ================== */
	Route::resource(config('laraadmin.adminRoute') . '/deliveries', 'LA\DeliveriesController');
	Route::get(config('laraadmin.adminRoute') . '/delivery_dt_ajax', 'LA\DeliveriesController@dtajax');

	/* ================== Promos ================== */
	Route::resource(config('laraadmin.adminRoute') . '/promos', 'LA\PromosController');
	Route::get(config('laraadmin.adminRoute') . '/promo_dt_ajax', 'LA\PromosController@dtajax');

	/* ================== Promo_Products ================== */
	Route::resource(config('laraadmin.adminRoute') . '/promo_products', 'LA\Promo_ProductsController');
	Route::get(config('laraadmin.adminRoute') . '/promo_product_dt_ajax', 'LA\Promo_ProductsController@dtajax');

	/* ================== Orders ================== */
	Route::resource(config('laraadmin.adminRoute') . '/orders', 'LA\OrdersController');
	Route::get(config('laraadmin.adminRoute') . '/order_dt_ajax', 'LA\OrdersController@dtajax');
    Route::get(config('laraadmin.adminRoute') . '/order_dt_ajax2', 'LA\OrdersController@dtajax2');

	/* ================== Detail_Orders ================== */
	Route::resource(config('laraadmin.adminRoute') . '/detail_orders', 'LA\Detail_OrdersController');
	Route::get(config('laraadmin.adminRoute') . '/detail_order_dt_ajax', 'LA\Detail_OrdersController@dtajax');

	/* ================== Daily_Reports ================== */
	Route::resource(config('laraadmin.adminRoute') . '/daily_reports', 'LA\Daily_ReportsController');
	Route::get(config('laraadmin.adminRoute') . '/daily_report_dt_ajax', 'LA\Daily_ReportsController@dtajax');

	/* ================== Forecastings ================== */
	Route::resource(config('laraadmin.adminRoute') . '/forecastings', 'LA\ForecastingsController');
	Route::get(config('laraadmin.adminRoute') . '/forecasting_dt_ajax', 'LA\ForecastingsController@dtajax');

	/* ================== Values ================== */
	Route::resource(config('laraadmin.adminRoute') . '/values', 'LA\ValuesController');
	Route::get(config('laraadmin.adminRoute') . '/value_dt_ajax', 'LA\ValuesController@dtajax');
    Route::post(config('laraadmin.adminRoute') . '/values/ramal', 'LA\ValuesController@ramal');

	/* ================== Monthly_Reports ================== */
	Route::resource(config('laraadmin.adminRoute') . '/monthly_reports', 'LA\Monthly_ReportsController');
	Route::get(config('laraadmin.adminRoute') . '/monthly_report_dt_ajax/{tahun}/{bulan}', 'LA\Monthly_ReportsController@dtajax');
});
