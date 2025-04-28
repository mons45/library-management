<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Books
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    
    // Borrows
    Route::get('/my-borrows', [BorrowController::class, 'myBorrows'])->name('borrows.my');
    Route::post('/books/{book}/borrow', [BorrowController::class, 'borrow'])->name('books.borrow');
    Route::post('/borrows/{borrow}/return', [BorrowController::class, 'return'])->name('borrows.return');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Books Management
    Route::get('/admin/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/admin/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/admin/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/admin/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/admin/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    
    // All Borrows
    Route::get('/admin/borrows', [BorrowController::class, 'index'])->name('borrows.index');
    
    // Reports
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('reports.index');
});

require __DIR__.'/auth.php';
