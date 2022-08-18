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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::resource('/projects', ProjectController::class);


Route::get('/{project}/systems', [SystemController::class, 'index'])->name('systems.index');

Route::get('/{project}/{system}/errors', [ErrorController::class, 'index'])->name('errors.index');

Route::get('/errors/{error}', [ErrorController::class, 'show'])->name('errors.show');


Route::get('/error-simulating', function () {
    require base_path('error_simulate/error_happend.php');
});
