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
