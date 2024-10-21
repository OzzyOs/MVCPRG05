<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}) ->name('home');


!!  // route aanmaken met gebruik van controller

//// passeer parameters via de url
//Route::get('products/{id}', function(string $id){
//    return view('product-id', [
//        'id'=>$id,
//    ]);
//});

// General related routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
// End general related routes



// Card related routes
Route::get('/cards',[CardController::class, 'index'])->name('cards.index');
Route::resource('/cards', CardController::class);
// End card related routes



// Types related routes
Route::resource('/types', TypeController::class);
// End related routes



// Everything in the 'auth group' needs authentication to access.
Route::middleware('auth')->group(function () {

    // Auth for profiles
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Auth for cards
    Route::get('/cards/create',[CardController::class, 'create'])->name('card.create');

    // Auth for types
    Route::resource('/types', TypeController::class);
});

require __DIR__.'/auth.php';
