@extends('layouts.main')

@section('content')
    <div class="w-full max-w-md mx-auto mt-20">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">Add Song to Playlist</h1>
            <form action="{{ route('playlists.songs.store', $playlist->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="song_id">
                        Select a Song
                    </label>
                    <select id="song_id" name="song_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach($songs as $song)
                            <option value="{{ $song->id }}">{{ $song->title }}</option>
                        @endforeach
                    </select>
                    @error('song_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Add Song
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
