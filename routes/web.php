<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QRController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Vendor\ClientController;
use App\Http\Controllers\OrderController;

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


Route::post('/check-email', [UserController::class, 'checkEmail'])->name('check.email');
Route::post('/register-user', [UserController::class, 'RegisterUser'])->name('register.user');
Route::post('/login-user', [UserController::class, 'LoginUser'])->name('login.user');
Route::post('/guest-vaccine-login', [UserController::class, 'guestVaccineLogin'])->name('guest.vaccine.login');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('/', [AdminController::class, 'index' ])->name('admin');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'profile'])->name('dashboard');
});

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/', [VendorController::class, 'index'])->name('dashboard');
    Route::get('/order-create', [OrderController::class, 'OrderCreate'])->name('order.create');
    Route::post('/order/create', [OrderController::class, 'OrderStore'])->name('order.store');
    Route::get('order/{slug}', [OrderController::class, 'index' ])->name('order');

    Route::prefix('client')->group(function () {
        Route::get('/', [ClientController::class, 'index' ])->name('client');
        Route::get('/pets/{id}', [ClientController::class, 'getPets' ])->name('client.pets');
        Route::get('/pets/vaccine/{id}', [ClientController::class, 'getPetVaccine' ])->name('client.pets.vaccine');
        Route::post('/pets/vaccine/create', [ClientController::class, 'PetVaccineStore' ])->name('client.pets.vaccine.store');
    });
});

Route::middleware(['auth'])->prefix('profile')->group(function () {
    Route::get('/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::post('/update', [UserController::class, 'updateProfile'])->name('profile.update');
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/scan', [QRController::class, 'ScanQR' ])->name('scan.qrcode');
Route::post('/scan-location', [QRController::class, 'ScanLocation' ])->name('scan.location');
Route::post('/scan-location-deny', [QRController::class, 'ScanLocationDeny' ])->name('scan.location.deny');
Auth::routes();

Route::prefix('pet')->group(function () {
    Route::post('/store', [PetController::class, 'store' ])->name('pet.store');
    Route::post('/edit', [PetController::class, 'Edit' ])->name('pet.edit');
    Route::post('/update', [PetController::class, 'update' ])->name('pet.update');
});

Route::prefix('vaccine')->group(function () {
    Route::get('/show/{id}', [VaccineController::class, 'ShowVaccine' ])->name('vaccine.show');
    Route::post('/store', [VaccineController::class, 'store' ])->name('vaccine.store');
    // Route::post('/edit', [PetController::class, 'Edit' ])->name('pet.edit');
    // Route::post('/update', [PetController::class, 'update' ])->name('pet.update');
});

Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index' ])->name('admin');
    Route::get('/allpet', [PetController::class, 'index' ])->name('admin.allpet');
    Route::get('/delete-pet/{id}', [PetController::class, 'deletePet' ])->name('admin.pet.delete');

    Route::prefix('qrcode')->group(function () {
        Route::get('/create', [QRController::class, 'create' ])->name('admin.qrcode.create');
        Route::post('/generate-qr', [QRController::class, 'generateQRCode' ])->name('admin.qrcode.generate');
        Route::post('/store', [QRController::class, 'store' ])->name('admin.qrcode.store');
    });

    Route::prefix('user')->group(function () {
        Route::get('', [AdminController::class, 'userList' ])->name('admin.user');
        Route::post('create', [AdminController::class, 'StoreUser' ])->name('admin.user.store');
        Route::get('/delete/{id}', [AdminController::class, 'DeleteUser' ])->name('admin.user.delete');
        Route::get('/status/{id}', [AdminController::class, 'StatusUser' ])->name('admin.user.status');
        Route::post('/generate-qr', [QRController::class, 'generateQRCode' ])->name('admin.qrcode.generate');
        Route::post('/store', [QRController::class, 'store' ])->name('admin.qrcode.store');
    });

    Route::prefix('order')->group(function () {
        Route::get('/{slug}', [App\Http\Controllers\Admin\OrderController::class, 'index' ])->name('admin.order');
        Route::post('order_status', [App\Http\Controllers\Admin\OrderController::class, 'OrderStatus' ])->name('admin.order.status');
        Route::post('/generate/{id}', [App\Http\Controllers\Admin\OrderController::class, 'GenerateQR' ])->name('admin.order.generate');
        Route::get('/download/{id}', [App\Http\Controllers\Admin\OrderController::class, 'GeneratedDownload' ])->name('admin.order.generate.download');
        // Route::post('/store', [QRController::class, 'store' ])->name('admin.qrcode.store');
    });
    Route::get('/self-order', [App\Http\Controllers\Admin\OrderController::class, 'SelfOrderCreate' ])->name('admin.self.order.create');
    Route::post('/generate-self', [App\Http\Controllers\Admin\OrderController::class, 'SelfOrder' ])->name('admin.self.order.self');
});