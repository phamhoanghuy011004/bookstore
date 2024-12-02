<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Users\AuthorController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Client\AuthorInformationController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController1;
use App\Http\Controllers\Client\ShopCartController;
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

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/',[MainController::class, 'index']) -> name('admin');
        Route::get('main',[MainController::class, 'index']);

        #Menus
        Route::prefix('menus')->group(function () {
            Route::get('add',[MenuController::class,'create']);
            Route::post('add',[MenuController::class,'store']);
            Route::get('list',[MenuController::class,'index']);

            Route::get('search', [MenuController::class, 'search'])->name('search');

            Route::get('edit/{menu}',[MenuController::class,'show']);
            Route::post('edit/{menu}',[MenuController::class,'update']);

            Route::get('destroy/{id}',[MenuController::class,'destroy']);
        });
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create'])->name('product.add');
            Route::post('add', [ProductController::class, 'store'])->name('product.store');
            Route::get('list', [ProductController::class, 'index'])->name('product.list');
            Route::get('search', [ProductController::class, 'search'])->name('product.search');
            Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('edit/{product}', [ProductController::class, 'update'])->name('product.update');
            Route::get('destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        });


        Route::prefix('events')->group(function () {
            Route::get('add', [EventController::class, 'create']);
            Route::post('add', [EventController::class, 'store']);
            Route::get('list', [EventController::class, 'indexlist'])->name('event.list');
            Route::get('search', [EventController::class, 'search'])->name('event.search');
            Route::get('edit/{product}', [EventController::class, 'edit'])->name('event.edit');
            Route::post('edit/{product}', [EventController::class, 'update'])->name('event.update');
            Route::get('destroy/{id}', [EventController::class, 'destroy'])->name('event.destroy');
        });
        Route::prefix('authors')->group(function () {
            Route::get('add', [AuthorController::class, 'create']);
            Route::post('add', [AuthorController::class, 'store']);
            Route::get('list', [AuthorController::class, 'index']);
        });
        Route::prefix('users')->group(function () {
            Route::get('add', [UserController::class, 'create']);
            Route::post('add', [UserController::class, 'store'])->name('users.store');
            Route::get('list', [UserController::class, 'index'])->name('user.list');
            Route::get('search', [UserController::class, 'search'])->name('user.search');
            Route::get('edit/{product}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('edit/{product}', [UserController::class, 'update'])->name('user.update');
            Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });
        Route::prefix('contacts')->group(function () {
            Route::get('add', [ContactController::class, 'create']);
            Route::post('add', [ContactController::class, 'store'])->name('contact.store');
            Route::get('list', [ContactController::class, 'index'])->name('contact.list');
            Route::get('search', [ContactController::class, 'search'])->name('contact.search');
            Route::get('edit/{product}', [ContactController::class, 'edit'])->name('contact.edit');
            Route::post('edit/{product}', [ContactController::class, 'update'])->name('contact.update');
            Route::get('destroy/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
        });
    });

    //Route::Client

});

//Route::Client
//Route::view('/', 'main.index');
Route::view('/about', 'main.about');

//Route::view('/shop', 'main.shop');
Route::get('/shop', [ProductController1::class,'index'])->name('main.shop');

//Route::view('/shop-list', 'main.shop-list');
Route::get('/shop-list', [ProductController1::class,'index2'])->name('main.shop-list');

// search
Route::get('/shop-cart/search', [ShopCartController::class, 'search'])->name('shop-cart.search');


Route::view('/404', 'main.404');
Route::view('/checkout', 'main.checkout');
Route::view('/contact', 'main.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::view('/faq', 'main.faq');

Route::view('/index', 'main.index');
Route::get('/index', [HomeController::class, 'index']);
//Route::get('/index', [ProductController::class,'home_index'])->name('main.index');


//Route::view('/news', 'main.news');
Route::get('/news', [EventController::class, 'index']) -> name('main.news'); // done

//Route::view('/news-details', 'main.news-details');
Route::view('/news-grid', 'main.news-grid');

//Route::view('/shop-details', 'main.shop-details');
Route::get('/shop-details/{id}', [ProductController1::class, 'shop_details']);
Route::view('/wishlist', 'main.wishlist');


//Route::view('/shop-cart', 'main.shop-cart');
Route::get('/shop-cart', [ShopCartController::class, 'show']);
Route::post('/shop-cart/add', [ShopCartController::class, 'add'])->name('main.shop-cart');
Route::post('/shop-cart/update', [ShopCartController::class, 'update'])->name('shop-cart.update');
Route::get('/shop-cart/remove', [ShopCartController::class, 'remove']);
Route::post('/shop-cart/save', [ShopCartController::class, 'save'])->name('shop-cart.save');


//Route::view('/team', 'main.team'); // done
Route::get('/team', [AuthorInformationController::class, 'index']) -> name('main.team'); // done
//Route::view('/team-details', 'main.team-details'); // done
Route::get('/team-details', [AuthorInformationController::class, 'showTeamDetails']) -> name('main.team-details'); // done


