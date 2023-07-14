@extends('layouts.main')

@section('content')
    <div class="max-w-lg mx-auto mt-16 overflow-hidden bg-white rounded-md shadow-md">
        <div class="px-4 py-2 bg-pink-100">
            <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
        </div>
        <ul class="divide-y divide-gray-200">
            @foreach ($songs as $song)
            <li class="flex items-center px-6 py-4 hover:bg-gray-50">
                <span class="mr-4 text-lg font-medium text-gray-700">{{ $loop->iteration }}.</span>
                <div class="flex-1">
                    <h3 class="text-lg font-medium text-gray-800">{{ $song['title'] }}</h3>
                    <p class="text-base text-gray-600">{{ $song['artist'] }}</p>
                </div>
                <span class="text-gray-400">{{ $song['duration']['minutes'] }}:{{ $song['duration']['seconds'] }}</span>
            </li>
            @endforeach
        </ul>
    </div>
@endsection