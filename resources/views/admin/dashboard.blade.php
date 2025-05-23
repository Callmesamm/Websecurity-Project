@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header', 'Dashboard Overview')

@section('content')
<div class="mb-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Users Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 dashboard-card border border-neutral-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-primary-50 text-primary-600">
                    <i class="fas fa-users fa-lg"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-neutral-500">Total Users</h3>
                    <div class="flex items-center">
                        <p class="text-2xl font-bold text-neutral-800">{{ $userCount }}</p>
                        <span class="ml-2 text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-arrow-up mr-1"></i>12%
                        </span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-neutral-100">
                <a href="{{ route('admin.users.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                    View all users <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <!-- Movies Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 dashboard-card border border-neutral-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-secondary-50 text-secondary-600">
                    <i class="fas fa-film fa-lg"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-neutral-500">Total Movies</h3>
                    <div class="flex items-center">
                        <p class="text-2xl font-bold text-neutral-800">{{ $movieCount ?? 0 }}</p>
                        <span class="ml-2 text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-arrow-up mr-1"></i>8%
                        </span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-neutral-100">
                <a href="{{ route('admin.movies.index') }}" class="text-sm text-secondary-600 hover:text-secondary-700 font-medium">
                    View all movies <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <!-- Cinemas Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 dashboard-card border border-neutral-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-accent-50 text-accent-600">
                    <i class="fas fa-building fa-lg"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-neutral-500">Total Cinemas</h3>
                    <div class="flex items-center">
                        <p class="text-2xl font-bold text-neutral-800">{{ $cinemaCount ?? 0 }}</p>
                        <span class="ml-2 text-xs font-medium text-yellow-500 bg-yellow-50 px-2 py-1 rounded-full">
                            <i class="fas fa-equals mr-1"></i>0%
                        </span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-neutral-100">
                <a href="{{ route('admin.cinemas.index') }}" class="text-sm text-accent-600 hover:text-accent-700 font-medium">
                    View all cinemas <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <!-- Bookings Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 dashboard-card border border-neutral-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-amber-50 text-amber-600">
                    <i class="fas fa-ticket-alt fa-lg"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-neutral-500">Total Bookings</h3>
                    <div class="flex items-center">
                        <p class="text-2xl font-bold text-neutral-800">{{ $bookingCount ?? 0 }}</p>
                        <span class="ml-2 text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-arrow-up mr-1"></i>24%
                        </span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-neutral-100">
                <a href="{{ route('admin.bookings.index') }}" class="text-sm text-amber-600 hover:text-amber-700 font-medium">
                    View all bookings <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Users -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-neutral-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-neutral-100 bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
            <h3 class="font-semibold">Recent Users</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Role</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                        @foreach($recentUsers as $user)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-medium">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-neutral-800">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">{{ $user->email }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @foreach($user->roles as $role)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($role->name == 'admin') bg-primary-100 text-primary-800
                                        @elseif($role->name == 'manager') bg-secondary-100 text-secondary-800
                                        @elseif($role->name == 'cinema-manager') bg-accent-100 text-accent-800
                                        @elseif($role->name == 'staff') bg-green-100 text-green-800
                                        @else bg-neutral-100 text-neutral-800 @endif">
                                        {{ ucfirst($role->name) }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- User Roles Distribution -->
    <div class="bg-white rounded-xl shadow-sm border border-neutral-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-neutral-100 bg-gradient-to-r from-secondary-500 to-accent-500 text-white">
            <h3 class="font-semibold">User Roles Distribution</h3>
        </div>
        <div class="p-6">
            <div class="space-y-5">
                @foreach($roleStats as $role)
                <div>
                    <div class="flex justify-between mb-1">
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full 
                                @if($role->name == 'admin') bg-primary-500
                                @elseif($role->name == 'manager') bg-secondary-500
                                @elseif($role->name == 'cinema-manager') bg-accent-500
                                @elseif($role->name == 'staff') bg-green-500
                                @else bg-neutral-500 @endif mr-2"></span>
                            <span class="text-sm font-medium text-neutral-700">{{ ucfirst($role->name) }}</span>
                        </div>
                        <span class="text-sm font-medium text-neutral-700">{{ $role->users_count }} users</span>
                    </div>
                    <div class="w-full bg-neutral-100 rounded-full h-2">
                        <div class="h-2 rounded-full 
                            @if($role->name == 'admin') bg-gradient-to-r from-primary-400 to-primary-600
                            @elseif($role->name == 'manager') bg-gradient-to-r from-secondary-400 to-secondary-600
                            @elseif($role->name == 'cinema-manager') bg-gradient-to-r from-accent-400 to-accent-600
                            @elseif($role->name == 'staff') bg-gradient-to-r from-green-400 to-green-600
                            @else bg-gradient-to-r from-neutral-400 to-neutral-600 @endif" 
                            style="width: {{ ($role->users_count / max($userCount, 1)) * 100 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-6 pt-6 border-t border-neutral-100">
                <a href="{{ route('admin.roles.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                    Manage roles <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-6 bg-white rounded-xl shadow-sm border border-neutral-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-neutral-100 bg-gradient-to-r from-accent-500 to-primary-500 text-white">
        <h3 class="font-semibold">Quick Actions</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.users.create') }}" class="flex items-center p-4 bg-neutral-50 rounded-lg hover:bg-neutral-100 transition-colors border border-neutral-100">
                <div class="p-2 rounded-md bg-primary-100 text-primary-600 mr-3">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-neutral-800">Add New User</h4>
                    <p class="text-xs text-neutral-500">Create user account</p>
                </div>
            </a>
            
            <a href="{{ route('admin.roles.create') }}" class="flex items-center p-4 bg-neutral-50 rounded-lg hover:bg-neutral-100 transition-colors border border-neutral-100">
                <div class="p-2 rounded-md bg-secondary-100 text-secondary-600 mr-3">
                    <i class="fas fa-user-tag"></i>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-neutral-800">Create Role</h4>
                    <p class="text-xs text-neutral-500">Define new user role</p>
                </div>
            </a>
            
            <a href="{{ route('admin.cinemas.index') }}" class="flex items-center p-4 bg-neutral-50 rounded-lg hover:bg-neutral-100 transition-colors border border-neutral-100">
                <div class="p-2 rounded-md bg-accent-100 text-accent-600 mr-3">
                    <i class="fas fa-building"></i>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-neutral-800">Manage Cinemas</h4>
                    <p class="text-xs text-neutral-500">Add or edit cinema locations</p>
                </div>
            </a>
            
            <a href="{{ route('admin.movies.index') }}" class="flex items-center p-4 bg-neutral-50 rounded-lg hover:bg-neutral-100 transition-colors border border-neutral-100">
                <div class="p-2 rounded-md bg-amber-100 text-amber-600 mr-3">
                    <i class="fas fa-film"></i>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-neutral-800">Manage Movies</h4>
                    <p class="text-xs text-neutral-500">Add or edit movie listings</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection