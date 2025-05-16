<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <a href="{{ route('posts.create') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 mx-auto text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Create Post</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Write a new blog post</p>
                </a>

                <a href="{{ route('posts.index') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 mx-auto text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">My Posts</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Manage your blog posts</p>
                </a>

                <a href="{{ route('categories.index') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 mx-auto text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Categories</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Manage post categories</p>
                </a>

                <a href="{{ route('profile.edit') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 mx-auto text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Profile</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Update your profile</p>
                </a>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recent Posts</h3>
                    @php
                        $recentPosts = Auth::user()->posts()->latest()->take(5)->get();
                    @endphp

                    @if($recentPosts->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">You haven't created any posts yet. <a href="{{ route('posts.create') }}" class="text-blue-500 hover:text-blue-600">Create your first post</a>.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($recentPosts as $post)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <a href="{{ route('posts.show', $post) }}" class="text-gray-900 dark:text-gray-100 hover:text-blue-500 font-medium">{{ $post->title }}</a>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $post->created_at->diffForHumans() }} • {{ $post->category->name }}</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('posts.edit', $post) }}" class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                                    </div>
                                </div>
                            @endforeach

                            @if(Auth::user()->posts()->count() > 5)
                                <div class="pt-4 text-center">
                                    <a href="{{ route('posts.index') }}" class="text-blue-500 hover:text-blue-600">View all posts →</a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
