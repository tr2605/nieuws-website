<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Categories') }}
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('category.create') }}"
                       class="inline-flex items-center px-6 py-3 border border-transparent text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        Maak een nieuwe categorie!
                    </a>
                    <h3 class="text-lg font-semibold mb-4">Categories</h3>
                    @if ($categories->isEmpty())
                        <p>No categories found.</p>
                    @else
                        <ul>
                            @foreach ($categories as $category)
                                <li>{{ $category->title }}</li>
                                <li>{{ $category->description }}</li>
                                <!-- Edit Button -->
                                @auth
                                    <li>
                                        <a href="{{ route('category.edit', $category->id) }}"
                                           class="inline-block bg-blue-500 hover:bg-blue-400 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Categorie
                                            aanpassen</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                              class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Weet u zeker dat u deze categorie wilt verwijderen?')"
                                                    class="bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-red-900 text-white">
                                                Verwijder categorie
                                            </button>
                                        </form>
                                    </li>
                                @endauth
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
