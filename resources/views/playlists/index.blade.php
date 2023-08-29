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

    {{-- search, sort, filter --}}
    <div class="mb-4">
        <form action="{{ route('playlists.index') }}" method="GET" class="flex items-center space-x-3 mt-3">
            <!-- Search Input -->
            <div class="flex-grow">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Playlists..."
                    class="w-full p-2 rounded border-2 focus:outline-none focus:border-blue-500">
            </div>
            <!-- Sort Dropdown -->
            <div class="relative">
                <select name="sort"
                    class="appearance-none border-2 rounded p-2 pr-14 bg-white cursor-pointer focus:outline-none focus:border-blue-500"
                    onchange="this.form.submit()">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                </select>
            </div>
            <!-- Filter Dropdown -->
            <div class="relative">
                <select name="accessibility"
                    class="appearance-none border-2 rounded p-2 pr-14  bg-white cursor-pointer focus:outline-none focus:border-blue-500"
                    onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="PUBLIC" {{ request('accessibility') == 'PUBLIC' ? 'selected' : '' }}>Public</option>
                    <option value="PRIVATE" {{ request('accessibility') == 'PRIVATE' ? 'selected' : '' }}>Private</option>
                </select>
            </div>

        </form>
    </div>

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
        {{ $playlists->appends([
                'accessibility' => request('accessibility'),
                'search' => request('search'),
                'sort' => request('sort'),
            ])->links() }}
    </div>
@endsection
