<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;

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
//Auth::routes();
Route::get('/', [HomeController::class,'index'])->middleware('auth');
//Route::post('/home', [HomeController::class,'index'])->name('login');
Route::get('/home', [HomeController::class,'index'])->middleware('auth');
Route::get('/base', [BaseController::class,'base'])->middleware('auth');

Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login'); // view は auth.login
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');


// 新規作成・更新修正 
Route::get('/edit', [EditController::class,'index'])->middleware('auth');
Route::get('/edit/make', [EditController::class,'make'])->middleware('auth');
Route::get('/edit/fix', [EditController::class,'fix'])->middleware('auth');
Route::post('/edit/get', [EditController::class,'getData'])->middleware('auth');
Route::post('/edit/getone', [EditController::class,'getDataOne'])->middleware('auth');
Route::post('/edit/update', [EditController::class,'fix'])->middleware('auth');
Route::post('/edit/insert', [EditController::class,'store'])->middleware('auth');

// 検索
Route::get('/search', [SearchController::class,'search'])->middleware('auth');
Route::post('/search/get', [SearchController::class,'getDataSearch'])->middleware('auth');

// マスター
Route::get('/master_company', [MasterCompanyController::class,'index'])->middleware('auth');
Route::post('/master_company/update', [MasterCompanyController::class,'fix'])->middleware('auth');
Route::get('/master_office', [MasterOfficeController::class,'index'])->middleware('auth');
Route::post('/master_office/update', [MasterOfficeController::class,'fix'])->middleware('auth');
Route::post('/master_office/insert', [MasterOfficeController::class,'store'])->middleware('auth');




// 印刷
Route::get('/print', [PrintController::class,'index'])->middleware('auth');
Route::post('/print/get', [PrintController::class,'getSeaDetail'])->middleware('auth');



// 管理
Route::get('/maintenance/backup', [BackupLogsController::class,'index'])->middleware('auth');
Route::get('/pwmake', [AdminController::class,'pwmake'])->middleware('auth');
Route::post('/pwmake', [AdminController::class,'pwmake'])->middleware('auth');

