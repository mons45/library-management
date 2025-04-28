<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard.
     */
    public function index()
    {
        // Most borrowed books
        $mostBorrowedBooks = Book::withCount('borrows')
            ->orderBy('borrows_count', 'desc')
            ->limit(5)
            ->get();

        // Most active users
        $mostActiveUsers = User::withCount('borrows')
            ->orderBy('borrows_count', 'desc')
            ->limit(5)
            ->get();

        // Overdue books
        $overdueBooks = Borrow::with(['user', 'book'])
            ->where('is_returned', false)
            ->where('expected_return_date', '<', now())
            ->get();

        // Book availability stats
        $availabilityStats = [
            'available' => Book::where('is_available', true)->count(),
            'borrowed' => Book::where('is_available', false)->count(),
            'total' => Book::count(),
        ];

        // Borrowing activity over time
        $monthlyActivity = Borrow::select(
            DB::raw('MONTH(borrow_date) as month'), 
            DB::raw('YEAR(borrow_date) as year'), 
            DB::raw('COUNT(*) as borrow_count')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->limit(6)
        ->get();

        return view('reports.index', compact(
            'mostBorrowedBooks',
            'mostActiveUsers',
            'overdueBooks',
            'availabilityStats',
            'monthlyActivity'
        ));
    }
}
