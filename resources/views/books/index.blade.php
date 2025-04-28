<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Books Catalog') }}
            </h2>
            @if (Auth::user()->is_admin)
            <a href="{{ route('books.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded transition-colors">
                Add New Book
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('books.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
                                    placeholder="Book title or author...">
                            </div>
                            
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select name="category" id="category" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                    <option value="all">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="availability" class="block text-sm font-medium text-gray-700 mb-1">Availability</label>
                                <select name="availability" id="availability" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                    <option value="all" {{ request('availability') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="borrowed" {{ request('availability') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded transition-colors">
                                Apply Filters
                            </button>
                            <a href="{{ route('books.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Clear Filters</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Books Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($books as $book)
                <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-shadow">
                    <a href="{{ route('books.show', $book) }}" class="block">
                        <div class="h-64 bg-gray-200 overflow-hidden">
                            @if($book->cover_image)
                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full bg-gray-100 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </a>
                    
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-semibold text-gray-900 line-clamp-1">{{ $book->title }}</h3>
                            <span class="px-2 py-1 text-xs rounded-full {{ $book->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $book->is_available ? 'Available' : 'Borrowed' }}
                            </span>
                        </div>
                        
                        <p class="mt-1 text-sm text-gray-600">by {{ $book->author }}</p>
                        <p class="mt-1 text-xs text-gray-500">{{ $book->category }} • {{ $book->publication_year }}</p>
                        
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('books.show', $book) }}" class="text-emerald-600 hover:text-emerald-800 text-sm font-medium">
                                View Details
                            </a>
                            
                            @if($book->is_available)
                                <form action="{{ route('books.borrow', $book) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium py-1 px-3 rounded transition-colors">
                                        Borrow
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No books found</h3>
                    <p class="mt-1 text-gray-500">Try adjusting your search or filter criteria.</p>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $books->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
