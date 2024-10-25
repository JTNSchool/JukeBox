<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Library') }}
        </h2>
    </x-slot>

    @php 
        $sessionPlaylists = session('sessionPlaylists', []);
    @endphp


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-gray-800 rounded-lg shadow-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach ($combinedPlaylists as $playlist)
                    <div class="playlist-item">
                        @if (is_array($playlist))
                            <div>
                                <a href="{{ route('session.playlists.show', $playlist['id']) }} " class="flex items-center justify-center px-4 py-6 bg-yellow-500 hover:bg-yellow-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105">{{ $playlist['name'] }}</a>
                            </div>
                        @else
                            <div>
                                <a href="{{ route('playlists.show', $playlist->id) }}" class="flex items-center justify-center px-4 py-6 bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105">{{ $playlist->name }}</a>
                            </div>
                        @endif
                    </div>
                @endforeach

                <a href="{{ route('playlists.create') }}" class="flex items-center justify-center px-4 py-6 bg-green-500 hover:bg-green-600 text-white text-lg font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105">
                    Create Playlist
                </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
