<?php

use App\Http\Controllers\Admin\ErrorController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SystemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group( function () {

    Route::redirect('/', '/projects');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');



    Route::resource('/projects', ProjectController::class);


    Route::get('/systems', [SystemController::class, 'index'])->name('systems.index');
    Route::get('/systems/{system}', [SystemController::class, 'edit'])->name('systems.edit');
    Route::put('/systems/{system}', [SystemController::class, 'update'])->name('systems.update');

    Route::get('/errors', [ErrorController::class, 'index'])->name('errors.index');

    Route::delete('/errors/{error}', [ErrorController::class, 'destroy'])->name('errors.destroy');
    Route::get('/errors/{error}', [ErrorController::class, 'show'])->name('errors.show');
    Route::post('/errors/groupDelete', [ErrorController::class, 'groupDelete'])->name('errors.groupDelete');
});

require __DIR__ . '/auth.php';


Route::get('/php_error-simulating', function () {
    require base_path('error_simulate/php_error_happend.php');
});

Route::get('/js_error-simulating', function () {
    require base_path('error_simulate/js_error_happend.php');
});
