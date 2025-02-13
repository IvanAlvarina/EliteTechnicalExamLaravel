<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Album') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('CreateAlbum') }}" class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                Add Album
            </a>

            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg mt-3">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-3 px-6 text-left text-gray-700">Artist</th>
                        <th class="py-3 px-6 text-left text-gray-700">Name</th>
                        <th class="py-3 px-6 text-left text-gray-700">Year</th>
                        <th class="py-3 px-6 text-left text-gray-700">Sales</th>
                        <th class="py-3 px-6 text-left text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($albums as $album)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $album->artist->name }}</td>
                        <td class="py-3 px-6">{{ $album->name }}</td>
                        <td class="py-3 px-6">{{ $album->year }}</td>
                        <td class="py-3 px-6">{{ $album->sales }}</td>
                        <td class="py-3 px-6 flex space-x-2">
                            <a href="{{ route('CreateAlbum', ['id' => $album->id]) }}" class="inline-block bg-green-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">
                                Edit
                            </a>
                            <form action="{{ route('DeleteAlbum', $album->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this artist?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $albums->links() }}
            </div>

        </div>
    </div>
</x-app-layout>

