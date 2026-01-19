<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class BlogPostPage extends Component
{
    public BlogCategory $category;

    public Blog $blog;

    public function mount(string $categorySlug, string $blogSlug): void
    {
        $this->category = BlogCategory::query()
            ->where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        $this->blog = Blog::query()
            ->where('blog_category_id', $this->category->id)
            ->where('slug', $blogSlug)
            ->published()
            ->firstOrFail();
    }

    public function render(): View
    {
        return view('livewire.blog-post-page');
    }
}
