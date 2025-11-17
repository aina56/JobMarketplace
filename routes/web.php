<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', Home::class)->name('home');


Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();                        // Log out the user
    $request->session()->invalidate();      // Invalidate the session
    $request->session()->regenerateToken(); // Regenerate CSRF token

    return redirect('/')->with('success', 'Logged out successfully!');
})->name('logout');
use App\Http\Controllers\Auth\OrcidController;

Route::get('/auth/orcid/redirect', [OrcidController::class, 'redirect'])->name('orcid.redirect');
Route::get('/auth/orcid/callback', [OrcidController::class, 'callback'])->name('orcid.callback');
