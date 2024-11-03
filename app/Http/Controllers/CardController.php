<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{

    public function index(Request $request)
    {
        // Show the index of the cards.
        // Search request

        $search = $request -> query('search');
        $category = $request -> query('category');

        $request -> validate([
            'search'=> 'string'
        ]);

        $cards = Card::when($search, function ($query, $search) {
            return $query -> where('name', 'like', '%' . $search . '%')
                -> orWhere('description', 'like', '%' . $search . '%')
                -> orWhere('type_id', 'like', '%' . $search . '%')
                -> orWhereHas('type', function ($query) use ($search) {
                    return $query -> where('type_id', 'like', '%' . $search . '%');
                });

                }) -> when ($category, function ($query) use ($category) {
            return $query -> where('type_id', $category);
        })
            ->where('status', 'true')
            ->get();


//      $cards = Card::all();

        return view ('card.index', compact('cards'));
    }

    public function create()
    {
        // Show the creation form for a new card.
        $user = Auth::user();

        // If the user is authenticated && NOT an admin && the login_count is less than 3?
        // Redirect the user back to the login screen.
        if ($user && !$user->isAdmin() && $user->login_count < 3) {
            return redirect()->route('login')->with('error', 'You must have been logged in atleast 3 times to create a card.');
        }

        return view('card.create');
    }

    public function store(Request $request)
    {
        // If the user is a guest (unregistered) redirect the use to the login screen.
        if(Auth::guest()) {
            return redirect()->route('/login');
        }

        // If the user has been logged in 3 times, redirect the user back to the homepage.
        $user = Auth::user();
        if ($user && !$user->IsAdmin() && $user->login_count < 3) {
            return redirect()->route('cards.index')->with('error, You must have been logged in atleast 3 times to create a card a card.');
        }

        // The required fields needed to create a card with the store function.
        // Each request looks at the input to the related 'key', provided in the 'card.create'.
        $card = new Card();
        $card->name = $request->input('name');
        $card->description = $request->input('description');
        $card->user_id = Auth::id();
        $card->type_id = $request->input('type');
        $card->save();

        // After the card is created, redirect the user back to the index.
        return redirect()->route('cards.index')->with('success', 'Card created successfully');
    }

    public function show(string $id)
    {
        // Show the details on the card based on the id.
        $card = Card::where('id', $id)->where ('status', 'true')->first();

        if(!$card) {
            return redirect()->route('cards.index')->with('error', 'Card not found');
        }
        return view('card.show', compact('card'));
    }

    public function edit(string $id)
    {
        $card = Card::findOrFail($id);
        // If the user is a guest (unregistered) redirect the use to the login screen.
        if(Auth::guest()) {
            return redirect()->route('/login');
        }

        if(Auth::id() !== $card->user_id) {
            return redirect()->route('cards.index')->with('error', 'You are not allowed to edit this card.');
        }
        // Find the card based on the selected 'id', if it can't find the card display an error
        // If it can find the 'id' open the edit page with the details that belong to that id.
        return view('card.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        // Field validation for the update form
        request() -> validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);

        // FindOrFail try to find the id or else abort.
        $card = Card::query()->findOrFail($id);

        // Update following fields.
        // Each request looks at the input to the related 'key', provided in the 'card.show'.
        $card -> update([
            'name' => request('name'),
            'description' => request('description'),
            'type' => request('type'),
        ]);

        return redirect()->route('cards.index')->with('success', 'Card updated successfully');

    }

    public function destroy(string $id)
    {
        if(Auth::guest()) {
            return redirect('/login');
        }

        // Find the card by id and delete it.
        Card::findOrFail($id)->delete();

        // Redirect the user back to the card.index
        return redirect()->route('cards.index');
    }

    public function checkStatus(string $id)
    {
        // Find card by ID, if null, abort.
        $card = Card::findOrFail($id);

        // Check card status, if status equals true, then change to false
        // If it equals to false, set it to true.
        $card->status = $card -> status === 'true' ? 'false' : 'true';
        $card->save();

        return redirect()->route('admin.home')->with('success', 'Card updated successfully');
    }
}
