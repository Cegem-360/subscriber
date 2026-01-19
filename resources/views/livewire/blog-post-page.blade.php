<div>
    {{-- Breadcrumb --}}
    <section class="bg-gray-50 py-4">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('blog.category', ['categorySlug' => $category->slug]) }}"
                            class="text-gray-500 hover:text-gray-700">
                            {{ $category->name }}
                        </a>
                    </li>
                    <li>
                        <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li>
                        <span class="text-gray-900 font-medium">{{ Str::limit($blog->title, 40) }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- Article Header --}}
    <section class="bg-white py-12 lg:py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <header class="text-center">
                <div class="mb-4">
                    <span class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-800">
                        {{ $category->name }}
                    </span>
                </div>

                <h1 class="mb-6 text-3xl font-bold text-gray-900 sm:text-4xl lg:text-5xl">
                    {{ $blog->title }}
                </h1>

                <div class="flex items-center justify-center gap-4 text-sm text-gray-500">
                    <time datetime="{{ $blog->published_at->toDateString() }}">
                        {{ $blog->published_at->format('Y. m. d.') }}
                    </time>
                </div>
            </header>

            @if ($blog->featured_image)
                <div class="mt-10 overflow-hidden rounded-2xl">
                    <img src="{{ Storage::url($blog->featured_image) }}"
                        alt="{{ $blog->title }}"
                        class="w-full object-cover">
                </div>
            @endif
        </div>
    </section>

    {{-- Article Content --}}
    <section class="bg-white pb-16 lg:pb-24">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <article class="prose prose-lg prose-indigo mx-auto max-w-none">
                {!! $blog->content !!}
            </article>
        </div>
    </section>

    {{-- Back to Category --}}
    <section class="bg-gray-50 py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
            <a href="{{ route('blog.category', ['categorySlug' => $category->slug]) }}"
                class="inline-flex items-center rounded-lg bg-indigo-600 px-6 py-3 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 transition-colors">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Vissza a {{ $category->name }} kategóriához
            </a>
        </div>
    </section>
</div>
