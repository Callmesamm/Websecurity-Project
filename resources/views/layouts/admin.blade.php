<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Cinema Admin</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                        },
                        secondary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        },
                        accent: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            200: '#fecdd3',
                            300: '#fda4af',
                            400: '#fb7185',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be123c',
                            800: '#9f1239',
                            900: '#881337',
                        },
                        neutral: {
                            50: '#fafafa',
                            100: '#f5f5f5',
                            200: '#e5e5e5',
                            300: '#d4d4d4',
                            400: '#a3a3a3',
                            500: '#737373',
                            600: '#525252',
                            700: '#404040',
                            800: '#262626',
                            900: '#171717',
                        },
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        .sidebar-active {
            background-color: rgba(255, 255, 255, 0.08);
            border-left: 3px solid #8b5cf6;
        }
        .dashboard-card {
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #4c1d95 0%, #6d28d9 100%);
        }
    </style>
</head>
<body class="bg-neutral-50 text-neutral-800">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="gradient-bg text-white w-64 flex-shrink-0 shadow-lg">
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-film text-2xl text-primary-300"></i>
                    <h1 class="text-xl font-bold tracking-wider">CINEMA ADMIN</h1>
                </div>
            </div>
            <div class="p-4">
                <div class="flex items-center space-x-3 mb-6 p-3 bg-white/5 rounded-lg backdrop-blur-sm">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-accent-500 to-accent-600 flex items-center justify-center">
                        <span class="font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-primary-200">Administrator</p>
                    </div>
                </div>
            </div>
            <nav class="mt-2 px-4">
                <p class="text-xs text-primary-300 font-semibold mb-2 px-3">MAIN MENU</p>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 py-3 px-3 rounded-lg mb-1 hover:bg-white/5 {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-tachometer-alt text-primary-300"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 py-3 px-3 rounded-lg mb-1 hover:bg-white/5 {{ request()->routeIs('admin.users.*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-users text-primary-300"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.roles.index') }}" class="flex items-center space-x-3 py-3 px-3 rounded-lg mb-1 hover:bg-white/5 {{ request()->routeIs('admin.roles.*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-user-tag text-primary-300"></i>
                    <span>Roles</span>
                </a>
                
                <p class="text-xs text-primary-300 font-semibold mt-6 mb-2 px-3">CINEMA MANAGEMENT</p>

                <a href="{{ route('admin.movies.index') }}" class="flex items-center space-x-3 py-3 px-3 rounded-lg mb-1 hover:bg-white/5 {{ request()->routeIs('admin.movies.*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-video text-primary-300"></i>
                    <span>Movies</span>
                </a>
                <a href="{{ route('admin.shows.index') }}" class="flex items-center space-x-3 py-3 px-3 rounded-lg mb-1 hover:bg-white/5 {{ request()->routeIs('admin.screenings.*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-calendar-alt text-primary-300"></i>
                    <span>Screenings</span>
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="flex items-center space-x-3 py-3 px-3 rounded-lg mb-1 hover:bg-white/5 {{ request()->routeIs('admin.bookings.*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-ticket-alt text-primary-300"></i>
                    <span>Bookings</span>
                </a>
            </nav>
            
            <div class="mt-auto p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 py-3 px-3 w-full rounded-lg text-left hover:bg-white/5 text-primary-200 hover:text-white">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-neutral-100">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-neutral-800">@yield('header', 'Dashboard')</h2>
                        <p class="text-sm text-neutral-500">Welcome back, {{ Auth::user()->name }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                         <a href="{{ route('home') }}" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                      <i class="fas fa-home mr-2"></i>Return to Home
                      </a>
                        <button class="p-2 rounded-full bg-neutral-100 text-neutral-600 hover:bg-neutral-200 transition-colors">
                            <i class="fas fa-bell"></i>
                        </button>
                        <button class="p-2 rounded-full bg-neutral-100 text-neutral-600 hover:bg-neutral-200 transition-colors">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
            
            <!-- Footer -->
            <footer class="bg-white border-t border-neutral-100 py-4 px-6">
                <div class="flex justify-between items-center">
                    <p class="text-sm text-neutral-500">© {{ date('Y') }} Cinema Admin. All rights reserved.</p>
                    <p class="text-sm text-neutral-500">Version 1.0.0</p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>