@extends('layouts.main')

@section('content')
    <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-gray-600 md:text-5xl lg:text-6xl"><span
            class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Playlists Name </span>
        {{ $playlist->name }}</h1>
    <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where
        technology, innovation, and capital can unlock long-term value and drive economic growth.</p>

    <hr class="my-6 border-2 border-gray-200 rounded-full dark:border-gray-700">

    <div class="flex justify-between">
        <h2 class="text-2xl font-bold">Songs in this Playlist:</h2>
        <div>
            <a href="{{ route('playlists.edit', ['playlist' => $playlist]) }}"
                class="inline-block px-6 py-2 mr-4 text-xs font-semibold text-white uppercase bg-blue-600 rounded hover:bg-blue-700 mb-4">
                Edit</a>
            <a href="{{ route('playlists.songs.add', ['playlist' => $playlist]) }}"
                class="inline-block px-6 py-2 text-xs font-semibold text-white uppercase bg-green-600 rounded hover:bg-green-700 mb-4">
                Add New Song</a>
        </div>
    </div>

    @foreach ($playlist->songs as $song)
        <div class="mb-4 bg-white rounded shadow-md p-6">
            <h3 class="text-xl font-bold mb-2">{{ $song->title }}</h3>
            <p class="text-gray-700">Artist: {{ $song->artist->name }}</p>
        </div>
    @endforeach
@endsection
