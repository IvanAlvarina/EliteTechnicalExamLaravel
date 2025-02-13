<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Album') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">

                    <form action="{{ isset($album) ? route('UpdateAlbum', $album->id) : route('Store-album') }}" method="POST" enctype="multipart/form-data" class="mb-3">
                        @csrf

                        @if(isset($album))
                            @method('PUT')
                        @endif

                        <!-- Album Cover Image Upload -->
                        <div x-data="{ previewUrl: '{{ isset($album) && $album->album_cover_path ? asset('storage/' . $album->album_cover_path) : '' }}' }" class="mb-4">
                            <label for="cover_image" class="block text-gray-600 font-medium mb-1">Album Cover</label>
                            <input type="file" id="cover_image" name="cover_image" accept="image/*"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 
                                    @error('cover_image') border-red-500 @enderror"
                                @change="previewUrl = URL.createObjectURL($event.target.files[0])">
                            
                            @error('cover_image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <!-- Image Preview -->
                            <div class="mt-2" x-show="previewUrl">
                                <img :src="previewUrl" class="w-100% h-50 object-cover rounded-lg shadow-md">
                            </div>
                        </div>
                    
                        <!-- Artist Select Input -->
                        <div class="mb-4">
                            <label for="artist_id" class="block text-gray-600 font-medium mb-1">Artist</label>
                            <select id="artist_id" name="artist_id" 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('artist_id') border-red-500 @enderror">
                                
                                <option value="">-- Select an Artist --</option>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}" 
                                        {{ old('artist_id', $album->artist_id ?? '') == $artist->id ? 'selected' : '' }}>
                                        {{ $artist->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('artist_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    
                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-600 font-medium mb-1">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $album->name ?? '') }}" placeholder="Enter your name"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('name') border-red-500 @enderror">
                        
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>

                      <!-- Year Input (Number) -->
                        <div class="mb-4">
                            <label for="year" class="block text-gray-600 font-medium mb-1">Year</label>
                            <input type="number" id="year" name="year" 
                                value="{{ old('year', $album->year ?? '') }}" 
                                placeholder="YYYY" min="1900" max="{{ date('Y') }}" 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('year') border-red-500 @enderror">
                            
                            @error('year')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sales Input -->
                        <div class="mb-4">
                            <label for="sales" class="block text-gray-600 font-medium mb-1">Sales</label>
                            <input type="text" id="sales" name="sales" value="{{ old('sales', $album->sales ?? '') }}" placeholder="Enter sales"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('name') border-red-500 @enderror">
                        
                                @error('sales')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                        </div>
                    
                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-green-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">
                            {{ isset($album) ? 'Update' : 'Create' }}
                        </button>
                    </form>

                    <a href="{{ route('Album') }}" class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                        Go back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
