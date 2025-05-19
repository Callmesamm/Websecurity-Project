@extends('layouts.admin')

@section('title', 'Roles Management')

@section('header', 'Roles Management')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-neutral-100 overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-100 bg-gradient-to-r from-secondary-500 to-accent-500 text-white">
        <h3 class="font-semibold">All Roles</h3>
        <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-md shadow-sm transition-colors backdrop-blur-sm">
            <i class="fas fa-plus mr-2"></i> Add New Role
        </a>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Users Count</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Permissions Count</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Created At</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @foreach($roles as $role)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">{{ $role->id }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($role->name == 'admin') bg-primary-100 text-primary-800
                                @elseif($role->name == 'manager') bg-secondary-100 text-secondary-800
                                @elseif($role->name == 'cinema-manager') bg-accent-100 text-accent-800
                                @elseif($role->name == 'staff') bg-green-100 text-green-800
                                @else bg-neutral-100 text-neutral-800 @endif">
                                {{ ucfirst($role->name) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">
                            <span class="bg-secondary-50 text-secondary-600 px-2 py-1 rounded-md">{{ $role->users_count }}</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">
                            <span class="bg-green-50 text-green-600 px-2 py-1 rounded-md">{{ $role->permissions_count }}</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">{{ $role->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-secondary-600 hover:text-secondary-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if(!in_array($role->name, ['admin', 'manager', 'customer']))
                                <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-600 hover:text-accent-900" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection