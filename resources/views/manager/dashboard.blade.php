@extends('layouts.manager')

@section('title', 'Dashboard')

@section('header', 'Dashboard Overview')

@section('content')
<div class="mb-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
     
        
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
       


<!-- Quick Actions -->
<div class="mt-6 bg-white rounded-xl shadow-sm border border-neutral-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-neutral-100 bg-gradient-to-r from-accent-500 to-primary-500 text-white">
        <h3 class="font-semibold">Quick Actions</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
       
            
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