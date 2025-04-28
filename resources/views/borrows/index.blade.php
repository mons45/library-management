<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Borrowed Books') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Borrowed Books Management</h3>
                        
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('borrows.index', ['filter' => 'overdue']) }}" class="px-3 py-1 text-sm rounded-md {{ request('filter') === 'overdue' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition-colors">
                                Overdue
                            </a>
                            <a href="{{ route('borrows.index', ['filter' => 'active']) }}" class="px-3 py-1 text-sm rounded-md {{ request('filter') === 'active' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition-colors">
                                Active
                            </a>
                            <a href="{{ route('borrows.index', ['filter' => 'returned']) }}" class="px-3 py-1 text-sm rounded-md {{ request('filter') === 'returned' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition-colors">
                                Returned
                            </a>
                            <a href="{{ route('borrows.index') }}" class="px-3 py-1 text-sm rounded-md {{ !request('filter') ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} transition-colors">
                                All
                            </a>
                        </div>
                    </div>
                    
                    @if($borrows->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrow Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expected Return</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($borrows as $borrow)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                @if($borrow->book->cover_image)
                                                    <img src="{{ Storage::url($borrow->book->cover_image) }}" alt="{{ $borrow->book->title }}" class="h-10 w-10 rounded-md object-cover">
                                                @else
                                                    <div class="h-10 w-10 rounded-md bg-gray-200 flex items-center justify-center text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <a href="{{ route('books.show', $borrow->book) }}" class="text-sm font-medium text-gray-900 hover:text-emerald-600">
                                                    {{ $borrow->book->title }}
                                                </a>
                                                <div class="text-sm text-gray-500">
                                                    by {{ $borrow->book->author }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
                                            <span class="px-2 py-1 text-xs rounded-full {{ $borrow->expected_return_date->isPast() ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800' }}">
                                                {{ $borrow->expected_return_date->isPast() ? 'Overdue' : 'Active' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if(!$borrow->is_returned)
                                            <form action="{{ route('borrows.return', $borrow) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-emerald-600 hover:text-emerald-900">
                                                    Mark as Returned
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">Already Returned</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $borrows->links() }}
                    </div>
                    @else
                    <div class="text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No books borrowed yet!</h3>
                        <p class="mt-1 text-gray-500">There are no borrowing records matching your criteria.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
