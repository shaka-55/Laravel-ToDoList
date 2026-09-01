<?php

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GoogleController;
use App\Models\Post;
use App\Models\Practice;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//gogogle api認証
Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');

Route::get('/google-test', function () {
    dd(config('services.google'));
});

Route::get('/dashboard', function () {
    return redirect()->route('practices.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//ログインしているユーザーのみが入れるroute
Route::middleware('auth')->group(function () {
    //
    //Practice 一覧画面表示する為のroute
    Route::get('/practices', [PracticeController::class, 'index'])->name('practices.index');
    //Practice 新しいTodoを保存する為のroute
    Route::post('/practices', [PracticeController::class, 'store'])->name('practices.store');
   //編集一覧へのroute
    Route::get('/practices/{practice}/edit', [PracticeController::class, 'edit'])->name('practices.edit');


    //更新処理へのroute
    Route::put('/practices/{practice}', [PracticeController::class, 'update'])
        ->name('practices.update');
    //削除処理へのroute
    Route::delete('/practices/{practice}', [PracticeController::class, 'destroy'])
        ->name('practices.destroy');
    //ステータス管理へのroute
    ROute::patch('/practices/{practice}/toggle',[PracticeController::class,'toggle'])->name('practices.toggle');

  
    // 保存
    Route::post('/blog/store', [PostController::class, 'store'])
        ->name('blog.store');
    // 作成画面
    Route::get('/blog/create', [PostController::class, 'create'])
        ->name('blog.create');
    // 一覧
    Route::get('/blog/', [PostController::class, 'index'])
        ->name('blog.index');

    //パラメーターを使った個別用のルートを設定
    Route::get('/blog/show/{post}', [PostController::class, 'show'])
        ->name('post.show');

    //編集用route
    Route::get('/blog/{post}/edit', [PostController::class, 'edit'])
        ->name('blog.edit');
    //更新用route
    Route::patch('/blog/{post}', [PostController::class, 'update'])
        ->name('blog.update');

    //削除用route
    Route::delete('/post/{post}', [PostController::class, 'destroy'])
        ->name('blog.destroy');
    
    












    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
