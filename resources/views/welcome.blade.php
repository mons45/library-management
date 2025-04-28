<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Library Management</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="bg-white min-h-screen">
        <!-- Header -->
        <header class="relative bg-emerald-700">
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-emerald-800 mix-blend-multiply" aria-hidden="true"></div>
            </div>
            <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold tracking-tight text-white md:text-5xl lg:text-6xl">Online Library Management</h1>
                <p class="mt-6 max-w-3xl text-xl text-emerald-100">A modern platform for managing your library's collection, borrowing records, and user accounts.</p>
                <div class="mt-10 flex space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-emerald-800 bg-white hover:bg-emerald-50">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-emerald-800 bg-white hover:bg-emerald-50">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-3 border border-white text-base font-medium rounded-md text-white hover:bg-emerald-600">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <!-- Features -->
        <div class="py-16 bg-gray-50 overflow-hidden lg:py-24">
            <div class="relative max-w-xl mx-auto px-4 sm:px-6 lg:px-8 lg:max-w-7xl">
                <div class="relative">
                    <h2 class="text-center text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">A complete library management solution</h2>
                    <p class="mt-4 max-w-3xl mx-auto text-center text-xl text-gray-500">Everything you need to manage your library efficiently and provide a great experience for users.</p>
                </div>

                <div class="relative mt-12 lg:mt-24 lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                    <div class="relative">
                        <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight sm:text-3xl">For Library Users</h3>
                        <p class="mt-3 text-lg text-gray-500">Easily browse, search, and borrow books from our collection. Manage your borrowings and track return dates.</p>

                        <dl class="mt-10 space-y-10">
                            <div class="relative">
                                <dt>
                                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-600 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Advanced Search</p>
                                </dt>
                                <dd class="mt-2 ml-16 text-base text-gray-500">Easily find books by title, author, category, or availability status.</dd>
                            </div>

                            <div class="relative">
                                <dt>
                                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-600 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Book Borrowing</p>
                                </dt>
                                <dd class="mt-2 ml-16 text-base text-gray-500">Borrow books with a single click and track your current and past borrowings.</dd>
                            </div>

                            <div class="relative">
                                <dt>
                                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-600 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Due Date Tracking</p>
                                </dt>
                                <dd class="mt-2 ml-16 text-base text-gray-500">Get clear information about when your books are due and easily return them on time.</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-10 -mx-4 relative lg:mt-0" aria-hidden="true">
                        <div class="relative mx-auto rounded-lg shadow-lg overflow-hidden">
                            <img class="relative mx-auto" width="490" src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2048&q=80" alt="Library books">
                        </div>
                    </div>
                </div>

                <div class="relative mt-12 sm:mt-16 lg:mt-24">
                    <div class="lg:grid lg:grid-flow-row-dense lg:grid-cols-2 lg:gap-8 lg:items-center">
                        <div class="lg:col-start-2">
                            <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight sm:text-3xl">For Administrators</h3>
                            <p class="mt-3 text-lg text-gray-500">Powerful tools to manage your library catalog, monitor borrowings, and generate insightful reports.</p>

                            <dl class="mt-10 space-y-10">
                                <div class="relative">
                                    <dt>
                                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-600 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Book Management</p>
                                    </dt>
                                    <dd class="mt-2 ml-16 text-base text-gray-500">Add, edit, and remove books from your catalog with an intuitive interface.</dd>
                                </div>

                                <div class="relative">
                                    <dt>
                                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-600 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Comprehensive Reports</p>
                                    </dt>
                                    <dd class="mt-2 ml-16 text-base text-gray-500">Access detailed analytics about book popularity, user activity, and overdue books.</dd>
                                </div>

                                <div class="relative">
                                    <dt>
                                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-600 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">User Management</p>
                                    </dt>
                                    <dd class="mt-2 ml-16 text-base text-gray-500">Monitor user activity and manage permissions for library staff and patrons.</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="mt-10 -mx-4 relative lg:mt-0 lg:col-start-1">
                            <div class="relative mx-auto rounded-lg shadow-lg overflow-hidden">
                                <img class="relative mx-auto" width="490" src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" alt="Admin dashboard">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-emerald-700">
            <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Ready to get started?</span>
                </h2>
                <p class="mt-4 text-lg leading-6 text-emerald-100">Create an account to start exploring our library collection or sign in if you already have an account.</p>
                <div class="mt-8 flex justify-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-emerald-700 bg-white hover:bg-emerald-50">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-emerald-700 bg-white hover:bg-emerald-50 sm:mr-3">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md bg-emerald-900 text-white hover:bg-emerald-800">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white">
            <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
                <p class="mt-8 text-center text-base text-gray-500">&copy; 2023 Online Library Management. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
