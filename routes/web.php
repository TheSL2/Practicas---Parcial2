<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/perfil', function () {
        return view('perfil', ['user' => auth()->user()]);
    })->name('perfil');
});


Route::get('/admin/panel', function () {
    return "Bienvenido al Panel de Administración";
})->middleware('verificar.rol:admin')->name('admin.panel');


Route::middleware(['auth', 'verificar.rol:editor'])->group(function () {
    Route::get('/editor/articulos', [ArticuloController::class, 'index']);
    Route::post('/editor/articulos', [ArticuloController::class, 'store']);
});


Route::get('/movil', function () {
    return "Bienvenido a la versión optimizada para dispositivos móviles 📱";
});

Route::middleware(['solo.celular'])->group(function () {
    Route::get('/inicio', function () {
        return "Estás viendo la página de Inicio en Computadora de Escritorio 💻";
    });
    Route::get('/contacto', function () {
        return "Estás viendo la página de Contacto en Computadora de Escritorio 💻";
    });
    Route::get('/servicios', function () {
        return "Estás viendo la página de Servicios en Computadora de Escritorio 💻";
    });
});

require __DIR__.'/auth.php';
