<?php

declare(strict_types=1);

use App\Filament\Resources\Blogs\Pages\ListBlogs;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    BlogCategory::factory()->create();
});

it('has a view frontend action that links to the blog post page', function (): void {
    $admin = User::factory()->admin()->create();
    $blog = Blog::factory()->create();

    $expectedUrl = route('blog.show', [
        'blogCategory' => $blog->blogCategory,
        'blog' => $blog,
    ]);

    Livewire::actingAs($admin)->test(ListBlogs::class)
        ->assertActionExists(TestAction::make('view_frontend')->table($blog))
        ->assertActionHasUrl(TestAction::make('view_frontend')->table($blog), $expectedUrl)
        ->assertActionShouldOpenUrlInNewTab(TestAction::make('view_frontend')->table($blog));
});
