<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Welcome to the Online Library!</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-emerald-50 rounded-lg p-6 shadow-sm border border-emerald-100">
                            <h3 class="text-lg font-semibold text-emerald-700 mb-2">Browse Books</h3>
                            <p class="text-gray-600 mb-4">Explore our collection of books across various categories.</p>
                            <a href="{{ route('books.index') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded transition-colors">
                                View Books
                            </a>
                        </div>
                        
                        <div class="bg-amber-50 rounded-lg p-6 shadow-sm border border-amber-100">
                            <h3 class="text-lg font-semibold text-amber-700 mb-2">My Borrowed Books</h3>
                            <p class="text-gray-600 mb-4">Check your currently borrowed books and return status.</p>
                            <a href="{{ route('borrows.my') }}" class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-medium py-2 px-4 rounded transition-colors">
                                View My Borrows
                            </a>
                        </div>
                        
                        @if (Auth::user()->is_admin)
                        <div class="bg-blue-50 rounded-lg p-6 shadow-sm border border-blue-100">
                            <h3 class="text-lg font-semibold text-blue-700 mb-2">Admin Reports</h3>
                            <p class="text-gray-600 mb-4">Access library statistics and management reports.</p>
                            <a href="{{ route('reports.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition-colors">
                                View Reports
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">Total Books Available</h3>
                        <p class="mt-2 text-3xl font-bold text-emerald-600">{{ \App\Models\Book::where('is_available', true)->count() }}</p>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">My Active Borrows</h3>
                        <p class="mt-2 text-3xl font-bold text-amber-600">{{ \App\Models\Borrow::where('user_id', Auth::id())->where('is_returned', false)->count() }}</p>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">Book Categories</h3>
                        <p class="mt-2 text-3xl font-bold text-purple-600">{{ \App\Models\Book::distinct('category')->count('category') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
