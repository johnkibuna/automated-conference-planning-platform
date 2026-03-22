<?php

use App\Http\Controllers\ConferenceCheckinController;
use App\Http\Controllers\ConferencePortalController;
use App\Http\Controllers\ConferenceRegistrationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/conferences/{conference}/register', [ConferenceRegistrationController::class, 'create'])->name('conferences.register');
Route::post('/conferences/{conference}/register', [ConferenceRegistrationController::class, 'store'])->name('conferences.register.store');
Route::get('/conferences/{conference}/registration/{registrationCode}', [ConferenceRegistrationController::class, 'success'])->name('conferences.registration.success');
Route::get('/conferences/{conference}/my-event/{registrationCode}', [ConferencePortalController::class, 'show'])->name('conferences.portal.show');
Route::get('/conferences/{conference}/my-event/{registrationCode}/materials/{material}', [ConferencePortalController::class, 'material'])->name('conferences.portal.material');

Route::middleware('auth')->group(function (): void {
    Route::get('/conferences/{conference}/check-in', [ConferenceCheckinController::class, 'desk'])->name('conferences.checkin.desk');
    Route::get('/conferences/{conference}/check-in/{registrationCode}', [ConferenceCheckinController::class, 'show'])->name('conferences.checkin.show');
    Route::post('/conferences/{conference}/check-in/{registrationCode}', [ConferenceCheckinController::class, 'store'])->name('conferences.checkin.store');
});
