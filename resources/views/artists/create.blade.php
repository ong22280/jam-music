@extends('layouts.main')

@section('content')
    <div class="w-full mt-8">
        <h1 class="mb-4 text-center text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
            <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Create New Artist</span>
        </h1>
        <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
            <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="name" class="block mb-2 font-bold text-gray-600">Artist Name</label>
                    <input type="text" id="name" name="name" placeholder="Put in artist name"
                        class="border border-gray-300 shadow p-3 w-full rounded">
                    <label for="image_path" class="block mb-2 font-bold text-gray-600">Artist Image</label>
                    <input type="file" name="image_path" id="image_path"
                        class="border border-gray-300 shadow p-3 w-full rounded">
                </div>
                <button type="submit" class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">Submit</button>
            </form>
        </div>
    </div>
@endsection
