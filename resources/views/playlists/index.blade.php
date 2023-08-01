@extends('layouts.main')

@section('content')
    <div class="flex items-center justify-between">
        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-gray-600 md:text-5xl lg:text-6xl">
            <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Playlists of</span>
            {{ $user->name }}
        </h1>
        <a href="{{ route('playlists.create') }}"
            class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            New Playlist
        </a>
    </div>
    <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where
        technology, innovation, and capital can unlock long-term value and drive economic growth.</p>

    <hr class="my-6 border-2 border-gray-200 rounded-full dark:border-gray-700">

    {{-- loop show my playlist --}}
    @foreach ($playlists as $playlist)
        <div class="flex items-center bg-white shadow-lg overflow-hidden mb-4 rounded-xl">
            <div class="px-6 py-4">
                <div class="flex items-baseline">
                    @if ($playlist->accessibility->value == 'PUBLIC')
                        <span
                            class="inline-block bg-green-200 text-green-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">Public</span>
                    @elseif($playlist->accessibility->value == 'PRIVATE')
                        <span
                            class="inline-block bg-red-200 text-red-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">Private</span>
                    @endif
                    <div class="ml-2 text-gray-600 text-xs uppercase font-semibold tracking-wide">
                        {{ $playlist->songs->count() }} songs
                    </div>
                </div>
                <h4 class="mt-1 text-xl font-semibold leading-tight truncate">{{ $playlist->name }}</h4>
            </div>
            <div class="ml-auto pr-6">
                <a href="{{ route('playlists.show', $playlist->id) }}"
                    class="text-blue-500 hover:text-blue-700 transition duration-150 ease-in-out">View Playlist &rarr;</a>
            </div>
        </div>
    @endforeach

    <div class="mt-5">
        {{ $playlists->links() }}
    </div>
@endsection
