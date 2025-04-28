<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Library Reports') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Available Books</h3>
                                <p class="mt-1 text-3xl font-bold text-emerald-600">{{ $availabilityStats['available'] }}</p>
                            </div>
                            <div class="p-2 bg-emerald-100 rounded-full text-emerald-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">{{ number_format(($availabilityStats['available'] / max(1, $availabilityStats['total'])) * 100, 1) }}% of total inventory</p>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Borrowed Books</h3>
                                <p class="mt-1 text-3xl font-bold text-amber-600">{{ $availabilityStats['borrowed'] }}</p>
                            </div>
                            <div class="p-2 bg-amber-100 rounded-full text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">{{ number_format(($availabilityStats['borrowed'] / max(1, $availabilityStats['total'])) * 100, 1) }}% of total inventory</p>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Overdue Books</h3>
                                <p class="mt-1 text-3xl font-bold text-red-600">{{ $overdueBooks->count() }}</p>
                            </div>
                            <div class="p-2 bg-red-100 rounded-full text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $overdueBooks->count() > 0 ? 'Action required' : 'No overdue books' }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Most Borrowed Books -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-medium text-gray-900">Most Popular Books</h3>
                    </div>
                    <div class="p-6">
                        @if($mostBorrowedBooks->count() > 0)
                            <ul class="divide-y divide-gray-200">
                                @foreach($mostBorrowedBooks as $book)
                                <li class="py-3 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="h-10 w-8 flex-shrink-0">
                                            @if($book->cover_image)
                                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="h-10 w-8 object-cover rounded">
                                            @else
                                                <div class="h-10 w-8 bg-gray-200 flex items-center justify-center text-gray-500 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <a href="{{ route('books.show', $book) }}" class="text-sm font-medium text-gray-900 hover:text-emerald-600">
                                                {{ $book->title }}
                                            </a>
                                            <p class="text-xs text-gray-500">by {{ $book->author }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            {{ $book->borrows_count }} borrows
                                        </span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 italic text-center">No borrowing activity recorded yet.</p>
                        @endif
                    </div>
                </div>
                
                <!-- Most Active Users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-medium text-gray-900">Most Active Users</h3>
                    </div>
                    <div class="p-6">
                        @if($mostActiveUsers->count() > 0)
                            <ul class="divide-y divide-gray-200">
                                @foreach($mostActiveUsers as $user)
                                <li class="py-3 flex justify-between items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                                            {{ $user->borrows_count }} borrows
                                        </span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 italic text-center">No borrowing activity recorded yet.</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Overdue Books -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="px-6 py-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Overdue Books</h3>
                    @if($overdueBooks->count() > 0)
                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-800">
                            {{ $overdueBooks->count() }} {{ Str::plural('book', $overdueBooks->count()) }} overdue
                        </span>
                    @endif
                </div>
                <div class="p-6">
                    @if($overdueBooks->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed By</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Days Overdue</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($overdueBooks as $borrow)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-8 flex-shrink-0">
                                                    @if($borrow->book->cover_image)
                                                        <img src="{{ Storage::url($borrow->book->cover_image) }}" alt="{{ $borrow->book->title }}" class="h-10 w-8 object-cover rounded">
                                                    @else
                                                        <div class="h-10 w-8 bg-gray-200 flex items-center justify-center text-gray-500 rounded">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-3">
                                                    <a href="{{ route('books.show', $borrow->book) }}" class="text-sm font-medium text-gray-900 hover:text-emerald-600">
                                                        {{ $borrow->book->title }}
                                                    </a>
                                                    <p class="text-xs text-gray-500">by {{ $borrow->book->author }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $borrow->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $borrow->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $borrow->expected_return_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                                {{ $borrow->expected_return_date->diffInDays() }} days
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <form action="{{ route('borrows.return', $borrow) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-emerald-600 hover:text-emerald-900">
                                                    Mark as Returned
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">All Clear!</h3>
                            <p class="mt-1 text-gray-500">There are no overdue books at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
