@extends('layouts.main')

@section('content')
    <h1
        class="mb-4 text-3xl font-extrabold md:text-5xl lg:text-6xl text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
        Add new playlists</h1>
    <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where
        technology, innovation, and capital can unlock long-term value and drive economic growth.</p>

    <hr class="my-6 border-2 border-gray-200 rounded-full dark:border-gray-700">

    <h1 class="text-3xl font-bold mb-4">Create a new Playlist</h1>

    <form action="{{ route('playlists.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Playlist Name
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name" type="text" placeholder="Playlist Name" name="name">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="accessibility">
                Accessibility
            </label>
            <select
                class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                id="accessibility" name="accessibility">
                <option value="PUBLIC">PUBLIC</option>
                <option value="PRIVATE">PRIVATE</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Create Playlist
            </button>
        </div>
    </form>
@endsection
