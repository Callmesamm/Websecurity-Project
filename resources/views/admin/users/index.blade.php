@extends('layouts.admin')

@section('title', 'Users Management')

@section('header', 'Users Management')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-neutral-100 overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-100 bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
        <h3 class="font-semibold">All Users</h3>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-md shadow-sm transition-colors backdrop-blur-sm">
            <i class="fas fa-plus mr-2"></i> Add New User
        </a>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Roles</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Created At</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">{{ $user->id }}</td>
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
                                    @else bg-neutral-100 text-neutral-800 @endif mr-1">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @endforeach
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-secondary-600 hover:text-secondary-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-600 hover:text-accent-900" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection