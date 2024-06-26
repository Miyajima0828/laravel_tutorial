<?php

use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/folders/{folder}/tasks', [TaskController::class, 'index'])->name('tasks.index');

    Route::get('/folders/create', [FolderController::class, 'showCreateForm'])->name('folders.create');
    Route::post('/folders/create', [FolderController::class, 'create']);

    Route::get('/folders/{folder}/tasks/create', [TaskController::class, 'showCreateForm'])->name('tasks.create');
    Route::post('/folders/{folder}/tasks/create', [TaskController::class, 'create']);

    Route::get('/folders/{folder}/tasks/{task}/edit', [TaskController::class, 'showEditForm'])->name('tasks.edit');
    Route::post('/folders/{folder}/tasks/{task}/edit', [TaskController::class, 'edit']);

    Route::middleware(['can:view,folder'])->group(function () {
        Route::get('/folders/{folder}/tasks',[TaskController::class,'index'])->name('tasks.index');
        Route::get('/folders/{folder}/tasks/create', [TaskController::class,'showCreateForm'])->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', [TaskController::class,'create']);

        Route::get('/folders/{folder}/tasks/{task}/edit', [TaskController::class,'showEditForm'])->name('taksk.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', [TaskController::class,'edit']);
    });
});

require __DIR__ . '/auth.php';
