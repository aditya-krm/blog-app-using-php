<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $category->name }}
            </h2>
            <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900">
                Back to Categories
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Description</h3>
                        <p class="mt-1 text-gray-600">{{ $category->description ?: 'No description available.' }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Posts in this category</h3>
                        @if($category->posts->count() > 0)
                            <div class="mt-4 space-y-4">
                                @foreach($category->posts as $post)
                                    <div class="border-b border-gray-200 pb-4">
                                        <h4 class="text-md font-medium">{{ $post->title }}</h4>
                                        <p class="text-gray-600">{{ Str::limit($post->content, 200) }}</p>
                                        <p class="text-sm text-gray-500 mt-2">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mt-1 text-gray-600">No posts in this category yet.</p>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('categories.edit', $category) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Edit Category
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this category?')">
                                Delete Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>