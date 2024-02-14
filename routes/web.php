<?php

use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Enums\RolesEnum;
use App\Models\Invitation;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

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

//    \Illuminate\Support\Facades\Mail::to('indeloper@gmail.com')->send(new \App\Mail\InviteMail());

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $role = app(Role::class)->findOrCreate(RolesEnum::SUPERADMIN->value);
    \Illuminate\Support\Facades\Auth::user()->syncRoles($role);
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/user', UserController::class);
    Route::post('/user/{user}/block', [UserController::class, 'block'])->name('user.block');
    Route::post('/user/{user}/unblock', [UserController::class, 'unblock'])->name('user.unblock');

    Route::resource('ticket', TicketController::class);
    Route::patch('/ticket/{ticket}/state', [TicketController::class, 'state'])->name('ticket.state');
});

require __DIR__ . '/auth.php';
