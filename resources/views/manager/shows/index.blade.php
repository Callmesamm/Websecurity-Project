@extends('layouts.manager')

@section('title', 'Screenings Management')

@section('header', 'Screenings Management')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-neutral-100 overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-100 bg-gradient-to-r from-secondary-500 to-accent-500 text-white">
        <h3 class="font-semibold">All Screenings</h3>
        <a href="{{ route('admin.shows.create') }}" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-md shadow-sm transition-colors backdrop-blur-sm">
            <i class="fas fa-plus mr-2"></i> Add New Screening
        </a>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Movie</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Hall</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Time</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Price</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Seats</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @foreach($shows as $show)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">{{ $show->id }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img
                                        class="h-10 w-10 rounded-md object-cover"
                                        src="{{ $show->movie ? $show->movie->poster_url : '/placeholder.svg' }}"
                                        alt="{{ $show->movie ? $show->movie->title : 'No movie' }}"
                                    >
                                </div>
                                <div class="ml-4">
                                    @if ($show->movie)
                                        <div class="text-sm font-medium text-neutral-900">{{ $show->movie->title }}</div>
                                        <div class="text-sm text-neutral-500">{{ $show->movie->duration }} min</div>
                                    @else
                                        <div class="text-sm font-medium text-neutral-900">No movie</div>
                                        <div class="text-sm text-neutral-500">N/A</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">{{ $show->hall->name }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">{{ \Carbon\Carbon::parse($show->date)->format('M d, Y') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">
                            {{ \Carbon\Carbon::parse($show->start_time)->format('g:i A') }} - 
                            {{ \Carbon\Carbon::parse($show->end_time)->format('g:i A') }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">${{ number_format($show->price, 2) }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-neutral-600">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $show->available_seats }} / {{ $show->total_seats }}
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.shows.edit', $show->id) }}" class="text-secondary-600 hover:text-secondary-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.shows.destroy', $show->id) }}" onsubmit="return confirm('Are you sure you want to delete this screening?');">
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
            {{ $shows->links() }}
        </div>
    </div>
</div>
@endsection
