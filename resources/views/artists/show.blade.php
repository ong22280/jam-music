@extends('layouts.main')

@section('content')
    <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-gray-600 md:text-5xl lg:text-6xl"><span
            class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Artist: </span>
        {{ $artist->name }}</h1>
    <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where
        technology, innovation, and capital can unlock long-term value and drive economic growth.</p>

    <div class=" mx-auto mt-8 overflow-hidden bg-white rounded-lg shadow-lg mb-5">
        <div class="px-6 py-4 bg-gray-700 rounded-t-lg flex justify-between">
            <h2 class="text-2xl font-semibold text-white">Songs</h2>
            <div class="mt-1">
                @can('create', App\Models\Artist::class)
                    <a href="{{ route('artists.edit', ['artist' => $artist]) }}"
                        class="bg-white hover:bg-gray-200 text-black font-bold py-2 px-4 rounded text-center mr-2">Edit</a>
                @endcan

                @if ($artist->songs->isEmpty())
                    <form action="{{ route('artists.destroy', ['artist' => $artist]) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-white hover:bg-gray-200 text-black font-bold py-2 px-4 rounded text-center mr-2">
                            Delete
                        </button>
                    </form>
                @endif
                <a href="{{ route('artists.songs.create', ['artist' => $artist]) }}"
                    class="bg-white hover:bg-gray-200 text-black font-bold py-2 px-4 rounded text-center">Add New Song
                </a>
            </div>

        </div>
        <ul class="divide-y divide-gray-200">

            @foreach ($artist->songs as $song)
                <li class="flex items-center px-6 py-4 transition-colors duration-200 hover:bg-gray-50">
                    <span class="mr-4 text-lg font-medium text-gray-700">{{ $loop->iteration }}.</span>
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-800">{{ $song->title }}</h3>
                        <p class="text-base text-gray-600">{{ $song->artist->name }}</p>
                        <span class="text-gray-400">{{ $song->duration_to_string }}</span>
                    </div>
                    <div class="flex flex-col items-end">

                        <div class="mt-2 overflow-hidden rounded-xl">
                            <iframe width="270" height="150"
                                src="https://www.youtube.com/embed/{{ $song->youtube_id }}" title="YouTube video player"
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
