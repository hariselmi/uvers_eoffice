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
    Route::get('/', 'LandingController@index')->name('landing');

    Route::get('/articles_details/{id}', 'LandingController@articles_details')->name('articles_details');

    Route::get('/proses_bisnis_uvers', 'LandingController@proses_bisnis_uvers')->name('proses_bisnis_uvers');

    Route::get('/kebijakan_standar_uvers', 'LandingController@kebijakan_standar_uvers')->name('kebijakan_standar_uvers');

    Route::get('/standar_pendidikan_1', 'LandingController@standar_pendidikan_1')->name('standar_pendidikan_1');
    Route::get('/standar_pendidikan_2', 'LandingController@standar_pendidikan_2')->name('standar_pendidikan_2');
    Route::get('/standar_pendidikan_3', 'LandingController@standar_pendidikan_3')->name('standar_pendidikan_3');
    Route::get('/standar_pendidikan_4', 'LandingController@standar_pendidikan_4')->name('standar_pendidikan_4');
    Route::get('/standar_pendidikan_5', 'LandingController@standar_pendidikan_5')->name('standar_pendidikan_5');
    Route::get('/standar_pendidikan_6', 'LandingController@standar_pendidikan_6')->name('standar_pendidikan_6');
    Route::get('/standar_pendidikan_7', 'LandingController@standar_pendidikan_7')->name('standar_pendidikan_7');
    Route::get('/standar_pendidikan_8', 'LandingController@standar_pendidikan_8')->name('standar_pendidikan_8');

    Route::get('/standar_penelitian_1', 'LandingController@standar_penelitian_1')->name('standar_penelitian_1');
    Route::get('/standar_penelitian_2', 'LandingController@standar_penelitian_2')->name('standar_penelitian_2');
    Route::get('/standar_penelitian_3', 'LandingController@standar_penelitian_3')->name('standar_penelitian_3');
    Route::get('/standar_penelitian_4', 'LandingController@standar_penelitian_4')->name('standar_penelitian_4');
    Route::get('/standar_penelitian_5', 'LandingController@standar_penelitian_5')->name('standar_penelitian_5');
    Route::get('/standar_penelitian_6', 'LandingController@standar_penelitian_6')->name('standar_penelitian_6');
    Route::get('/standar_penelitian_7', 'LandingController@standar_penelitian_7')->name('standar_penelitian_7');
    Route::get('/standar_penelitian_8', 'LandingController@standar_penelitian_8')->name('standar_penelitian_8');

    Route::get('/standar_pengabdian_1', 'LandingController@standar_pengabdian_1')->name('standar_pengabdian_1');
    Route::get('/standar_pengabdian_2', 'LandingController@standar_pengabdian_2')->name('standar_pengabdian_2');
    Route::get('/standar_pengabdian_3', 'LandingController@standar_pengabdian_3')->name('standar_pengabdian_3');
    Route::get('/standar_pengabdian_4', 'LandingController@standar_pengabdian_4')->name('standar_pengabdian_4');
    Route::get('/standar_pengabdian_5', 'LandingController@standar_pengabdian_5')->name('standar_pengabdian_5');
    Route::get('/standar_pengabdian_6', 'LandingController@standar_pengabdian_6')->name('standar_pengabdian_6');
    Route::get('/standar_pengabdian_7', 'LandingController@standar_pengabdian_7')->name('standar_pengabdian_7');
    Route::get('/standar_pengabdian_8', 'LandingController@standar_pengabdian_8')->name('standar_pengabdian_8');


    Route::get('/sop_uvers_1', 'LandingController@sop_uvers_1')->name('sop_uvers_1');
    Route::get('/sop_uvers_2', 'LandingController@sop_uvers_2')->name('sop_uvers_2');
    Route::get('/sop_uvers_3', 'LandingController@sop_uvers_3')->name('sop_uvers_3');

   Route::get('/pembaruan_standar_mutu', 'LandingController@pembaruan_standar_mutu')->name('pembaruan_standar_mutu');
   Route::get('/agenda_kegiatan_lpm', 'LandingController@agenda_kegiatan_lpm')->name('agenda_kegiatan_lpm');
   Route::get('/pembaruan_standar_mutu_details', 'LandingController@pembaruan_standar_mutu_details')->name('pembaruan_standar_mutu_details');
   Route::get('/agenda_kegiatan_lpm_details', 'LandingController@agenda_kegiatan_lpm_details')->name('agenda_kegiatan_lpm_details');
    






    

    Auth::routes();


    Route::get('/home', 'HomeController@index')->name('home');
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
    Route::resource('standards', 'StandardController');
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

    Route::resource('flexiblepossetting', 'FlexiblePosSettingController');
    Route::post('/flexiblepossetting/add-payment-type', 'FlexiblePosSettingController@addPaymentType')->name('flexiblepossetting.payment_type');
    Route::post('/flexiblepossetting/store-settings', 'FlexiblePosSettingController@storeSettings')->name('flexiblepossetting.store_settings');
    Route::get('/flexiblepossetting/update-payment-type/{id}', 'FlexiblePosSettingController@updatePaymentType')->name('flexiblepossetting.payment_type.update');
});