<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\SpecializationController;

Route::get('/health', function() {
    return response()->json([
        'message' => 'hello world'
    ]);
});

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
    Route::delete('logout', 'logout');
});

Route::middleware(['role:PATIENT'])->prefix('patients')->controller(PatientController::class)->group(function () {
    Route::get('doctors', 'getDoctors');
    Route::get('doctors/{id}', 'getDoctorSchedule');

    Route::post('appointments', 'createAppointment');
    Route::get('appointments', 'getAppointments');
    Route::get('appointments/{id}', 'getAppointment');

    Route::post('reviews', 'submitReview');
    Route::get('reviews/{doctor_id}', 'getDoctorReviews');

    Route::post('/reservations', 'createReservation');
    Route::get('/queues', 'getQueueDetails');
    Route::post('/feedback', 'submitFeedback');
});

Route::middleware(['role:DOCTOR'])->prefix('doctors')->controller(DoctorController::class)->group(function () {
    Route::get('appointments', 'getAppointments');
    Route::put('appointments/{id}/status', 'updateAppointmentStatus');

    Route::post('schedules', 'addSchedule');
    Route::put('schedules/{id}', 'updateSchedule');
    Route::delete('schedules/{id}', 'deleteSchedule');

    Route::get('/queues', 'viewQueue');
    Route::get('/queues/filter', 'filterQueue');
    Route::put('/profile', 'updateProfile');
});

Route::prefix('admins')->group(function () {

    Route::controller(AdminController::class)->group(function() {
        Route::get('/patients', 'getPatients');

        Route::get('/doctors', 'getDoctors');
        Route::post('/doctors', 'addDoctor');
        Route::put('/doctors/{id}', 'updateDoctor');
        Route::delete('/doctors/{id}', 'deleteDoctor');

        Route::get('/appointments', 'getAppointments');
        //Route::put('/appointments/{id}/status', 'updateAppointmentStatus');
        Route::get('/appointments/{id}', 'getReservation');
        Route::put('/appointments/{id}', 'editAppointments');
        Route::delete('/appointments/{id}', 'deleteAppointments');

        Route::get('/queues', 'viewQueues');

        //Route::put('/queues/{id}', 'editQueue');

        //Route::delete('/queues/{id}', 'deleteQueue');
    });

    Route::controller(SpecializationController::class)->group(function() {
        Route::post('/specializations', 'addSpecialization');
        Route::post('/doctors/{id}/specializations', 'assignSpecialization'); 
        Route::get('/doctors/specializations/{name}', 'filterDoctorsBySpecialization'); 
    });
});

Route::controller(ForgotPasswordController::class)->group(function() {
    Route::post('/forgot-password', 'sendResetLinkEmail');
    Route::post('/reset-password', 'resetPassword');
});

