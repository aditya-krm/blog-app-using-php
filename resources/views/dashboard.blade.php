<x-app-layout>

    <div class="py-6 md:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg mb-8 overflow-hidden">
                <div class="px-6 py-8 md:px-10 md:py-10 md:flex md:items-center md:justify-between">
                    <div class="md:flex-1">
                        <h2 class="text-2xl font-sm text-white leading-tight">
                            Welcome to your Dashboard, <span class="font-bold underline">{{ Auth::user()->name }}</span>
                        </h2>
                        <p class="mt-2 max-w-2xl text-white">
                            Manage your blog posts, categories, and profile all in one place.
                        </p>
                    </div>
                    <div class="mt-6 md:mt-0 md:ml-6 flex">
                        <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create New Post
                        </a>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-blue-700 to-indigo-800 px-6 py-3">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="flex-1 flex items-center">
                            <p class="text-sm font-medium text-white truncate">
                                <span class="hidden md:inline">You've published </span>
                                <span class="font-bold text-white">{{ Auth::user()->posts()->where('status', 'published')->count() }}</span>
                                <span> posts and have </span>
                                <span class="font-bold text-white">{{ Auth::user()->posts()->where('status', 'draft')->count() }}</span>
                                <span> drafts.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Posts</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->posts()->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="text-xs text-gray-600 dark:text-gray-400 flex justify-between">
                            @php
                                $lastPost = Auth::user()->posts()->latest()->first();
                            @endphp
                            <span>Last post:</span>
                            <span class="font-medium">
                                @if($lastPost)
                                    {{ $lastPost->created_at->diffForHumans() }}
                                @else
                                    No posts yet
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Categories Used</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->posts()->distinct('category_id')->count('category_id') }}</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="text-xs text-gray-600 dark:text-gray-400 flex justify-between">
                            <span>Most used:</span>
                            <span class="font-medium">
                                @if($mostUsedCategory = Auth::user()->posts()->select('category_id')->groupBy('category_id')->orderByRaw('count(*) DESC')->first()?->category)
                                    {{ $mostUsedCategory->name }}
                                @else
                                    None
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600 dark:text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Draft Posts</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->posts()->where('status', 'draft')->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="text-xs text-gray-600 dark:text-gray-400 flex justify-between">
                            <span>Latest draft:</span>
                            <span class="font-medium">
                                @if($latestDraft = Auth::user()->posts()->where('status', 'draft')->latest()->first())
                                    {{ Str::limit($latestDraft->title, 20) }}
                                @else
                                    None
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-10">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 px-1">Quick Actions</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    <a href="{{ route('posts.create') }}" class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl p-5 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 border border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-700 hover:shadow-md flex flex-col items-center justify-center">
                        <div class="absolute inset-0 bg-gradient-to-b from-blue-50 dark:from-blue-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full relative z-10 group-hover:scale-110 transition-transform duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mt-4 mb-1 relative z-10">Create Post</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs relative z-10">Write a new blog post</p>
                    </a>

                    <a href="{{ route('posts.index') }}" class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl p-5 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 border border-gray-200 dark:border-gray-700 hover:border-indigo-300 dark:hover:border-indigo-700 hover:shadow-md flex flex-col items-center justify-center">
                        <div class="absolute inset-0 bg-gradient-to-b from-indigo-50 dark:from-indigo-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-full relative z-10 group-hover:scale-110 transition-transform duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mt-4 mb-1 relative z-10">My Posts</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs relative z-10">Manage your blog posts</p>
                    </a>

                    <a href="{{ route('categories.index') }}" class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl p-5 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 border border-gray-200 dark:border-gray-700 hover:border-green-300 dark:hover:border-green-700 hover:shadow-md flex flex-col items-center justify-center">
                        <div class="absolute inset-0 bg-gradient-to-b from-green-50 dark:from-green-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full relative z-10 group-hover:scale-110 transition-transform duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mt-4 mb-1 relative z-10">Categories</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs relative z-10">Manage post categories</p>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="group relative bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl p-5 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 border border-gray-200 dark:border-gray-700 hover:border-purple-300 dark:hover:border-purple-700 hover:shadow-md flex flex-col items-center justify-center">
                        <div class="absolute inset-0 bg-gradient-to-b from-purple-50 dark:from-purple-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full relative z-10 group-hover:scale-110 transition-transform duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mt-4 mb-1 relative z-10">Profile</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs relative z-10">Update your profile</p>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Posts</h3>
                        <a href="{{ route('posts.create') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New Post
                        </a>
                    </div>

                    @php
                        $recentPosts = Auth::user()->posts()->latest()->take(5)->get();
                    @endphp

                    @if($recentPosts->isEmpty())
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No posts yet</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new post</p>
                            <div class="mt-6">
                                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Create Post
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900/30">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($recentPosts as $post)
                                        <tr class="">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('posts.show', $post) }}" class="text-sm font-medium text-gray-900 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">
                                                    {{ Str::limit($post->title, 40) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $post->category->name }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $post->status === 'published' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' }}">
                                                    {{ ucfirst($post->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                                {{ $post->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                                <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(Auth::user()->posts()->count() > 5)
                                <div class="bg-gray-50 dark:bg-gray-700/30 px-6 py-3 border-t border-gray-200 dark:border-gray-700">
                                    <div class="text-center">
                                        <a href="{{ route('posts.index') }}" class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">
                                            View all posts
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
