<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessUserController;
use App\Http\Controllers\AccessControlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemAccessUserController;
use App\Http\Controllers\TempItemAccessUserController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get(
        '/dashboard',
        function () {
            return view('admin.dashboard');
        }
    )->name('dashboard');
    Route::get('/', [AccessControlController::class, 'create'])->name('access.control.accessControl');
    Route::post('control-acceso', [AccessControlController::class, 'store'])->name('access.control.store');

    //control accesos
    Route::get('control-acceso', [AccessControlController::class, 'index'])->name('access.control.index');
    Route::get('control-acceso/pdf', [AccessControlController::class, 'pdf'])->name('access.control.pdf');

    //usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/usuario/crear', [UserController::class, 'create'])->name('user.create');
    Route::post('/usuario/crear', [UserController::class, 'store'])->name('user.store');
    Route::get('/usuarios/editar/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/usuarios/editar/{user}', [UserController::class, 'update'])->name('user.update');

    //Acceso usuarios
    Route::get('/acceso-usuarios', [AccessUserController::class, 'index'])->name('access.user.index');
    Route::get('/acceso-usuarios/show-ajax/{ci}', [AccessUserController::class, 'showAjax'])->name('access.user.showAjax');
    Route::get('/acceso-usuarios/crear', [AccessUserController::class, 'create'])->name('access.user.create');
    Route::post('/acceso-usuarios/crear', [AccessUserController::class, 'store'])->name('access.user.store');
    Route::get('/acceso-usuarios/editar/{accessUser}', [AccessUserController::class, 'edit'])->name('access.user.edit');
    Route::put('/acceso-usuarios/editar/{accessUser}', [AccessUserController::class, 'update'])->name('access.user.update');
    Route::post('/acceso-usuarios/import', [AccessUserController::class, 'import'])->name('access.user.import');
    Route::get('acceso-usuarios/pdf', [AccessUserController::class, 'pdf'])->name('access.users.pdf');
    Route::get('acceso-usuarios/barcode', [AccessUserController::class, 'barcode'])->name('access.users.barcode');

    //items
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/crear', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items/crear', [ItemController::class, 'store'])->name('item.store');
    Route::post('/items/import', [ItemController::class, 'import'])->name('items.import');
    Route::get('/items/ver/{item}', [ItemController::class, 'show'])->name('item.show');
    Route::get('/items/editar/{item}', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/items/editar/{item}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/items/destroy/{item}', [ItemController::class, 'destroy'])->name('item.destroy');

    //ItemAccessUser
    Route::get('/items-accesso-usuario', [ItemAccessUserController::class, 'index'])->name('itemsAccessUser.index');
    Route::get('/items-accesso-usuario/crear', [ItemAccessUserController::class, 'create'])->name('itemsAccessUser.create');
    Route::get('/items-accesso-usuario/crear/ajaxTemp/{accessUser}', [ItemAccessUserController::class, 'ajaxCreateTemp'])->name('itemsAccessUser.create.ajaxTemp');
    Route::post('/items-accesso-usuario/crear/ajaxItem', [ItemAccessUserController::class, 'ajaxCreateItem'])->name('itemsAccessUser.create.ajaxItem');
    Route::post('/items-accesso-usuario/crear', [ItemAccessUserController::class, 'store'])->name('itemsAccessUser.store');
    Route::post('/items-accesso-usuario/import', [ItemAccessUserController::class, 'import'])->name('itemsAccessUser.import');
    Route::get('/items-accesso-usuario/ver/{item}', [ItemAccessUserController::class, 'show'])->name('itemsAccessUser.show');
    Route::get('/items-accesso-usuario/exportAssignment/{itemAccessUser}', [ItemAccessUserController::class, 'exportAssignment'])->name('itemsAccessUser.exportAssignment');
    Route::get('/items-accesso-usuario/editar/{item}', [ItemAccessUserController::class, 'edit'])->name('itemsAccessUser.edit');
    Route::put('/items-accesso-usuario/editar/{itemAccessUser}', [ItemAccessUserController::class, 'update'])->name('itemsAccessUser.update');
    Route::get('/items-accesso-usuario/exportReceived/{itemAccessUser}', [ItemAccessUserController::class, 'exportReceived'])->name('itemsAccessUser.exportReceived');
    Route::delete('/items-accesso-usuario/destroy/{item}', [ItemAccessUserController::class, 'destroy'])->name('itemsAccessUser.destroy');

    //temp
    Route::post('/temp-items', [TempItemAccessUserController::class, 'store'])->name('tempItems.store');
    Route::delete('/temp-items/destroy/{tempItemAccessUser}', [TempItemAccessUserController::class, 'destroy'])->name('tempItems.destroy');
});

Route::get(
    '/clear-cache',
    function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('event:clear');
        //Artisan::call('optimize');
        return "Cache is cleared";
    }
);
