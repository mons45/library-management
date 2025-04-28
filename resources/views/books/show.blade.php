<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('books.index') }}" class="mr-2 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $book->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row">
                        <!-- Book Cover -->
                        <div class="w-full md:w-1/3 mb-6 md:mb-0 md:pr-6">
                            <div class="bg-gray-200 rounded-lg overflow-hidden h-96">
                                @if($book->cover_image)
                                    <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full bg-gray-100 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="mt-4">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $book->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $book->is_available ? 'Available' : 'Borrowed' }}
                                    </span>
                                    
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm font-medium">
                                        {{ $book->category }}
                                    </span>
                                </div>
                                
                                @if($book->is_available)
                                    <form action="{{ route('books.borrow', $book) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-4 rounded transition-colors">
                                            Borrow this Book
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded cursor-not-allowed">
                                        Currently Unavailable
                                    </button>
                                @endif
                                
                                @if(Auth::user()->is_admin)
                                <div class="mt-3 flex space-x-2">
                                    <a href="{{ route('books.edit', $book) }}" class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Book Details -->
                        <div class="w-full md:w-2/3">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                            <p class="text-xl text-gray-600 mb-4">by {{ $book->author }}</p>
                            
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Publication Year</h4>
                                    <p class="text-gray-900">{{ $book->publication_year }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Category</h4>
                                    <p class="text-gray-900">{{ $book->category }}</p>
                                </div>
                            </div>
                            
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                            <div class="prose max-w-none text-gray-700">
                                @if($book->description)
                                    <p>{{ $book->description }}</p>
                                @else
                                    <p class="italic text-gray-500">No description available for this book.</p>
                                @endif
                            </div>
                            
                            <hr class="my-6 border-gray-200">
                            
                            <!-- Borrow History (Admin Only) -->
                            @if(Auth::user()->is_admin)
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Borrow History</h3>
                                
                                @php
                                    $borrows = $book->borrows()->with('user')->latest()->limit(5)->get();
                                @endphp
                                
                                @if($borrows->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed On</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expected Return</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($borrows as $borrow)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ $borrow->user->name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $borrow->user->email }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $borrow->borrow_date->format('M d, Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $borrow->expected_return_date->format('M d, Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($borrow->is_returned)
                                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                                Returned on {{ $borrow->actual_return_date->format('M d, Y') }}
                                                            </span>
                                                        @else
                                                            <span class="px-2 py-1 text-xs rounded-full {{ $borrow->expected_return_date->isPast() ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                                {{ $borrow->expected_return_date->isPast() ? 'Overdue' : 'Ongoing' }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">This book has not been borrowed yet.</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
