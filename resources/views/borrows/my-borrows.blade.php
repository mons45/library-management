<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Borrowed Books') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">My Current and Past Borrows</h3>
                        
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('borrows.my', ['filter' => 'active']) }}" class="px-3 py-1 text-sm rounded-md {{ request('filter') === 'active' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition-colors">
                                Active
                            </a>
                            <a href="{{ route('borrows.my', ['filter' => 'returned']) }}" class="px-3 py-1 text-sm rounded-md {{ request('filter') === 'returned' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition-colors">
                                Returned
                            </a>
                            <a href="{{ route('borrows.my') }}" class="px-3 py-1 text-sm rounded-md {{ !request('filter') ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition-colors">
                                All
                            </a>
                        </div>
                    </div>
                    
                    @if($borrows->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($borrows as $borrow)
                        <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-start p-4 border-b">
                                <div class="h-16 w-12 flex-shrink-0">
                                    @if($borrow->book->cover_image)
                                        <img src="{{ Storage::url($borrow->book->cover_image) }}" alt="{{ $borrow->book->title }}" class="h-16 w-12 object-cover rounded">
                                    @else
                                        <div class="h-16 w-12 bg-gray-200 flex items-center justify-center text-gray-500 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1">
                                    <a href="{{ route('books.show', $borrow->book) }}" class="text-lg font-medium text-gray-900 hover:text-emerald-600">
                                        {{ $borrow->book->title }}
                                    </a>
                                    <p class="text-sm text-gray-600">by {{ $borrow->book->author }}</p>
                                    <p class="text-xs text-gray-500">{{ $borrow->book->category }} • {{ $borrow->book->publication_year }}</p>
                                </div>
                                
                                <div class="ml-4">
                                    @if($borrow->is_returned)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            Returned
                                        </span>
                                    @elseif($borrow->expected_return_date->isPast())
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                            Overdue
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-800">
                                            Active
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="p-4 bg-gray-50">
                                <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                                    <div>
                                        <span class="font-medium text-gray-500">Borrowed on:</span>
                                        <span class="text-gray-900 ml-1">{{ $borrow->borrow_date->format('M d, Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-500">Expected return:</span>
                                        <span class="text-gray-900 ml-1">{{ $borrow->expected_return_date->format('M d, Y') }}</span>
                                    </div>
                                    
                                    @if($borrow->is_returned)
                                    <div>
                                        <span class="font-medium text-gray-500">Returned on:</span>
                                        <span class="text-gray-900 ml-1">{{ $borrow->actual_return_date->format('M d, Y') }}</span>
                                    </div>
                                    @else
                                    <div class="col-span-2">
                                        <span class="font-medium text-gray-500">Status:</span>
                                        @if($borrow->expected_return_date->isPast())
                                            <span class="text-red-600 ml-1">
                                                {{ $borrow->expected_return_date->diffInDays() }} days overdue
                                            </span>
                                        @else
                                            <span class="text-gray-900 ml-1">
                                                {{ now()->diffInDays($borrow->expected_return_date) }} days remaining
                                            </span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                
                                @if(!$borrow->is_returned)
                                <div class="mt-4">
                                    <form action="{{ route('borrows.return', $borrow) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium py-2 px-4 rounded transition-colors">
                                            Return Book
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $borrows->links() }}
                    </div>
                    @else
                    <div class="text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">You haven't borrowed any books yet!</h3>
                        <p class="mt-1 text-gray-500">Browse our collection to find your next read.</p>
                        <div class="mt-4">
                            <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-md">
                                Browse Books
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
