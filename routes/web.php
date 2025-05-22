<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function() {
    Route::resource('events', EventController::class);
    Route::get('/my-events', [EventController::class, 'myEvents'])->name('myEvents');
    Route::get('/participing-eventos', [EventController::class, 'participingEvents'])->name('participingEvents');
    Route::post('/events/{event}/join', [EventController::class, 'join'])->name('events.join');
    Route::delete('/events/{event}/leave', [EventController::class, 'leave'])->name('events.leave');
});
