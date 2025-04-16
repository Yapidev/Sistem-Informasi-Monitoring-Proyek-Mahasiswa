<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class welcomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'student') {
                return redirect()->route('student.dashboard');
            } else {
                return redirect()->route('lecturer.dashboard');
            }
        }
        return redirect()->route('login');
    }
}
