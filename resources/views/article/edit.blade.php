<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($errors->any())
            <div class="alert alert-danger max-w-md mx-auto mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex justify-center mt-8">
            <form action="{{ route('article.update', $article->id) }}" method="POST" class="w-full max-w-lg bg-white p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                    <input type="text" id="title" name="title" value="{{ $article->title }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Waar gaat je verhaal over?</label>
                    <textarea id="description" name="description" rows="10" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $article->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $article->categorieId == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags Checkboxes -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tags</label>
                    @foreach ($tags as $tag)
                        <div class="flex items-center mt-1">
                            <input type="checkbox" id="tag{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" {{ $article->tags->contains($tag->id) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            <label for="tag{{ $tag->id }}" class="ml-3 block text-sm font-medium text-gray-700">{{ $tag->title }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        Update Article
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
