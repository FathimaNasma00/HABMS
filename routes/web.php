<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::post('contact-us', [HomeController::class, 'contactUsSend'])->name('contact-us-send');

Route::group(['prefix' => 'home', 'as' => 'home.'], function (Router $route) {
    $route->get('login', [HomeController::class, 'login'])->name('login');
    $route->get('register', [HomeController::class, 'register'])->name('register');
    $route->get('find-doctor', [HomeController::class, 'findDoc'])->name('find-doc');
});

//Route::get('/mailable', function () {
//    $invoice = \App\Models\appointment::find(33);
//
//    return new \App\Mail\PatientMail($invoice);
//});

Route::middleware('auth')->group(function (Router $route) {
    Route::get('my-appointment', [AppointmentController::class, 'index'])->name('my-appointment');
    Route::get('get-appointment', [AppointmentController::class, 'get'])->name('get-appointment');
    Route::post('store-appointment', [AppointmentController::class, 'store'])->name('store-appointment');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/dashboard', [DoctorController::class, 'index'])->name('dashboard');
    Route::get('payment/{appointment}', [AppointmentController::class, 'payment'])->name('payment');
    Route::post('payment/{appointment}', [AppointmentController::class, 'paymentComplete'])->name('payment-complete');

    $route->group(['prefix' => 'admin', 'as' => 'admin.'], function (Router $router) {
        $router->get('dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');
        $router->get('add-speciality', [AdminController::class, 'speciality'])->name('add-speciality');
        $router->get('get-speciality', [AdminController::class, 'getSpeciality'])->name('get-speciality');
        $router->post('store-speciality', [AdminController::class, 'storeSpeciality'])->name('store-speciality');
        $router->patch('edit-speciality/{specialty}', [AdminController::class, 'editSpeciality'])->name('edit-speciality');
        $router->delete('delete-speciality/{specialty}', [AdminController::class, 'deleteSpeciality'])->name('delete-speciality');
        $router->get('add-doctor', [AdminController::class, 'addDoc'])->name('add-doctor');
        $router->get('get-doctor', [AdminController::class, 'getDoc'])->name('get-doctor');
        $router->patch('edit-doctor/{doctor}', [AdminController::class, 'editDoctor'])->name('edit-doctor');
        $router->delete('delete-doctor/{doctor}', [AdminController::class, 'deleteDoctor'])->name('delete-doctor');
        $router->post('store-doctor', [AdminController::class, 'storeDoc'])->name('store-doctor');
        $router->get('view-doctors', [AdminController::class, 'viewDoc'])->name('view-doctors');
        $router->get('view-appointments', [AdminController::class, 'viewAppointments'])->name('view-appointments');
        $router->get('get-appointments', [AdminController::class, 'getAppointments'])->name('get-appointments');
        $router->get('users', [AdminController::class, 'users'])->name('users');
        $router->get('get-users', [AdminController::class, 'getUsers'])->name('get-users');
        $router->patch('reset-password/{user}', [AdminController::class, 'resetPassword'])->name('admin-reset-password');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
