<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Albums Sold per Artist -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-6 text-center">Total Albums Sold per Artist</h2>
    
                    <div class="space-y-4">
                        @foreach($artistsSales as $artist)
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium">{{ $artist->name }}</span>
                                    <span class="text-xl font-bold text-blue-600">
                                        ${{ number_format($artist->albums_sum_sales) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <div class="mt-6 flex justify-center">
                        {{ $artistsSales->links() }}
                    </div>
                </div>
    
                <!-- Combined Album Sales -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h2 class="text-xl font-semibold">Display Combined Album Sales Per Artist</h2>
                    <div class="space-y-4">
                        @foreach($combinedAlbumSales as $combinedAlbumSale)
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium">{{ $combinedAlbumSale->name }}</span>
                                    <span class="text-xl font-bold text-blue-600">
                                        {{ number_format($combinedAlbumSale->albums_count) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex justify-center">
                        {{ $combinedAlbumSales->links() }}
                    </div>
                </div>
    
                <!-- Top 1 Artist -->
                <div class="bg-white p-6 rounded-lg shadow text-center flex flex-col items-center justify-center">
                    <h2 class="text-xl font-semibold">Top 1 Artist with Most Album Sales</h2>
                
                    @if($topArtist)
                        <p class="text-2xl font-semibold mt-2">{{ $topArtist->name }}</p>
                        <p class="text-3xl font-bold text-yellow-500">{{ number_format($topArtist->albums_sum_sales) }}</p>
                    @else
                        <p class="text-gray-500 mt-2">No data available</p>
                    @endif
                </div>

                <!-- Album Search Section -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <!-- Search Form -->
                    <form action="{{ route('searchArtist') }}" method="GET" class="mb-4">
                        <input type="text" 
                            name="search" 
                            placeholder="Search artist..." 
                            value="{{ $search ?? '' }}"
                            class="p-2 border rounded-lg">
                        <button type="submit" 
                                class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Search
                        </button>
                    </form>

                    <!-- Error Message -->
                    @if(session('error'))
                        <div class="text-red-500 mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                
                    @if(request()->has('search') && !empty(request()->search))
                        @if($artist)
                            <div class="bg-white rounded-lg text-center">

                                @if($albums->isNotEmpty())
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($albums as $album)
                                            <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                                <h3 class="font-semibold text-sm">{{ $album->name }}</h3>
                                                <p class="text-gray-600">Year: {{ $album->year }}</p>
                                                <p class="text-gray-600">Sales: {{ number_format($album->sales) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 mt-2">No albums found for this artist.</p>
                                @endif
                            </div>
                        @else
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
                                <p>No artist found for "{{ request()->search }}".</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
