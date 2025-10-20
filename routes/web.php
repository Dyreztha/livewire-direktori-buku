<?php

use App\Livewire\BookList;
use App\Livewire\CreateBook;
use Illuminate\Support\Facades\Route;

Route::get('/', BookList::class)->name('books.index');
Route::get('/books/create', CreateBook::class)->name('books.create');
