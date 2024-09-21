<x-app-layout>
    <x-slot name="header">
        <div class="relative flex justify-between items-center">
            <div class="flex-shrink-0">
                <a href="{{ route('library') }}" class="inline-block px-2 py-3 bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105">
                    Back to library
                </a>
            </div>

            <h2 class="absolute left-1/2 transform -translate-x-1/2 font-semibold text-xl text-gray-200 leading-tight">
                {{ $playlist->name }}
            </h2>

            <form action="{{ route('playlists.delete', ['id' => $playlist->id]) }}" method="POST" class="flex-shrink-0">
                @csrf
                @method('DELETE')

                <button type="submit" 
                    class="inline-block px-2 py-3 bg-red-500 hover:bg-red-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105"
                    onclick="return confirm('Are you sure you want to delete this playlist?');">
                    Delete Playlist
                </button>
            </form>
        </div>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-100">
                    @foreach($songs as $song)
                        <div class="mt-5 w-full h-20 bg-gray-700 flex items-center justify-between px-4 rounded">
                            <div class="flex flex-col">
                                <p class="text-white">{{$song}}</p>
                                <p class="text-gray-400">ARTIST</p>
                            </div>
                            <p class="text-white">{{gmdate('i:s', 00000000)}}</p>
                            <button class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 rounded">
                                remove from playlist
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>