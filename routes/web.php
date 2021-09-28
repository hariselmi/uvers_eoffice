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

Route::group(['middleware' => 'languange'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
 
    Auth::routes();

    Route::get('/set-role/{role}', 'HomeController@setRole')->name('setRole');

    Route::resource('customers', 'CustomerController');
    Route::get('customer/export', 'CustomerController@export')->name('customers.export');
    Route::post('customer/import', 'CustomerController@import')->name('customers.import');

    Route::resource('members', 'MemberController');
    Route::get('member/getmember/{id}', 'MemberController@getMember')->name('member.getMember');
    Route::get('members/getmembers/{id}', 'MemberController@getMembers')->name('member.getMembers');
    Route::resource('schedules', 'ScheduleController');


    Route::get('schedule/getstandarddetail/{id}', 'ScheduleController@getStandardDetail')->name('member.getStandardDetail');
    Route::post('schedule/getclockstart', 'ScheduleController@getclockstart')->name('schedule.getclockstart');
    Route::post('schedule/getclockstartedit', 'ScheduleController@getclockstartedit')->name('schedule.getclockstartedit');

    Route::post('home/period_filter', 'HomeController@period_filter')->name('home.period_filter');




    Route::resource('documents', 'DocumentController');
    Route::get('documents/{id}/print', 'DocumentController@print')->name('document.print');
    Route::resource('checklists', 'CheckListController');
    Route::get('checklists/{id}/print', 'CheckListController@print')->name('checklists.print');
    Route::resource('findings', 'FindingController');
    Route::get('findings/{id}/print', 'FindingController@print')->name('findings.print');
    Route::resource('reports', 'ReportsController');
    Route::get('reports/{id}/print', 'ReportsController@print')->name('reports.print');
    Route::resource('uploaddocuments', 'UploadDocumentController');
    Route::resource('reportalls', 'ReportAllController');
    Route::get('reportalls/{periode_id}/print', 'ReportAllController@print')->name('reportall.print');
    Route::get('uploaddocuments/{id}/print', 'UploadDocumentController@print')->name('uploaddocument.print');
    
    Route::resource('articles', 'ArticleController');
    Route::resource('sliders', 'SlidersController');
    Route::resource('pages', 'PagesController');


    //menu pengaturan
    Route::resource('jenis-surat', 'JenisSuratController');





    Route::resource('standarddetails', 'StandardDetailController');
    Route::resource('identity', 'IdentityController');
    Route::resource('division', 'DivisionController');
    Route::resource('period', 'PeriodController');

    Route::resource('agenda', 'AgendaController');
    Route::get('agenda/{periode_id}/print', 'AgendaController@print')->name('agenda.print');
    Route::resource('verification', 'VerificationController');
    Route::get('verification/{periode_id}/print', 'VerificationController@print')->name('verification.print');
    


    Route::resource('employees', 'EmployeeController');
    Route::post('/employees/assignroles', 'EmployeeController@assignRoles')->name('assign.roles');
    Route::post('/employeerole/create', 'EmployeeController@roleCreate')->name('employeerole.create');
    Route::get('/allpermissions/{role_id?}', 'EmployeeController@permissionList')->name('permissions.list');
    Route::post('permissions/create', 'EmployeeController@createPermission')->name('permissions.create');
    Route::post('permissionrole/create', 'EmployeeController@rolePermissionMapping')->name('permissionrole.create');

});