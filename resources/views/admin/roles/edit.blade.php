@extends('layouts.admin')

@section('title', 'Edit Role')

@section('header', 'Edit Role')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Role Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                   {{ in_array($role->name, ['admin', 'manager', 'customer']) ? 'readonly' : '' }} required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Assign Permissions</label>
            
            <div class="mb-4">
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="select-all" class="mr-2">
                    <label for="select-all" class="font-semibold">Select All Permissions</label>
                </div>
            </div>
            
            @php
                $groupedPermissions = $permissions->groupBy(function($permission) {
                    return explode('-', $permission->name)[0];
                });
            @endphp
            
            @foreach($groupedPermissions as $group => $items)
            <div class="mb-4">
                <h4 class="font-semibold text-indigo-700 mb-2 capitalize">{{ $group }} Management</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 ml-4">
                    @foreach($items as $permission)
                    <div class="flex items-center">
                        <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" 
                               value="{{ $permission->id }}" class="permission-checkbox mr-2"
                               {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                        <label for="permission_{{ $permission->id }}">
                            {{ ucfirst(explode('-', $permission->name)[1]) }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
            
            @error('permissions')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <a href="{{ route('admin.roles.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded mr-2">
                Cancel
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                Update Role
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
        
        // Check if all permissions are already selected
        const allChecked = Array.from(permissionCheckboxes).every(c => c.checked);
        selectAllCheckbox.checked = allChecked;
        
        selectAllCheckbox.addEventListener('change', function() {
            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
        
        permissionCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(permissionCheckboxes).every(c => c.checked);
                selectAllCheckbox.checked = allChecked;
            });
        });
    });
</script>
@endsection