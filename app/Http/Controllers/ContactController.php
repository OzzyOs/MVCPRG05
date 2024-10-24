<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        $email="dit is een email";
        return view('/contact') -> with('email', $email);
    }
}
