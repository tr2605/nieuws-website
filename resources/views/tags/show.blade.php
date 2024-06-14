<!-- resources/views/tags/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Tags') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Tags</h3>
                    <a href="{{ route('tags.create') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-4">
                        Maak nieuwe tag!
                    </a>
                    @if ($tags->isEmpty())
                        <p>No tags found.</p>
                    @else
                        <ul>
                            @foreach ($tags as $tag)
                                <li>{{ $tag->title }}</li>
                                <li>{{ $tag->description }}</li>
                                <!-- Edit Link as Button -->
                                <li>
                                    <a href="{{ route('tags.edit', $tag->id) }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mr-2">
                                        Edit
                                    </a>
                                </li>
                                <!-- Delete Link as Button -->
                                <li>
                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this tag?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    