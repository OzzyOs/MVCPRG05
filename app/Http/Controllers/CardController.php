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
            'search'=> 'string|max: 100'
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

        })->get();


//        $cards = Card::all();

        return view ('card.index', compact('cards'));
    }

    public function create()
    {
        // Show the creation form for a new card.
        return view('card.create');
    }

    public function store(Request $request)
    {
        // If the user is a guest (unregistered) redirect the use to the login screen.
        if(Auth::guest()) {
            return redirect('/login');
        }

        // The required fields needed to create a card with the store function.
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
        $card = Card::find($id);
        return view('card.show', compact('card'));
    }

    public function edit(string $id)
    {
        // If the user is a guest (unregistered) redirect the use to the login screen.
        if(Auth::guest()) {
            return redirect('/login');
        }
        // Find the card based on the selected 'id', if it can't find the card display an error
        // If it can find the 'id' open the edit page with the details that belong to that id.
        $card = Card::findOrFail($id);
        return view('card.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        // Field validation
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);

        // FindOrFail try to find the id or else abort.
        $card = Card::query()->findOrFail($id);

        // Update following fields.
        $card->update([
            'name' => request('name'),
            'description' => request('description'),
            'type' => request('type'),
        ]);

        return redirect('/cards/'. $card-> id);

    }

    public function destroy(string $id)
    {
        if(Auth::guest()) {
            return redirect('/login');
        }

        // Find the card by id and delete it.
        Card::findOrFail($id)->delete();

        // Redirect the user back to the card.index
        return redirect('cards');
    }
}
