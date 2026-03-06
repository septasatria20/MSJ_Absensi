<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TrstukController;
use App\Http\Controllers\TrsspController;
use App\Http\Controllers\TrspulController;

// Test route for Tukar Jadwal Karyawan List (Autocomplete)
Route::get('/test-trstuk-karyawan', function () {
	$controller = new TrstukController();
	$data = [];
	$response = $controller->getkaryawan($data);
	return $response;
});

// Test route to check Pull Finger menu
Route::get('/test-menu', function () {
	$gmenu = DB::table('sys_gmenu')->where('gmenu', 'transc')->first();
	$dmenu = DB::table('sys_dmenu')->where(['gmenu' => 'transc', 'dmenu' => 'trspul'])->first();
	$auth = DB::table('sys_auth')->where(['gmenu' => 'transc', 'dmenu' => 'trspul', 'idroles' => 'hr'])->first();
	$allTransc = DB::table('sys_dmenu')->where('gmenu', 'transc')->get();
	
	return response()->json([
		'gmenu' => $gmenu,
		'dmenu' => $dmenu,
		'auth' => $auth,
		'all_transc_menu' => $allTransc
	]);
});

// Fix Pull Finger permissions
Route::get('/fix-pull-finger-auth', function () {
	$updated = DB::table('sys_auth')
		->where('gmenu', 'transc')
		->where('dmenu', 'trspul')
		->update([
			'add' => '1',
			'edit' => '1',
			'delete' => '1',
			'approval' => '1',
			'print' => '1',
			'excel' => '1',
			'pdf' => '1',
			'rules' => '1',
			'isactive' => '1'
		]);
	
	$auth = DB::table('sys_auth')->where(['gmenu' => 'transc', 'dmenu' => 'trspul'])->get();
	
	return response()->json([
		'success' => true,
		'updated_count' => $updated,
		'auth_records' => $auth,
		'message' => 'Pull Finger authorization updated successfully!'
	]);
});

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/auth/{token}', [LoginController::class, 'auth'])->name('auth');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/profile', [PageController::class, 'profile'])->name('profile'); //view profile
	Route::post('/profile/update', [PageController::class, 'update'])->name('profile.update'); //update profle
	Route::get('/changepass', [PageController::class, 'changepass'])->name('changepass'); //view change password
	Route::post('/changepass/update', [PageController::class, 'changepass_update'])->name('changepass.update'); //update password
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
	
	// Tukar Jadwal - AJAX Routes (must be before catch-all)
	Route::get('/trstuk/getkaryawan', [TrstukController::class, 'getkaryawan'])->name('trstuk.getkaryawan');
	Route::get('/trstuk/ajax', [TrstukController::class, 'ajax'])->name('trstuk.ajax');
	Route::post('/trstuk/store', [TrstukController::class, 'store'])->name('trstuk.store');
	Route::post('/trstuk/approval', [TrstukController::class, 'approval'])->name('trstuk.approval');
	
	// Pull Finger - AJAX Routes (must be before catch-all)
	Route::get('/trspul/ajax', [TrspulController::class, 'ajax'])->name('trspul.ajax');
	Route::get('/trspul/summary', [TrspulController::class, 'summary'])->name('trspul.summary');
	Route::get('/trspul/detail', [TrspulController::class, 'detail'])->name('trspul.detail');
	Route::post('/trspul/konfirmasi', [TrspulController::class, 'konfirmasi'])->name('trspul.konfirmasi');
	Route::post('/trspul/pulldevice', [TrspulController::class, 'pulldevice'])->name('trspul.pulldevice');
	
	// Kirim SP - AJAX Routes (must be before catch-all)
	Route::get('/trssp/getkaryawan', [TrsspController::class, 'getkaryawan'])->name('trssp.getkaryawan');
	Route::get('/trssp/ajax', [TrsspController::class, 'ajax'])->name('trssp.ajax');
	Route::post('/trssp/updatesp', [TrsspController::class, 'updatesp'])->name('trssp.updatesp');
	Route::post('/trssp/cetaksp', [TrsspController::class, 'cetaksp'])->name('trssp.cetaksp');
	Route::post('/trssp/hubungi', [TrsspController::class, 'hubungi'])->name('trssp.hubungi');
	Route::post('/trssp/selesai', [TrsspController::class, 'selesai'])->name('trssp.selesai');
	
	Route::get('/{page}', [PageController::class, 'index'])->name(''); //route list
	Route::post('/{page}', [PageController::class, 'index'])->name(''); //route store
	Route::get('/{page}/{action}', [PageController::class, 'index'])->name(''); //route show, add, edit
	Route::put('/{page}/{action}', [PageController::class, 'index'])->name(''); //route update
	Route::delete('/{page}/{action}', [PageController::class, 'index'])->name(''); //route delete(destroy)
	Route::get('/{page}/{action}/{id}', [PageController::class, 'index'])->name(''); //route CRUD
});
