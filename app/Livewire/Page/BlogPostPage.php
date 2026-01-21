<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Layout('components.layouts.app')]
final class BlogPostPage extends Component
{
    public BlogCategory $category;

    public Blog $blog;

    public function mount(BlogCategory $blogCategory, Blog $blog): void
    {
        $isInvalidCategory = ! $blogCategory->isActive();
        $isInvalidBlog = $blog->blog_category_id !== $blogCategory->id || ! $blog->isPublished();

        if ($isInvalidCategory || $isInvalidBlog) {
            throw new NotFoundHttpException();
        }

        $this->category = $blogCategory;
        $this->blog = $blog;
    }

    public function render(): View
    {
        return view('livewire.blog-post-page');
    }
}
