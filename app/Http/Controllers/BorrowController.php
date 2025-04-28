<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowController extends Controller
{
    /**
     * Display a listing of all borrows.
     */
    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])
            ->latest()
            ->paginate(10);
            
        return view('borrows.index', compact('borrows'));
    }
    
    /**
     * Display a listing of user's borrows.
     */
    public function myBorrows()
    {
        $borrows = Borrow::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
            
        return view('borrows.my-borrows', compact('borrows'));
    }

    /**
     * Borrow a book.
     */
    public function borrow(Book $book)
    {
        // Check if book is available
        if (!$book->is_available) {
            return back()->with('error', 'This book is not available for borrowing.');
        }

        // Create a new borrow record
        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => Carbon::now(),
            'expected_return_date' => Carbon::now()->addDays(14), // 2 weeks borrow period
            'is_returned' => false,
        ]);

        // Update book availability
        $book->update(['is_available' => false]);

        return redirect()->route('books.index')
            ->with('success', 'Book borrowed successfully! Please return by ' . Carbon::now()->addDays(14)->format('M d, Y'));
    }

    /**
     * Return a borrowed book.
     */
    public function return(Borrow $borrow)
    {
        // Check if the book is already returned
        if ($borrow->is_returned) {
            return back()->with('error', 'This book has already been returned.');
        }
        
        // Check if the user is allowed to return this book
        if (auth()->id() !== $borrow->user_id && !auth()->user()->is_admin) {
            return back()->with('error', 'You are not authorized to return this book.');
        }

        // Update borrow record
        $borrow->update([
            'actual_return_date' => Carbon::now(),
            'is_returned' => true,
        ]);

        // Update book availability
        $borrow->book->update(['is_available' => true]);

        return back()->with('success', 'Book returned successfully!');
    }
}
