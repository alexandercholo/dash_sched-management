<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleRequestController;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/schedule/store', [ScheduleRequestController::class, 'store'])->name('schedule.store');


Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');





Route::get('/notifications', function () {
    return view('notifications');
})->name('notifications');

Route::get('/schedule-list', function () {
    return view('schedule_list');
})->name('schedule-list');

Route::get('/announcements', function () {
    return view('announcements');
})->name('announcements');

Route::get('/announcements/view', function () {
    return view('announcements_view');
})->name('announcements.view');

Route::get('/staff/add', function () {
    return view('add_staff');
})->name('staff.add');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


use App\Http\Controllers\AdminAuthController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->get('home', function () {
        return view('admin.home');
    })->name('home');
});

Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
Route::middleware(['auth'])->group(function () {
    Route::resource('requests', RequestController::class);
});

// routes/web.php

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

require __DIR__.'/auth.php';
