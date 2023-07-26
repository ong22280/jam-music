@extends('layouts.main')

@section('content')
    <div class="w-full mt-8">
        <h1 class="mb-4 text-center text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
            <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Add New Song</span>
        </h1>
        <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
            <form action="{{ route('artists.songs.store', ['artist' => $artist]) }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block mb-2 font-bold text-gray-600">Artist Name</label>
                    <span>{{ $artist->name }}</span>
                </div>

                <div class="mb-5">
                    <label for="title" class="block mb-2 font-bold text-gray-600">Song Title</label>
                    <input require type="text" id="title" name="title" placeholder="Put in song title"
                        class="border border-gray-300 shadow p-3 w-full rounded mb-">
                </div>

                <div class="mb-5">
                    <label for="duration" class="block mb-2 font-bold text-gray-600">Song Duration</label>
                    <input require type="number" id="duration" name="duration" placeholder="Put in song duration"
                        min="1" class="border border-gray-300 shadow p-3 w-full rounded mb-">
                </div>

                <button type="submit" class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">Submit</button>
            </form>
        </div>
    </div>
@endsection
