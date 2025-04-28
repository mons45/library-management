<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('books.show', $book) }}" class="mr-2 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Book') }}: {{ $book->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="author" class="block text-sm font-medium text-gray-700">Author <span class="text-red-500">*</span></label>
                                    <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                    @error('author')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="publication_year" class="block text-sm font-medium text-gray-700">Publication Year <span class="text-red-500">*</span></label>
                                    <input type="number" name="publication_year" id="publication_year" value="{{ old('publication_year', $book->publication_year) }}" required min="1000" max="{{ date('Y') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                    @error('publication_year')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                                    <select name="category" id="category" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                        <option value="">Select a category</option>
                                        <option value="Fiction" {{ old('category', $book->category) == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                                        <option value="Non-Fiction" {{ old('category', $book->category) == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                                        <option value="Science" {{ old('category', $book->category) == 'Science' ? 'selected' : '' }}>Science</option>
                                        <option value="History" {{ old('category', $book->category) == 'History' ? 'selected' : '' }}>History</option>
                                        <option value="Biography" {{ old('category', $book->category) == 'Biography' ? 'selected' : '' }}>Biography</option>
                                        <option value="Fantasy" {{ old('category', $book->category) == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                                        <option value="Technology" {{ old('category', $book->category) == 'Technology' ? 'selected' : '' }}>Technology</option>
                                        <option value="Romance" {{ old('category', $book->category) == 'Romance' ? 'selected' : '' }}>Romance</option>
                                        <option value="Mystery" {{ old('category', $book->category) == 'Mystery' ? 'selected' : '' }}>Mystery</option>
                                        <option value="Other" {{ old('category', $book->category) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('category')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover Image</label>
                                    
                                    @if($book->cover_image)
                                    <div class="mt-2 mb-3">
                                        <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-40 h-auto object-cover rounded border">
                                        <p class="mt-1 text-sm text-gray-500">Current cover image</p>
                                    </div>
                                    @endif
                                    
                                    <input type="file" name="cover_image" id="cover_image" accept="image/*"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                    <p class="mt-1 text-sm text-gray-500">Upload a new image to replace the current one (JPEG, PNG, or GIF, max 2MB).</p>
                                    @error('cover_image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="6"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
                                        placeholder="Enter a brief description of the book...">{{ old('description', $book->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('books.show', $book) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md transition-colors">
                                Update Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
