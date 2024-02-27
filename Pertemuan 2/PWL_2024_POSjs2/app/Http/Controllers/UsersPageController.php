<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersPageController extends Controller
{
    public function users() {
        return view('users')
        ->with('id', '24')
        ->with('name', 'Rossi Dea Agatha');
    }
}
