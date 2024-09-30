<x-app-layout>
    <x-slot name="header">
        <div class="relative flex justify-between items-center">
            <div class="flex-shrink-0">
                <a href="{{ route('explore') }}" class="inline-block px-2 py-3 bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105">
                    Back to explore
                </a>
            </div>

            <h2 class="absolute left-1/2 transform -translate-x-1/2 font-semibold text-xl text-gray-200 leading-tight">
                Select a playlist where you want to add the song: {{$song->name}}
            </h2>
        </div>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-gray-800 rounded-lg shadow-lg">
                @if(count($playlists) > 0) 
                    @foreach($playlists as $playlist)
                        @if($playlist->user == Auth::id())
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                                <a href="{{ route('songplaylist.addsongtoplaylist', ['songid' => $song->id, 'playlistid' => $playlist->id]) }}" class="flex items-center justify-center px-4 py-6 bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105">
                                    {{$playlist->name}}
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>