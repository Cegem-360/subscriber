<?php

declare(strict_types=1);

use App\Filament\Resources\Blogs\Pages\ListBlogs;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    BlogCategory::factory()->create();
});

it('has a view frontend action that links to the blog post page', function (): void {
    $admin = User::factory()->admin()->create();
    $blog = Blog::factory()->create();

    $this->actingAs($admin);

    $expectedUrl = route('blog.show', [
        'blogCategory' => $blog->blogCategory,
        'blog' => $blog,
    ]);

    livewire(ListBlogs::class)
        ->assertActionExists(TestAction::make('view_frontend')->table($blog))
        ->assertActionHasUrl(TestAction::make('view_frontend')->table($blog), $expectedUrl)
        ->assertActionShouldOpenUrlInNewTab(TestAction::make('view_frontend')->table($blog));
});
