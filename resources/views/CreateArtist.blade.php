<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Artist') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">

                    <form action="{{ isset($artist) ? route('UpdateArtist', $artist->id) : route('Store-artist') }}" method="POST" class="mb-3">
                        @csrf
                        @if(isset($artist))
                            @method('PUT')
                        @endif
                    
                        <!-- Code Input -->
                        <div class="mb-4">
                            <label for="code" class="block text-gray-600 font-medium mb-1">Code</label>
                            <input type="text" id="code" name="code" value="{{ old('code', $artist->code ?? '') }}" placeholder="Enter code"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('code') border-red-500 @enderror">
                        
                                @error('code')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>
                    
                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-600 font-medium mb-1">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $artist->name ?? '') }}" placeholder="Enter your name"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('name') border-red-500 @enderror">
                        
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>
                    
                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-green-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">
                            {{ isset($artist) ? 'Update' : 'Create' }}
                        </button>
                    </form>

                    <a href="{{ route('Artist') }}" class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                        Go back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
