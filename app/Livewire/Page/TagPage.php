<?php

declare(strict_types=1);

namespace App\Livewire\Page;

use App\Models\Blog\Blog;
use App\Models\Blog\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Layout('components.layouts.app')]
final class TagPage extends Component
{
    public Tag $tag;

    /** @var Collection<int, Blog> */
    public Collection $blogs;

    public function mount(Tag $tag): void
    {
        if (! $tag->isActive()) {
            throw new NotFoundHttpException();
        }

        $this->tag = $tag;

        $this->blogs = $tag->blogs()
            ->published()
            ->with('blogCategory')
            ->orderByDesc('published_at')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.tag-page');
    }
}
