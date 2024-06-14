<!-- resources/views/tag/edit.blade.php -->
<x-app-layout>
    <header class="flex justify-center main-content">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-100 dark:text-white">Edit Tag</h1>
    </header>

    <section class="flex flex-col items-center">
        <form action="{{ route('tags.update', $tag) }}" method="POST" class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md dark:bg-gray-800">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-black dark:text-gray-200">Title</label>
                <input type="text" id="title" name="title" value="{{ $tag->title }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-black dark:text-gray-200">Description</label>
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $tag->description }}</textarea>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">Update Tag</button>
            </div>
        </form>
        
    </section>
</x-app-layout>
