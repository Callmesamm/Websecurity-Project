@extends('layouts.admin')

@section('title', 'Coming Soon')

@section('header', 'Coming Soon')

@section('content')
<div class="flex flex-col items-center justify-center bg-white rounded-xl shadow-sm border border-neutral-100 p-12 text-center">
    <div class="w-24 h-24 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full flex items-center justify-center mb-6 shadow-lg">
        <i class="fas fa-tools text-4xl text-white"></i>
    </div>
    <h2 class="text-2xl font-bold text-neutral-800 mb-2">This Feature is Coming Soon</h2>
    <p class="text-neutral-500 max-w-md mb-8"> Please check back later. Wait For Us </p>
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
    </a>
</div>
@endsection