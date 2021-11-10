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


    Route::get('/pegawai/getjabatan/{id}', 'PegawaiController@getJabatan')->name('pegawai.getJabatan');

    Route::get('/set-role/{role}', 'HomeController@setRole')->name('setRole');

    Route::get('schedule/getstandarddetail/{id}', 'ScheduleController@getStandardDetail')->name('member.getStandardDetail');
    Route::post('schedule/getclockstart', 'ScheduleController@getclockstart')->name('schedule.getclockstart');
    Route::post('schedule/getclockstartedit', 'ScheduleController@getclockstartedit')->name('schedule.getclockstartedit');

    Route::post('home/period_filter', 'HomeController@period_filter')->name('home.period_filter');


    // surat masuk
    Route::resource('surat-masuk', 'SuratMasukController');
    Route::get('surat-masuk/{id}/posisi', 'SuratMasukController@posisi')->name('surat-masuk.posisi');
    Route::get('surat-masuk/{id}/disposisi', 'SuratMasukController@disposisi')->name('surat-masuk.disposisi');
    Route::post('surat-masuk/store-disposisi', 'SuratMasukController@storeDisposisi')->name('surat-masuk.storeDisposisi');

    // surat keluar
    Route::resource('surat-keluar', 'SuratKeluarController');

    Route::get('surat-keluar/surat-keluar-validasi', 'SuratKeluarController@index');

    Route::get('surat-keluar/{id}/posisi', 'SuratKeluarController@posisi')->name('surat-keluar.posisi');
    Route::get('surat-keluar/{id}/disposisi', 'SuratKeluarController@disposisi')->name('surat-keluar.disposisi');
    Route::post('surat-keluar/store-disposisi', 'SuratKeluarController@storeDisposisi')->name('surat-keluar.storeDisposisi');

    // pelaporan eoffice
    Route::resource('pelaporan-eoffice', 'PelaporanEofficeController');
    Route::get('pelaporan-eoffice/{id}/laporan', 'PelaporanEofficeController@laporan')->name('pelaporan-eoffice.laporan');
    Route::post('pelaporan-eoffice/store-laporan', 'PelaporanEofficeController@storeLaporan')->name('pelaporan-eoffice.storeLaporan');

    Route::get('pelaporan-eoffice/{id}/validasi', 'PelaporanEofficeController@validasi')->name('pelaporan-eoffice.validasi');
    Route::post('pelaporan-eoffice/store-validasi', 'PelaporanEofficeController@storeValidasi')->name('pelaporan-eoffice.storeValidasi');

    // pelaporan eoffice
    Route::resource('pelaporan-eoffice-internal', 'PelaporanEofficeInternalController');
    Route::get('pelaporan-eoffice-internal/{id}/laporan', 'PelaporanEofficeInternalController@laporan')->name('pelaporan-eoffice-internal.laporan');
    Route::post('pelaporan-eoffice-internal/store-laporan', 'PelaporanEofficeInternalController@storeLaporan')->name('pelaporan-eoffice-internal.storeLaporan');

    Route::get('pelaporan-eoffice-internal/{id}/validasi', 'PelaporanEofficeInternalController@validasi')->name('pelaporan-eoffice-internal.validasi');
    Route::post('pelaporan-eoffice-internal/store-validasi', 'PelaporanEofficeInternalController@storeValidasi')->name('pelaporan-eoffice-internal.storeValidasi');


    // pelaporan repositori
    Route::resource('pelaporan-repositori', 'PelaporanRepositoriController');
    Route::resource('pelaporan-repositori-internal', 'PelaporanRepositoriInternalController');

    //menu pengaturan
    Route::resource('jenis-surat', 'JenisSuratController');
    Route::resource('sifat-surat', 'SifatSuratController');
    Route::resource('prioritas-surat', 'PrioritasSuratController');
    Route::resource('media-surat', 'MediaSuratController');
    Route::resource('perintah-disposisi', 'PerintahDisposisiController');


    //menu pengaturan
    Route::resource('unit-kerja', 'UnitKerjaController');
    Route::resource('jabatan', 'JabatanController');
    Route::resource('pegawai', 'PegawaiController');

    Route::resource('standarddetails', 'StandardDetailController');
    Route::resource('identity', 'IdentityController');
    


    Route::resource('employees', 'EmployeeController');
    Route::get('/useredit/{userid?}', 'EmployeeController@userEdit')->name('user.edit');
    Route::put('/useredit/{userid?}', 'EmployeeController@userUpdate')->name('user.update');
    Route::post('/employees/assignroles', 'EmployeeController@assignRoles')->name('assign.roles');
    Route::post('/employeerole/create', 'EmployeeController@roleCreate')->name('employeerole.create');
    Route::get('/allpermissions/{role_id?}', 'EmployeeController@permissionList')->name('permissions.list');
    Route::post('permissions/create', 'EmployeeController@createPermission')->name('permissions.create');
    Route::post('permissionrole/create', 'EmployeeController@rolePermissionMapping')->name('permissionrole.create');

});