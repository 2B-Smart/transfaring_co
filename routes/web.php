<?php

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

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
// Route::get('/system-management/{option}', 'SystemMgmtController@index');
Route::get('/profile', 'ProfileController@index');

Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
Route::resource('user-management', 'UserManagementController');

Route::post('drivers/search', 'DriversController@search')->name('drivers.search');
Route::resource('drivers', 'DriversController');

Route::post('cars/search', 'CarsController@search')->name('cars.search');
Route::resource('cars', 'CarsController');


Route::post('cities/search', 'CitiesController@search')->name('cities.search');
Route::resource('cities', 'CitiesController');

Route::post('customers/search', 'CustomersController@search')->name('customers.search');
Route::Post('customers/addrec', 'CustomersController@addrec')->name('customers.addrec');
Route::resource('customers', 'CustomersController');

Route::post('receipts/search', 'ReceiptsController@search')->name('receipts.search');
Route::get('receipts/view/{id}', 'ReceiptsController@view')->name('receipts.view');
Route::get('receipts/view/{id}', 'ReceiptsController@view')->name('receipts.view');
Route::resource('receipts', 'ReceiptsController');

Route::post('bills/search', 'BillsController@search')->name('bills.search');
Route::post('billlock/{id}', 'BillsController@billlock')->name('bills.billlock');
Route::get('bills/view/{id}', 'BillsController@view')->name('bills.view');
Route::Post('bills/addrec', 'BillsController@addrec')->name('bills.addrec');
Route::Post('bills/delrec/{id}', 'BillsController@delrec')->name('bills.delrec');
Route::resource('bills', 'BillsController');

Route::get('reports/bill_no_report/{id}', 'ReportsController@bill_no_report')->name('reports.bill_no_report');


//Route::resource('employee-management', 'EmployeeManagementController');
//Route::post('employee-management/search', 'EmployeeManagementController@search')->name('employee-management.search');
//
//Route::resource('system-management/department', 'DepartmentController');
//Route::post('system-management/department/search', 'DepartmentController@search')->name('department.search');
//
//Route::resource('system-management/division', 'DivisionController');
//Route::post('system-management/division/search', 'DivisionController@search')->name('division.search');
//
//Route::resource('system-management/country', 'CountryController');
//Route::post('system-management/country/search', 'CountryController@search')->name('country.search');
//
//Route::resource('system-management/state', 'StateController');
//Route::post('system-management/state/search', 'StateController@search')->name('state.search');
//


//Route::get('system-management/report', 'ReportController@index');
//Route::post('system-management/report/search', 'ReportController@search')->name('report.search');
//Route::post('system-management/report/excel', 'ReportController@exportExcel')->name('report.excel');
//Route::post('system-management/report/pdf', 'ReportController@exportPDF')->name('report.pdf');
//
//Route::get('avatars/{name}', 'EmployeeManagementController@load');
