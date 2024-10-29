<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /** index van de Cards (oftewel entry punt) display **/
    public function index()
    {
        $cards = Card::all();
        return view ('card.index', compact('cards'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('card.create'); // calls the resources/views/card/create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::guest()) {
            return redirect('/login');
        }

        $card = new Card();
        $card->name = $request->input('name');
        $card->description = $request->input('description');
        $card->user_id = Auth::id();
        $card->type_id = $request->input('type');
        $card->save();

        return redirect()->route('cards.index');
    }

    /**
     * Display the specified resource.
     */

    /** show van de Card (oftewel entry punt) display **/
    /** Als er op de card wordt geklikt, kan je met deze "show" de volgende pagina laten zien en de data
     * gebonden aan het $id meesturen/opvragen
     * *
     */
    public function show(string $id)
    {
        $card = Card::find($id);
        return view('card.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        if(Auth::guest()) {
            return redirect('/login');
        }
        // Find the card based on the selected id.

        $card = Card::findOrFail($id);
        return view('card.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::guest()) {
            return redirect('/login');
        }
    }
}
