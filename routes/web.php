<?php

use App\Http\Controllers\User\CityController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\NewsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VisualStoryController;
use Illuminate\Database\Eloquent\Model;
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

// Route::middleware(['auth:admin', 'role:Super Admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });

Route::get('/', function () {
    return view('user.home');
})->middleware('logVisitor')->name('user.home');

Route::post('/sign-up-user',[UserController::class,'signUpUser'])->name('sign-up-user');
Route::post('/login-user',[UserController::class,'loginUser'])->name('login-user');
Route::get('/logout-user',[UserController::class,'logOutUser'])->name('logout-user');
Route::get('/login-with-google', [UserController::class, 'loginWithGoogle'])->name('user.login-with-google');
Route::any('/auth-user',[UserController::class, 'authWithGoogle'])->name('user.auth-with-google');

// json data retun
Route::get('/states_cities', [CityController::class, 'getStateCities'])->name('state-cities');
Route::get('/categories', function(){
    return response()->json(App\Models\Category::get());
})->name('categories');
// categories
Route::get('/set-location',[UserController::class,'setLocation'])->name('set-location');
Route::get('/news', [NewsController::class, 'getNews'])->name('news');
Route::get('/live-video-news', [NewsController::class, 'liveVideogetNews'])->name('live_video_news');
Route::get('/news-details/{slug}', [NewsController::class, 'getNewsDetails'])->name('news.details');
Route::get('/news-data/{slug}', [NewsController::class, 'getNewsData'])->name('news.data');
Route::get('/category-news/{slug}', [NewsController::class, 'getCategoryNews'])->name('category.news');
Route::get('/top-news-slider', [NewsController::class, 'top_news_slider'])->name('top-news-slider');
Route::get('/political-news', [NewsController::class, 'political_news'])->name('political-news');
Route::get('/categorised-news', [NewsController::class, 'getCategorisedNews'])->name('categorised-news');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::get('/comments/{newsId}', [CommentController::class, 'getComments'])->name('comment.get');
Route::post('/comment-reply', [CommentController::class, 'replyStore'])->name('comment.reply');
Route::get('/visual-stories', [VisualStoryController::class, 'visualStories'])->name('visual-stories');
Route::get('/visual-story-view/{id}', [VisualStoryController::class, 'visualStoryView'])->name('visual-story-view');
Route::get('/privacy-policy', [UserController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [UserController::class, 'termsAndConditions'])->name('terms-and-conditions');

