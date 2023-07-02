<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
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
    Route::get('/groups/search', [GroupController::class, 'search'])->name('search');
    Route::get('/groups/{group}', [GroupController::class ,'show'])->name('show');
    Route::get('/groups/index', [GroupController::class, 'index']);
    Route::put('/groups/{group}', [GroupController::class, 'update'])->name('update');
    Route::post('/groups/register', [GroupController::class, 'register']);
    Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('edit');
    Route::post('/groups', [GroupController::class, 'store']);
    
    //comment
    Route::get('/activities/{activity}/comments/create', [CommentController::class, 'create']);
    Route::post('/activities/{activity}', [CommentController::class, 'store']);
    
    //document
    Route::get('/documents/index', [DocumentController::class, 'index']);
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('create');
    Route::get('documents/{document}', [DocumentController::class, 'show'])->name('show');
    Route::put('/documents/{document}', [DocumentController::class, 'upload'])->name('upload');
    Route::delete('/documents/{document}', [DocumentController::class,'delete']);
    Route::post('/documents', [DocumentController::class, 'store']);
    
    //user
    Route::get('/users/{user}', [UserController::class ,'show']);
    Route::put('/users/{user}', [UserController::class, 'upload'])->name('upload');
    
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

?>
