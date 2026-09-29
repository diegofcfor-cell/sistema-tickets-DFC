<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MailController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::resource('tickets', TicketController::class)->except(['destroy']);
    Route::patch('/tickets/{ticket}/cerrar', [TicketController::class, 'cerrar'])->name('tickets.cerrar');
});


// Rutas 100% aisladas para tu envío de correo Brevo
Route::get('/registro-mail', [RegisterController::class, 'create'])->name('brevo.register.create');
Route::post('/registro-mail', [RegisterController::class, 'store'])->name('brevo.register.store');

Route::get('/mail', [MailController::class, 'mostrarFormulario']);
Route::post('/mail/enviar', [MailController::class, 'enviar']);

require __DIR__.'/settings.php';

