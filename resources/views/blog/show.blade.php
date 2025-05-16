<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('blog.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Blog
                </a>
            </div>

            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
                    
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <span>By {{ $post->user->name }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $post->category->name }}</span>
                    </div>

                    @if($post->featured_image)
                        <div class="mb-6">
                            <img src="{{ Storage::url($post->featured_image) }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-96 object-cover rounded-lg">
                        </div>
                    @endif

                    <div class="prose max-w-none">
                        {!! $post->content !!}
                    </div>
                </div>
            </article>
        </div>
    </div>
</x-app-layout>