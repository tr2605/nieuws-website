<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold">{{ $article->title }}</h3>
                    <p class="mt-4 text-gray-600">{{ $article->description }}</p>

                    <!-- Display Category -->
                    <div class="mt-4">
                        <strong>Category:</strong> {{ $article->category->title ?? 'No Category' }}
                    </div>

                    <!-- Display Tags -->
                    <div class="mt-4">
                        <strong>Tags:</strong>
                        @forelse ($article->tags as $tag)
                            <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded-md">{{ $tag->title }}</span>
                        @empty
                            <span class="text-gray-500">No Tags</span>
                        @endforelse
                    </div>

                    <!-- Edit and Delete Links for Article -->
                    @if (auth()->id() === $article->usersid)
                        <div class="mt-4">
                            <a href="{{ route('article.edit', $article->id) }}" class="text-green-600 hover:text-green-900 focus:outline-none">Edit Article</a>
                        </div>
                        <div class="mt-2">
                            <form action="{{ route('article.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 focus:outline-none">Delete Article</button>
                            </form>
                        </div>
                    @endif

                    <!-- Display Comments -->
                    <div class="mt-4">
                        <strong>Comments:</strong>
                        @forelse ($article->comments as $comment)
                            <div class="mt-2 p-4 bg-gray-100 rounded-md">
                                <p class="text-xs text-gray-500">by {{ $comment->user->name ?? 'Unknown' }} on {{ $comment->created_at->format('d M Y') }}</p>
                                <h4 class="text-gray-600">{{ $comment->title }}</h4>
                                <p class="text-gray-600">{{ $comment->description }}</p>

                                <!-- Edit and Delete Links for Comment -->
                                @if (auth()->id() === $comment->usersid)
                                    <div class="mt-2">
                                        <a href="{{ route('comment.edit', $comment->id) }}" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">Edit Comment</a>
                                    </div>
                                    <div class="mt-2">
                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 focus:outline-none">Delete Comment</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500">No comments yet.</p>
                        @endforelse
                    </div>

                    <!-- Button to toggle comment form -->
                    <button class="block mt-4 text-indigo-600 hover:text-indigo-900 focus:outline-none" onclick="toggleCommentForm()">
                        Post Comment
                    </button>

                    <!-- Comment Form (Initially hidden) -->
                    <form id="commentForm" action="{{ route('comment.store', $article->id) }}" method="POST" class="hidden mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Your Comment</label>
                            <textarea id="description" name="description" rows="3" class="form-textarea mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            Post Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCommentForm() {
            const commentForm = document.getElementById('commentForm');
            commentForm.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
