<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TypeController;
use App\Models\Card;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;


Route::get('/home', function () {
    return view('welcome');
}) ->name('home');


!!  // route aanmaken met gebruik van controller

//// passeer parameters via de url
//Route::get('products/{id}', function(string $id){
//    return view('product-id', [
//        'id'=>$id,
//    ]);
//});


// General
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// Cards
Route::get('/cards',[CardController::class, 'index'])->name('cards.index');
Route::resource('/cards', CardController::class);


// Types
Route::resource('/types', TypeController::class);


// If the user has a registered account, give them access to the routes below
Route::middleware('auth')->group(function () {

    // Auth for profiles
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Auth for cards
    Route::get('/cards/create',[CardController::class, 'create'])->name('card.create');

    // Update
    Route::patch('/cards/{card}', [CardController::class, 'update'])->name('card.update');

    // Delete
    Route::delete('/cards/{card}', [CardController::class, 'destroy'])->name('card.destroy');

    // Auth for types
    Route::resource('/types', TypeController::class);

});

// If the user has an assigned amin role, give them access to the routes below
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('admin-home', [AdminController::class, 'adminHome'])->name('admin.home');

});




require __DIR__.'/auth.php';
