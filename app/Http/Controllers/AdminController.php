<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;

class AdminController extends Controller
{
    public function adminHome()
    {
        // Return the admin view with 'user' and 'card' table data.
        $users = User::all();
        $cards = Card::all();
        return view('admin-home', compact(['cards', 'users']));
    }
}
