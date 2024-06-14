<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-center">
            {{ __('Nieuws Pagina') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Link to open the create form -->
        <div class="flex justify-center space-x-4 mb-6">
            <a href="{{ route('article.create') }}"
                class="inline-flex items-center bg-gray-600 px-6 py-3 border border-transparent text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                Schrijf nieuw bericht!
            </a>
            <a href="{{ route('categories.index') }}"
                class="inline-flex items-center bg-gray-600 px-6 py-3 border border-transparent text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                bekijk categories
            </a>
            <a href="{{ route('tags.show') }}"
                class="inline-flex items-center bg-gray-600 px-6 py-3 border border-transparent text-lg font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                bekijk tags
            </a>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-6">
                @foreach ($articles as $article)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold">{{ $article->title }}</h3>
                            <p class="text-gray-600">{{ $article->description }}</p>

                            <!-- Link to detail page -->
                            <div class="mt-4">
                                <a href="{{ route('article.show', $article->id) }}"
                                    class="text-blue-600 hover:text-blue-900 focus:outline-none">
                                    Lees meer
                                </a>
                            </div>

                            <!-- Display Category -->
                            <div class="mt-4">
                                {{ $article->category->title ?? 'No Category' }}
                            </div>

                            <!-- Display Tags -->
                            <div class="mt-4">
                                <strong>Tags:</strong>
                                @forelse ($article->tags as $tag)
                                    <span
                                        class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded-md">{{ $tag->title }}</span>
                                @empty
                                    <span class="text-gray-500">No Tags</span>
                                @endforelse
                            </div>

                            <!-- Edit Link -->
                            @if (auth()->id() === $article->usersid)
                                <div class="mt-4">
                                    <a href="{{ route('article.edit', $article->id) }}"
                                        class="text-green-600 hover:text-indigo-900 focus:outline-none">
                                        Edit je artikel
                                    </a>
                                </div>
                            @endif

                            <!-- Delete Link -->
                            @if (auth()->id() === $article->usersid)
                                <div class="mt-4">
                                    <form action="{{ route('article.destroy', $article->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this article?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 focus:outline-none">
                                            Delete je artikel
                                        </button>
                                    </form>
                                </div>
                            @endif

                            <!-- Display Comments (Collapsible) -->
                            <div class="mt-4">
                                <button class="block text-indigo-600 hover:text-indigo-900 focus:outline-none"
                                    onclick="toggleComments({{ $article->id }})">
                                    Comments
                                </button>
                                <div id="comments{{ $article->id }}" class="hidden">
                                    @forelse ($article->comments as $comment)
                                        <div class="mt-2 p-4 bg-gray-100 rounded-md">
                                            <p class="text-xs text-gray-500">door {{ $comment->user->name ?? 'henk' }}
                                                op
                                                {{ $comment->created_at->format('d M Y') }}</p>
                                            <h2 class="text-gray-600">{{ $comment->title }}</h2>
                                            <p class="text-gray-600">{{ $comment->description }}</p>

                                            <!-- Edit Link for Comment -->
                                            @if (auth()->id() === $comment->usersid)
                                                <div class="mt-2">
                                                    <a href="{{ route('comment.edit', $comment->id) }}"
                                                        class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                        Edit Comment
                                                    </a>
                                                </div>
                                            @endif

                                            <!-- Delete Link for Comment -->
                                            @if (auth()->id() === $comment->usersid)
                                                <div class="mt-2">
                                                    <form action="{{ route('comment.destroy', $comment->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 focus:outline-none">
                                                            Delete Comment
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-gray-500">No comments yet.</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Button to toggle comment form -->
                            <button class="block mt-4 text-indigo-600 hover:text-indigo-900 focus:outline-none"
                                onclick="toggleCommentForm({{ $article->id }})">
                                Post Comment
                            </button>

                            <!-- Comment Form (Initially hidden) -->
                            <form id="commentForm{{ $article->id }}"
                                action="{{ route('comment.store', $article->id) }}" method="POST" class="hidden mt-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="title{{ $article->id }}"
                                        class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" id="title{{ $article->id }}" name="title"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div class="mb-4">
                                    <label for="description{{ $article->id }}"
                                        class="block text-sm font-medium text-gray-700">Your Comment</label>
                                    <textarea id="description{{ $article->id }}" name="description" rows="3"
                                        class="form-textarea mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    Post Comment
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function toggleComments(articleId) {
            const commentsDiv = document.getElementById(`comments${articleId}`);
            commentsDiv.classList.toggle('hidden');
        }

        function toggleCommentForm(articleId) {
            const commentForm = document.getElementById(`commentForm${articleId}`);
            commentForm.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
