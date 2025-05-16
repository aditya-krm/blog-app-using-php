<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $post->title }}
            </h2>
            <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900">
                Back to Posts
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($post->featured_image)
                        <div class="mb-6">
                            <img src="{{ Storage::url($post->featured_image) }}" alt="Featured image" class="max-w-full h-auto rounded-lg">
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Category</h3>
                        <p class="text-gray-600">{{ $post->category->name }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Author</h3>
                        <p class="text-gray-600">{{ $post->user->name }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Content</h3>
                        <div class="prose max-w-none">
                            {{ $post->content }}
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Posted</h3>
                        <p class="text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                    </div>

                    @if($post->user_id === auth()->id())
                        <div class="flex items-center gap-4">
                            <a href="{{ route('posts.edit', $post) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Edit Post</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>