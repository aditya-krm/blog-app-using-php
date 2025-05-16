<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Blog Posts</h1>
            
            <!-- Search and Filter Section -->
            <div class="mb-8">
                <form method="GET" action="{{ route('blog.index') }}" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search posts..."
                            value="{{ request('search') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                    </div>
                    <div class="sm:w-48">
                        <select
                            name="category"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button
                            type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Filter
                        </button>
                        @if(request('search') || request('category'))
                            <a
                                href="{{ route('blog.index') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- No Posts Message -->
            @if($posts->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-500 text-center">
                        No posts found. {{ request('search') || request('category') ? 'Try different filters or ' : '' }}
                        <a href="{{ route('blog.index') }}" class="text-blue-500 hover:text-blue-700">view all posts</a>.
                    </div>
                </div>
            @endif
            
            <!-- Posts List -->
            <div class="space-y-8">
                @foreach ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                        <a href="{{ route('blog.show', $post) }}" class="hover:text-blue-600">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                    <div class="flex items-center text-sm text-gray-500 mb-4">
                                        <span>By {{ $post->user->name }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <a href="{{ route('blog.index', ['category' => $post->category->id]) }}" 
                           class="text-blue-600 hover:text-blue-800">
                            {{ $post->category->name }}
                        </a>
                                    </div>
                                </div>
                                @if($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-32 h-32 object-cover rounded-lg ml-4">
                                @endif
                            </div>
                            
                            <div class="prose max-w-none mb-4">
                                {{ Str::limit(strip_tags($post->content), 250) }}
                            </div>
                            
                            <a href="{{ route('blog.show', $post) }}" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                Read more
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>