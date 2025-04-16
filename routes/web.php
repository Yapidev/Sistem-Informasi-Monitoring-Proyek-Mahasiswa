<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\welcomeController::class, 'index'])->name('home');

// Route for authentication
Route::middleware('guest')->prefix('auth')->group(function () {
    Route::get('login', App\Livewire\Auth\Login::class)->name('login');
});

// Route for authenticated student
Route::middleware('auth', 'role:student')->prefix('student')->group(function () {
    Route::get('dashboard', App\Livewire\Student\Dashboard::class)->name('student.dashboard');
    Route::get('project-detail/{project}', App\Livewire\Student\ProjectDetail::class)->name('student.project.detail');
});

// Route for authenticated lecturer
Route::middleware('auth', 'role:lecturer')->prefix('lecturer')->group(function () {
    Route::get('dashboard', App\Livewire\Lecturer\Dashboard::class)->name('lecturer.dashboard');
    Route::get('student', App\Livewire\Lecturer\Student::class)->name('lecturer.student');
    Route::get('project', App\Livewire\Lecturer\Project::class)->name('lecturer.project');
    Route::get('lecturer-list', App\Livewire\Lecturer\LecturerList::class)->name('lecturer.lecturer-list');
});
