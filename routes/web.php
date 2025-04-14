<?php

use App\Livewire\Auth\Login;
use App\Livewire\Student\Dashboard;
use App\Livewire\Student\ProjectDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role == 'student') {
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('lecturer.dashboard');
        }
    }
    return redirect()->route('login');
});

// Route for authentication
Route::middleware('guest')->prefix('auth')->group(function () {
    Route::get('login', Login::class)->name('login');
});

// Route for authenticated student
Route::middleware('auth', 'role:student')->prefix('auth')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('student.dashboard');
    Route::get('project-detail/{project}', ProjectDetail::class)->name('student.project.detail');
});

// Route for authenticated lecturer
Route::middleware('auth', 'role:lecturer')->prefix('auth')->group(function () {});
