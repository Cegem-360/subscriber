<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class BlogCategoryPage extends Component
{
    public BlogCategory $category;

    /** @var Collection<int, Blog> */
    public Collection $blogs;

    public function mount(string $categorySlug): void
    {
        $this->category = BlogCategory::query()
            ->where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        $this->blogs = Blog::query()
            ->where('blog_category_id', $this->category->id)
            ->published()
            ->orderByDesc('published_at')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.blog-category-page');
    }
}
