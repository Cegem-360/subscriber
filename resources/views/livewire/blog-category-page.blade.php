<div>
    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-gray-50 to-white py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="mb-6 text-3xl font-semibold text-gray-900 sm:text-4xl lg:text-5xl">
                    {{ $category->name }}
                </h1>
                @if ($category->description)
                    <p class="mx-auto mt-4 max-w-4xl text-xl text-gray-600">
                        {{ $category->description }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    {{-- Blog Posts Grid --}}
    <section class="bg-white py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($blogs->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">{{ __('No posts yet') }}</h3>
                    <p class="mt-2 text-gray-500">{{ __('There are no posts in this category yet.') }}</p>
                </div>
            @else
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($blogs as $blog)
                        <article class="group flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition-shadow hover:shadow-md">
                            @if ($blog->featured_image)
                                <a href="{{ route('blog.show', ['blogCategory' => $category, 'blog' => $blog]) }}"
                                    class="aspect-video overflow-hidden">
                                    <img src="{{ Storage::url($blog->featured_image) }}"
                                        alt="{{ $blog->title }}"
                                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </a>
                            @else
                                <a href="{{ route('blog.show', ['blogCategory' => $category, 'blog' => $blog]) }}"
                                    class="aspect-video overflow-hidden bg-gray-100 flex items-center justify-center">
                                    <svg class="h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </a>
                            @endif

                            <div class="flex flex-1 flex-col p-6">
                                <div class="mb-3 flex items-center gap-2 text-sm text-gray-500">
                                    <time datetime="{{ $blog->published_at->toDateString() }}">
                                        {{ $blog->published_at->format('Y. m. d.') }}
                                    </time>
                                </div>

                                <h2 class="mb-3 text-xl font-semibold text-gray-900 group-hover:text-indigo-600">
                                    <a href="{{ route('blog.show', ['blogCategory' => $category, 'blog' => $blog]) }}">
                                        {{ $blog->title }}
                                    </a>
                                </h2>

                                @if ($blog->excerpt)
                                    <p class="mb-4 flex-1 text-gray-600 line-clamp-3">
                                        {{ $blog->excerpt }}
                                    </p>
                                @endif

                                <a href="{{ route('blog.show', ['blogCategory' => $category, 'blog' => $blog]) }}"
                                    class="inline-flex items-center font-medium text-indigo-600 hover:text-indigo-500">
                                    {{ __('Read more') }}
                                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
