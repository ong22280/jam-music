<nav class="p-4 text-white shadow-md bg-gradient-to-r from-gray-900 via-gray-700 to-gray-500">
    <div class="container mx-auto md:flex md:justify-between md:items-center">
        <div class="flex items-center justify-between">
            <div>
                <a href="#" class="text-2xl font-bold transition-colors duration-200 md:text-3xl hover:text-gray-100">
                    <img src="https://www.svgrepo.com/show/499962/music.svg" class="inline-block w-12 h-12 mr-2" alt="Logo">
                    <span>Music Lover</span>
                </a>
            </div>

            <div class="md:hidden">
                <button type="button" class="text-white hover:text-gray-200 focus:outline-none focus:text-gray-200" aria-label="toggle menu">
                    <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                        <path fill-rule="evenodd" d="M4 5a1 1 0 011-1h14a1 1 0 110 2H5a1 1 0 01-1-1zM4 11a1 1 0 011-1h14a1 1 0 110 2H5a1 1 0 01-1-1zM4 17a1 1 0 011-1h14a1 1 0 110 2H5a1 1 0 01-1-1z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="items-center md:flex">
            <div class="flex flex-col mt-2 text-lg md:flex-row md:mt-0 md:mx-6">
                <a href="{{ url('/') }}" class="p-2 duration-300 rounded mx-2transition-colors hover:bg-gray-900 hover:text-white">Welcome</a>
                <a href="{{ route('songs.index') }}" class="p-2 mx-2 transition-colors duration-300 rounded hover:bg-gray-900 hover:text-white">Song Playlist</a>
                <a href="{{ route('artists.index') }}" class="p-2 mx-2 transition-colors duration-300 rounded hover:bg-gray-900 hover:text-white">Artists</a>
                <a href="{{ route('about.index') }}" class="p-2 mx-2 transition-colors duration-300 rounded hover:bg-gray-900 hover:text-white">About</a>
                <a href="{{ route('tasks.index') }}" class="p-2 mx-2 transition-colors duration-300 rounded hover:bg-gray-900 hover:text-white">Task</a>
            </div>

            <div class="hidden md:block">
                <a href="#" class="relative px-4 py-2 text-sm text-gray-700 transition-colors duration-300 bg-white rounded hover:bg-gray-100 focus:outline-none">
                    Download
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</nav>
