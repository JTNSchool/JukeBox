<x-app-layout>
    <x-slot name="header">
        <div class="relative flex justify-between items-center">
            <div class="flex-shrink-0">
                <a href="{{ route('library') }}" class="inline-block px-2 py-3 bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105">
                    Back to library
                </a>
            </div>

            <h2 class="absolute left-1/3 transform -translate-x-1/2 font-semibold text-xl text-gray-200 leading-tight">
                {{ $playlist->name }}
            </h2>

            <h2 class="absolute left-2/3 transform -translate-x-1/2 font-semibold text-xl text-gray-200 leading-tight">
                {{gmdate('i:s', $songs->sum('duration'))}}
            </h2>

            @if($playlist->user == Auth::id())
                
                <form action="{{ route('playlists.delete', ['id' => $playlist->id]) }}" method="POST" class="flex-shrink-0">
                    @csrf
                    @method('DELETE')

                    <button type="submit" 
                        class="inline-block px-2 py-3 bg-red-500 hover:bg-red-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105"
                        onclick="return confirm('Are you sure you want to delete this playlist?');">
                        Delete Playlist
                    </button>
                </form>
            @endif
        </div>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-100">
                    @if(count($songs) >0) 
                        @foreach($songs as $song)  
                            <div class="mt-5 w-full h-20 bg-gray-700 flex items-center justify-between px-4 rounded">
                                <div class="flex flex-col">
                                    <p class="text-white">{{$song->name}}</p>
                                    <p class="text-gray-400">{{$song->artist}}</p>
                                </div>
                                <p class="text-white">{{gmdate('i:s', $song->duration)}}</p>
                                @if($playlist->user == Auth::id())
                                    <form action="{{ route('songplaylist.delete', ['songid' => $song->id, 'playlistid' => $playlist->id]) }}" method="POST" class="flex-shrink-0">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="inline-block px-2 py-3 bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105">
                                            Remove song
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="text-white">no songs found to add songs go to explore</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>