@extends('layouts.main')

@section('content')
    <div class="w-full max-w-md mx-auto mt-20">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">Edit Playlist</h1>
            <form action="{{ route('playlists.update', $playlist) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Playlist Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name')
                        border-red-500
                    @enderror"
                        id="name" type="text" placeholder="Playlist Name" name="name"
                        value="{{ old('name', $playlist->name) }}">
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="accessibility">
                        Accessibility
                    </label>
                    <select id="accessibility" name="accessibility"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="PUBLIC" @if ($playlist->accessibility == 'PUBLIC') selected @endif>PUBLIC</option>
                        <option value="PRIVATE" @if ($playlist->accessibility == 'PRIVATE') selected @endif>PRIVATE</option>
                    </select>
                    @error('accessibility')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
