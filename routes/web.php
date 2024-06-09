<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NodeController;
use App\Models\Node;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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
// defines the routes for the NodeController
//*********

// defines the create route
Route::get('create/{node?}', [NodeController::class, 'create'])
    ->middleware('auth')
    ->name('node.create');

// defines the store route
Route::post('store/{node?}', [NodeController::class, 'store'])
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

Route::get('delete/{node}', [NodeController::class, 'deleteForm'])
    ->middleware('auth')
    ->name('node.delete');

// defines the delete route
Route::post('delete/{node}', [NodeController::class, 'delete'])
    ->middleware('auth')
    ->name('node.destroy');

// defines the index route
Route::get('/{node?}', [NodeController::class, 'index'])
    ->middleware('auth')
    ->name('node.index');

// defines the iframe route
Route::get('iframe/{node}', [NodeController::class, 'iframe'])
    ->missing(function() {
        $rootNode = Node::whereNull('parent_id')->first();
        return Redirect::route('node.iframe', $rootNode);
    })
    ->name('node.iframe');
