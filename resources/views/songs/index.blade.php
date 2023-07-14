@extends('layouts.main')

@section('content')
    <div class="max-w-lg mx-auto mt-16 overflow-hidden bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 bg-gray-700 rounded-t-lg">
            <h2 class="text-2xl font-semibold text-white">{{ $title }}</h2>
        </div>
        <ul class="divide-y divide-gray-200">
            @foreach ($songs as $song)
                <li class="flex items-center px-6 py-4 transition-colors duration-200 hover:bg-gray-50">
                    <span class="mr-4 text-lg font-medium text-gray-700">{{ $loop->iteration }}.</span>
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-800">{{ $song['title'] }}</h3>
                        <p class="text-base text-gray-600">{{ $song['artist'] }}</p>
                        <span
                            class="text-gray-400">{{ $song['duration']['minutes'] }}:{{ $song['duration']['seconds'] < 10 ? '0' . $song['duration']['seconds'] : $song['duration']['seconds'] }}</span>
                    </div>
                    <div class="flex flex-col items-end">

                        <div class="mt-2 overflow-hidden rounded-xl">
                            <iframe width="270" height="150"
                                src="https://www.youtube.com/embed/{{ $song['youtube_id'] }}" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
