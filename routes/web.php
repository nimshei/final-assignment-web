<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Profile;

use App\Http\Livewire\UserManagement\UserProfile;
use App\Http\Livewire\UserManagement\UserManagement;
use App\Http\Livewire\LicenseManagement\LicenseManagement;
use App\Http\Livewire\VehicleManagement\VehicleManagement;
use App\Http\Livewire\RevenueManagement\RevenueManagement;
use App\Http\Livewire\ViolationManagement\ViolationManagement;
use App\Http\Livewire\OffenceManagement\OffenceManagement;
use App\Http\Livewire\AccidentManagement\AccidentManagement;
use Illuminate\Http\Request;

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
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/user-profile', UserProfile::class)->name('user-profile');
    Route::get('/user-management', UserManagement::class)->name('user-management');
    Route::get('/license-management', LicenseManagement::class)->name('license-management');
    Route::get('/vehicle-management', VehicleManagement::class)->name('vehicle-management');
    Route::get('/revenue-management', RevenueManagement::class)->name('revenue-management');
    Route::get('/violation-management', ViolationManagement::class)->name('violation-management');
    Route::get('/offence-management', OffenceManagement::class)->name('offence-management');
    Route::get('/accident-management', AccidentManagement::class)->name('accident-management');
});
