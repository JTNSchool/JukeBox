<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-100">
                    @foreach($songs as $song)
                        <div class="mt-5 w-full h-20 bg-gray-700 flex items-center justify-between px-4 rounded">
                            <div class="flex flex-col">
                                <p class="text-white">{{$song->name}}</p>
                                <p class="text-gray-400">{{$song->artist}}</p>
                            </div>

                        <p class="text-white">{{gmdate('i:s', $song->duration)}}</p>
                            
                            <button class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 rounded">
                                Add to playlist
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>