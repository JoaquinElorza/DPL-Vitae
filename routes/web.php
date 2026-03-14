<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalController;

//ruta que ira por default al abrir la pagina
Route::get('/', function () {
    return view('inicio');
});

//FORM COtIZACION
Route::get('/cotizacion', function () {
    return view('public.cotizacion');
});

//DASHBOARD ADMIN
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

//CRUD PERSONAL
Route::get('/admin/personal', [PersonalController::class, 'index'])->name('personal.index');
Route::get('/admin/personal/create', [PersonalController::class, 'create'])->name('personal.create');
Route::post('/admin/personal', [PersonalController::class, 'store'])->name('personal.store');
Route::get('/admin/personal/{id}/edit', [PersonalController::class, 'edit'])->name('personal.edit');
Route::put('/admin/personal/{id}', [PersonalController::class, 'update'])->name('personal.update');
Route::delete('/admin/personal/{id}', [PersonalController::class, 'destroy'])->name('personal.destroy');