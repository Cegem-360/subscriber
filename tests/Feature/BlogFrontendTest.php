<?php

declare(strict_types=1);

use App\Livewire\Page\BlogCategoryPage;
use App\Livewire\Page\BlogPostPage;
use App\Livewire\Page\TagPage;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('BlogCategoryPage', function (): void {
    it('is accessible via route', function (): void {
        $category = BlogCategory::factory()->create();

        get("/eroforrasok/{$category->slug}")
            ->assertOk()
            ->assertSeeLivewire(BlogCategoryPage::class);
    });

    it('displays the category name and description', function (): void {
        $category = BlogCategory::factory()->create([
            'name' => 'Teszt kategória',
            'description' => 'Ez egy teszt leírás',
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertSee('Teszt kategória')
            ->assertSee('Ez egy teszt leírás');
    });

    it('displays published blog posts', function (): void {
        $category = BlogCategory::factory()->create();

        Blog::factory()->for($category)->create([
            'title' => 'Teszt bejegyzés címe',
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertSee('Teszt bejegyzés címe');
    });

    it('does not display unpublished blog posts', function (): void {
        $category = BlogCategory::factory()->create();

        Blog::factory()->for($category)->unpublished()->create([
            'title' => 'Nem publikált bejegyzés',
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertDontSee('Nem publikált bejegyzés');
    });

    it('does not display inactive blog posts', function (): void {
        $category = BlogCategory::factory()->create();

        Blog::factory()->for($category)->inactive()->create([
            'title' => 'Inaktív bejegyzés',
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertDontSee('Inaktív bejegyzés');
    });

    it('does not display scheduled blog posts', function (): void {
        $category = BlogCategory::factory()->create();

        Blog::factory()->for($category)->scheduled()->create([
            'title' => 'Ütemezett bejegyzés',
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertDontSee('Ütemezett bejegyzés');
    });

    it('returns 404 for inactive category', function (): void {
        BlogCategory::factory()->inactive()->create([
            'slug' => 'inaktiv-kategoria',
        ]);
        get('/eroforrasok/inaktiv-kategoria')->assertNotFound();
    });

    it('returns 404 for non-existent category', function (): void {
        get('/eroforrasok/nem-letezik')->assertNotFound();
    });

    it('shows empty state when no posts exist', function (): void {
        $category = BlogCategory::factory()->create();

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertSee('Nincs még bejegyzés');
    });
});

describe('BlogPostPage', function (): void {
    it('is accessible via route', function (): void {
        $category = BlogCategory::factory()->create();
        $blog = Blog::factory()->for($category)->create();

        get("/eroforrasok/{$category->slug}/{$blog->slug}")
            ->assertOk()
            ->assertSeeLivewire(BlogPostPage::class);
    });

    it('displays the blog post title and content', function (): void {
        $category = BlogCategory::factory()->create();

        $blog = Blog::factory()->for($category)->create([
            'title' => 'Bejegyzés címe',
            'content' => '<p>Ez a bejegyzés tartalma.</p>',
        ]);

        Livewire::test(BlogPostPage::class, [
            'blogCategory' => $category,
            'blog' => $blog,
        ])
            ->assertSee('Bejegyzés címe')
            ->assertSee('Ez a bejegyzés tartalma.');
    });

    it('displays the category badge', function (): void {
        $category = BlogCategory::factory()->create([
            'name' => 'Kategória név',
        ]);

        $blog = Blog::factory()->for($category)->create();

        Livewire::test(BlogPostPage::class, [
            'blogCategory' => $category,
            'blog' => $blog,
        ])
            ->assertSee('Kategória név');
    });

    it('returns 404 for unpublished post', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
        ]);

        Blog::factory()->for($category)->unpublished()->create([
            'slug' => 'nem-publikalt',
        ]);

        get('/eroforrasok/teszt-kategoria/nem-publikalt')
            ->assertNotFound();
    });

    it('returns 404 for inactive post', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
        ]);

        Blog::factory()->for($category)->inactive()->create([
            'slug' => 'inaktiv-post',
        ]);

        get('/eroforrasok/teszt-kategoria/inaktiv-post')
            ->assertNotFound();
    });

    it('returns 404 for non-existent post', function (): void {
        BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
        ]);

        get('/eroforrasok/teszt-kategoria/nem-letezik')
            ->assertNotFound();
    });

    it('returns 404 when post belongs to different category', function (): void {
        BlogCategory::factory()->create([
            'slug' => 'kategoria-1',
        ]);

        $category2 = BlogCategory::factory()->create([
            'slug' => 'kategoria-2',
        ]);

        Blog::factory()->for($category2)->create([
            'slug' => 'teszt-post',
        ]);

        get('/eroforrasok/kategoria-1/teszt-post')
            ->assertNotFound();
    });
});

describe('TagPage', function (): void {
    it('is accessible via route', function (): void {
        $tag = Tag::factory()->create();

        get("/tag/{$tag->slug}")
            ->assertOk()
            ->assertSeeLivewire(TagPage::class);
    });

    it('displays the tag name', function (): void {
        $tag = Tag::factory()->create([
            'name' => 'Laravel tippek',
        ]);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertSee('Laravel tippek');
    });

    it('displays published blog posts with the tag', function (): void {
        $tag = Tag::factory()->create();

        $blog = Blog::factory()->create([
            'title' => 'Teszt bejegyzés címkével',
        ]);

        $blog->tags()->attach($tag);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertSee('Teszt bejegyzés címkével');
    });

    it('does not display unpublished blog posts', function (): void {
        $tag = Tag::factory()->create();

        $blog = Blog::factory()->unpublished()->create([
            'title' => 'Nem publikált bejegyzés',
        ]);

        $blog->tags()->attach($tag);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertDontSee('Nem publikált bejegyzés');
    });

    it('does not display inactive blog posts', function (): void {
        $tag = Tag::factory()->create();

        $blog = Blog::factory()->inactive()->create([
            'title' => 'Inaktív bejegyzés',
        ]);

        $blog->tags()->attach($tag);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertDontSee('Inaktív bejegyzés');
    });

    it('returns 404 for inactive tag', function (): void {
        Tag::factory()->inactive()->create([
            'slug' => 'inaktiv-tag',
        ]);

        get('/tag/inaktiv-tag')
            ->assertNotFound();
    });

    it('returns 404 for non-existent tag', function (): void {
        get('/tag/nem-letezik')
            ->assertNotFound();
    });

    it('shows empty state when no posts exist', function (): void {
        $tag = Tag::factory()->create();

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertSee('Ezzel a címkével még nincsenek bejegyzések.');
    });

    it('displays blog category name for each post', function (): void {
        $category = BlogCategory::factory()->create([
            'name' => 'Fejlesztés',
        ]);
        $tag = Tag::factory()->create();

        $blog = Blog::factory()->for($category)->create();

        $blog->tags()->attach($tag);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertSee('Fejlesztés');
    });
});
