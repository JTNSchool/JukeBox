<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Create Playlist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-gray-800 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('playlists.store') }}">
                    @csrf

                    <!-- Playlist Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300">Playlist Name</label>
                        <input id="name" type="text" name="name" class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Create Playlist
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
