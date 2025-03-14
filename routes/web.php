<?php

use App\Livewire\Profiles\ListPost;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/feed', static fn () => view('feed'))->name('feed');

    Route::get('/profile/{user:username}', ListPost::class)->name('public.profile');
});
