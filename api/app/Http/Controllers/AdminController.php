<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function homeView(Request $request)
    {
        return view('home');
    }
}
