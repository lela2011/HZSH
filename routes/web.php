<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//*********
// defines the routes for the AuthController
//*********

// defines the login route
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

// defines the authenticate route
Route::post('/authenticate', [AuthController::class, 'authenticate'])
    ->name('authenticate');

// defines the logout route
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');



//*********
// defines the routes for the AuthController
//*********

// defines the index route
Route::get('/{node?}', [NodeController::class, 'index'])
    ->middleware('auth')
    ->name('node.index');

// defines the show route
Route::get('show/{node}', [NodeController::class, 'show'])
    ->middleware('auth')
    ->name('node.show');

// defines the create route
Route::get('/{node?}/create', [NodeController::class, 'create'])
    ->middleware('auth')
    ->name('node.create');

// defines the store route
Route::post('{node?}/store', [NodeController::class, 'store'])
    ->middleware('auth')
    ->name('node.store');

// route defines the edit route
Route::get('edit/{node}', [NodeController::class, 'edit'])
    ->middleware('auth')
    ->name('node.edit');

// defines the update route
Route::post('update/{node}', [NodeController::class, 'update'])
    ->middleware('auth')
    ->name('node.update');

// defines the delete route
Route::delete('/delete/{node}', [NodeController::class, 'delete'])
    ->middleware('auth')
    ->name('node.delete');
