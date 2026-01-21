<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Layout('components.layouts.app')]
final class BlogCategoryPage extends Component
{
    public BlogCategory $category;

    /** @var Collection<int, Blog> */
    public Collection $blogs;

    public function mount(BlogCategory $blogCategory): void
    {
        if (! $blogCategory->isActive()) {
            throw new NotFoundHttpException();
        }

        $this->category = $blogCategory;

        $this->blogs = $blogCategory->blogs()
            ->published()
            ->orderByDesc('published_at')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.blog-category-page');
    }
}
