<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Library') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('playlists.create') }}" class="bg-green-500 text-white px-4 py-4 rounded hover:bg-green-600">
                    New Playlist
                    {{ $playlists }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>