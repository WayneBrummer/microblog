<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Profiles\PublicListPost;

Route::get('/', static fn () => view('welcome'));

Route::middleware([
    'auth',
])->group(function () {
    Route::get('/profile/{user:username}', PublicListPost::class)->name('public.profile');
    Route::get('/feed', static fn () => view('feed'))->name('feed');
});
