<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TypeController;
use App\Models\Card;
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
})->middleware(['auth'])->name('dashboard');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
// End general related routes


// All cards
Route::get('/cards',[CardController::class, 'index'])->name('cards.index');
Route::resource('/cards', CardController::class);



// Types
Route::resource('/types', TypeController::class);



// Everything in the 'auth group' needs authentication to access.
Route::middleware('auth')->group(function () {

    // Auth for profiles
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Auth for cards
    Route::get('/cards/create',[CardController::class, 'create'])->name('card.create');

    // Update
    Route::patch('/cards/{card}', function ($id) {

        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);

        $card = Card::query()->findOrFail($id); //findOrFail try to find the id or else abort.

        $card->update([
            'name' => request('name'),
            'description' => request('description'),
            'type' => request('type'),
        ]);

        return redirect('/cards/'. $card-> id);

    });

    // Delete
    Route::delete('/cards/{card}', function ($id) {
        Card::findOrFail($id)->delete();

        return redirect('/cards');
    });

    // Auth for types
    Route::resource('/types', TypeController::class);

});




require __DIR__.'/auth.php';
