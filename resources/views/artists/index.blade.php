@extends('layouts.main')

@section('content')
    <div class="mx-auto mt-8 mb-5 overflow-hidden bg-white rounded-lg shadow-lg ">
        <div class="flex justify-between px-6 py-4 bg-gray-700 rounded-t-lg">
            <h2 class="text-2xl font-semibold text-white">Artist List</h2>
            @can('create', App\Models\Artist::class)
            <a href="{{ route('artists.create') }}"
                class="px-4 py-2 font-bold text-center text-black bg-white rounded hover:bg-gray-200">Create New Artist
            </a>
            @endcan
        </div>

        <ul class="divide-y divide-gray-200">
            @foreach ($artists as $artist)
                <li class="flex items-center px-6 py-4 transition-colors duration-200 hover:bg-gray-50">
                    <span class="mr-4 text-lg font-medium text-gray-700">{{ $loop->iteration }}.</span>
                    <div class="flex-1">
                        <a href="{{ route('artists.show', ['artist' => $artist]) }}">
                            <h3 class="text-lg font-medium text-gray-800">{{ $artist->name }}</h3>
                            {{-- image_path from storage/app/public/artist_images --}}
                            <img src="{{ asset('storage/' . $artist->image_path) }}" alt="artist image"
                                class="w-32 h-32 rounded-full">
                        </a>
                        <p class="text-base text-gray-600"></p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div>
        {{ $artists->links() }}
    </div>
@endsection
