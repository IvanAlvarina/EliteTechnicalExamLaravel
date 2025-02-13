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
    
                    <!-- Pagination - Now directly below the first card -->
                    <div class="mt-6 flex justify-center">
                        {{ $artistsSales->links() }}
                    </div>
                </div>
    
                <!-- Combined Album Sales -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h2 class="text-xl font-semibold">Display Combined Album Sales Per Artist</h2>
                    <p class="text-3xl font-bold text-green-600">
                        ${{ number_format($combinedAlbumSales) }}
                    </p>
                </div>
    
                <!-- Top 1 Artist -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h2 class="text-xl font-semibold">Top 1 Artist with Most Album Sales</h2>
                    <p class="text-3xl font-bold text-yellow-500">567</p>
                </div>
    
                <!-- Album Search Section -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h2 class="text-xl font-semibold">List of Albums Based on Search</h2>
                    <p class="text-3xl font-bold text-yellow-500">567</p>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
