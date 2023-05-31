<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //activity
    Route::get('/', [ActivityController::class, 'home'])->name('home');
    Route::get('/create', [ActivityController::class, 'create'])->name('create');
    Route::get('/activities/{activity}', [ActivityController::class ,'show'])->name('show');
    Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('update');
    Route::delete('/activities/{activity}', [ActivityController::class,'delete']);
    Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('edit');
    Route::post('/activities', [ActivityController::class, 'store']);

    //group
    Route::get('/groups/create', [GroupController::class, 'create']);
    Route::get('/groups/{group}', [GroupController::class ,'show']);
    Route::post('/groups', [GroupController::class, 'store']);
    
    //comment
    Route::get('activities/{activity}/comments/create', [CommentController::class, 'create']);
    Route::post('activities/{activity}', [CommentController::class, 'store']);
    
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

?>
