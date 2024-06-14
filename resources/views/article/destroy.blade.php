<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delete Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Are you sure you want to delete this article?</p>
                    <p><strong>Title:</strong> {{ $article->title }}</p>
                    <p><strong>Description:</strong> {{ $article->description }}</p>

                    <form action="{{ route('article.destroy', $article->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Yes, delete
                        </button>
                    </form>

                    <a href="{{ route('articles.index') }}" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
