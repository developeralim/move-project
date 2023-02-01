<?php

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


use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SinglePageController;
use App\Http\Controllers\ArchivePageController;
use App\Http\Controllers\User\ProfileController;

// for admin
use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;

use App\Http\Controllers\Admin\AdminprofileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\OptionsettingController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SeasionController;

Route::group(['middleware' => 'view_share'],function() {
      
    //Fallback/Catchall Route
    Route::fallback(function () {
        return view('pages.404');
    });
    
    Route::get('/',[HomeController::class,'home'])->name('home');
    Route::get('/archive/{id}/{category}',[ArchivePageController::class,'archive'])->name('archive');
    Route::get('/single/{id}/{drive_id}',[SinglePageController::class,'single'])->name('single');
    Route::get('/search',[SearchController::class,'search'])->name('search');
    Route::get('/checkout/{package}/{price}',[PageController::class,'checkout'])->name('checkout');
    Route::get('/pricing',[PageController::class,'pricing'])->name('pricing');

    Route::get('/login',[AuthController::class,'login_view'])->name('login');
    Route::post('/login',[AuthController::class,'login'])->name('member.login');


    // Route::get('/admin/dashboard/{user}',[PageController::class,'dashboard'])->name('dashboard');

    Route::get('/about',[PageController::class,'about'])->name('about');
    Route::get('/help',[PageController::class,'help'])->name('help');
    Route::get('/contact',[PageController::class,'contact'])->name('contact');
    Route::get('/terms',[PageController::class,'terms'])->name('terms');
    Route::get('/privecy',[PageController::class,'privecy'])->name('privecy');
    // comment add
    Route::post('/single/comment',[FrontendController::class,'add_comment'])->name('comment');
    Route::post('/single/review',[FrontendController::class,'add_review'])->name('review');
    // payment option
    Route::post('/payment',[PaymentController::class,'create_memeber'])->name('payment');
    Route::post('/success',[PaymentController::class,'OnPaymentSuccess'])->name('success');
    Route::post('/fail',[PaymentController::class,'OnPaymentFail'])->name('fail');
    Route::post('/cancel',[PaymentController::class,'OnPaymentCancel'])->name('cancel');

});


Route::group(['middleware' => ['member_auth','member_guest','view_share']],function() {
    Route::get('/member/dashboard', [AuthController::class,'dashboard'])->name('dashboard');
    Route::get('/member/logout', [AuthController::class,'logout'])->name('logout');
    Route::post('/member/update', [ProfileController::class, 'data_update'])->name('update_member');
    Route::post('/member/password-update', [ProfileController::class, 'password_update'])->name('update_password');
});



Route::group(['prefix' => 'admin'], function () {
    Route::get('login/redirect', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('login/redirect', [AdminAuthController::class, 'loginpost'])->name('admin.login.post');
});


Route::group(['prefix' => 'admin','middleware' => ['admin_guest','admin_auth']], function () {
    // logout
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    // CategoryController
    Route::resource('category', CategoryController::class)->names('category');
    Route::get('category-status/{id}', [CategoryController::class, 'status'])->name('category.status');
    Route::get('category-delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('slidcategoryer-delete-all', [CategoryController::class, 'delete_all'])->name('category.delete_all');
    Route::post('category-destroy-all', [CategoryController::class, 'destroy_all'])->name('category.destroy_all');
    // SubcategoryController
    // MovieController
    Route::resource('movie', MovieController::class)->names('movie');
    Route::get('movie-status/{id}', [MovieController::class, 'status'])->name('movie.status');
    Route::get('movie-delete/{id}', [MovieController::class, 'delete'])->name('movie.delete');
    Route::get('movie-delete-all', [MovieController::class, 'delete_all'])->name('movie.delete_all');
    Route::post('movie-destroy-all', [MovieController::class, 'destroy_all'])->name('movie.destroy_all');
    // SesionController
    Route::resource('seasion', SeasionController::class)->names('seasion');
    Route::get('seasion-status/{id}', [SeasionController::class, 'status'])->name('seasion.status');
    Route::get('seasion-delete/{id}', [SeasionController::class, 'delete'])->name('seasion.delete');
    Route::get('seasion-delete-all', [SeasionController::class, 'delete_all'])->name('seasion.delete_all');
    Route::post('seasion-destroy-all', [SeasionController::class, 'destroy_all'])->name('seasion.destroy_all');
    // MemberController
    Route::resource('member', MemberController::class)->names('user');
    Route::get('member-status/{id}', [MemberController::class, 'status'])->name('user.status');
    Route::get('member-delete/{id}', [MemberController::class, 'delete'])->name('user.delete');
    Route::get('member-delete-all', [MemberController::class, 'delete_all'])->name('user.delete_all');
    Route::post('member-destroy-all', [MemberController::class, 'destroy_all'])->name('user.destroy_all');
    // EpisodeController
    Route::resource('episode', EpisodeController::class)->names('episode');
    Route::get('episode-status/{id}', [EpisodeController::class, 'status'])->name('episode.status');
    Route::get('episode-delete/{id}', [EpisodeController::class, 'delete'])->name('episode.delete');
    Route::get('episode-delete-all', [EpisodeController::class, 'delete_all'])->name('episode.delete_all');
    Route::post('episode-destroy-all', [EpisodeController::class, 'destroy_all'])->name('episode.destroy_all');


    // ProfileController
    Route::get('profile', [AdminprofileController::class, 'profile'])->name('profile');
    Route::get('password', [AdminprofileController::class, 'password'])->name('password');
    Route::post('profile-image-update', [AdminprofileController::class, 'image_update'])->name('profile.image.update');
    Route::post('profile-update', [AdminprofileController::class, 'details_update'])->name('profile.details.update');
    Route::post('profile-update-password', [AdminprofileController::class, 'profile_password_update'])->name('profile.password.update');

    // OptionsettingController
    Route::get('option-setting', [OptionsettingController::class, 'option_setting'])->name('option-setting');
    Route::post('option-setting-post', [OptionsettingController::class, 'option_setting_post'])->name('option-setting-post');

    // ReviewController
    Route::resource('review', ReviewController::class)->names('review');
    Route::get('review-status/{id}', [ReviewController::class, 'status'])->name('review.status');
    Route::get('review-delete/{id}', [ReviewController::class, 'delete'])->name('review.delete');
    Route::get('review-delete-all', [ReviewController::class, 'delete_all'])->name('review.delete_all');
    Route::post('review-destroy-all', [ReviewController::class, 'destroy_all'])->name('review.destroy_all');
    // ReviewController
    Route::resource('comment', CommentController::class)->names('comment');
    Route::get('comment-status/{id}', [CommentController::class, 'status'])->name('comment.status');
    Route::get('comment-comment-approve/{id}', [CommentController::class, 'comment_approve'])->name('comment.comment_approve');
    Route::get('comment-delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
    Route::get('comment-delete-all', [CommentController::class, 'delete_all'])->name('comment.delete_all');
    Route::post('comment-destroy-all', [CommentController::class, 'destroy_all'])->name('comment.destroy_all');

});
