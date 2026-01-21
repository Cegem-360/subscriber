<?php

declare(strict_types=1);

use App\Livewire\BlogCategoryPage;
use App\Livewire\BlogPostPage;
use App\Livewire\TagPage;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

describe('BlogCategoryPage', function (): void {
    it('renders the blog category page', function (): void {
        $category = BlogCategory::factory()->create([
            'name' => 'Teszt kategória',
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        $response = $this->get('/eroforrasok/teszt-kategoria');

        $response->assertOk();
        $response->assertSeeLivewire(BlogCategoryPage::class);
    });

    it('displays the category name and description', function (): void {
        $category = BlogCategory::factory()->create([
            'name' => 'Teszt kategória',
            'slug' => 'teszt-kategoria',
            'description' => 'Ez egy teszt leírás',
            'is_active' => true,
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertSee('Teszt kategória')
            ->assertSee('Ez egy teszt leírás');
    });

    it('displays published blog posts', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Teszt bejegyzés címe',
            'slug' => 'teszt-bejegyzes',
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertSee('Teszt bejegyzés címe');
    });

    it('does not display unpublished blog posts', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Nem publikált bejegyzés',
            'slug' => 'nem-publikalt',
            'is_active' => true,
            'published_at' => null,
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertDontSee('Nem publikált bejegyzés');
    });

    it('does not display inactive blog posts', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Inaktív bejegyzés',
            'slug' => 'inaktiv',
            'is_active' => false,
            'published_at' => now()->subDay(),
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertDontSee('Inaktív bejegyzés');
    });

    it('does not display scheduled blog posts', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Ütemezett bejegyzés',
            'slug' => 'utemezett',
            'is_active' => true,
            'published_at' => now()->addDays(5),
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertDontSee('Ütemezett bejegyzés');
    });

    it('returns 404 for inactive category', function (): void {
        BlogCategory::factory()->create([
            'slug' => 'inaktiv-kategoria',
            'is_active' => false,
        ]);

        $response = $this->get('/eroforrasok/inaktiv-kategoria');

        $response->assertNotFound();
    });

    it('returns 404 for non-existent category', function (): void {
        $response = $this->get('/eroforrasok/nem-letezik');

        $response->assertNotFound();
    });

    it('shows empty state when no posts exist', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'ures-kategoria',
            'is_active' => true,
        ]);

        Livewire::test(BlogCategoryPage::class, ['blogCategory' => $category])
            ->assertSee('Nincs még bejegyzés');
    });
});

describe('BlogPostPage', function (): void {
    it('renders the blog post page', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Teszt bejegyzés',
            'slug' => 'teszt-bejegyzes',
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get('/eroforrasok/teszt-kategoria/teszt-bejegyzes');

        $response->assertOk();
        $response->assertSeeLivewire(BlogPostPage::class);
    });

    it('displays the blog post title and content', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        $blog = Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Bejegyzés címe',
            'slug' => 'bejegyzes-cime',
            'content' => '<p>Ez a bejegyzés tartalma.</p>',
            'is_active' => true,
            'published_at' => now()->subDay(),
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
            'slug' => 'kategoria-nev',
            'is_active' => true,
        ]);

        $blog = Blog::factory()->create([
            'blog_category_id' => $category->id,
            'slug' => 'teszt-post',
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        Livewire::test(BlogPostPage::class, [
            'blogCategory' => $category,
            'blog' => $blog,
        ])
            ->assertSee('Kategória név');
    });

    it('returns 404 for unpublished post', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        Blog::factory()->create([
            'blog_category_id' => $category->id,
            'slug' => 'nem-publikalt',
            'is_active' => true,
            'published_at' => null,
        ]);

        $response = $this->get('/eroforrasok/teszt-kategoria/nem-publikalt');

        $response->assertNotFound();
    });

    it('returns 404 for inactive post', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        Blog::factory()->create([
            'blog_category_id' => $category->id,
            'slug' => 'inaktiv-post',
            'is_active' => false,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get('/eroforrasok/teszt-kategoria/inaktiv-post');

        $response->assertNotFound();
    });

    it('returns 404 for non-existent post', function (): void {
        $category = BlogCategory::factory()->create([
            'slug' => 'teszt-kategoria',
            'is_active' => true,
        ]);

        $response = $this->get('/eroforrasok/teszt-kategoria/nem-letezik');

        $response->assertNotFound();
    });

    it('returns 404 when post belongs to different category', function (): void {
        $category1 = BlogCategory::factory()->create([
            'slug' => 'kategoria-1',
            'is_active' => true,
        ]);

        $category2 = BlogCategory::factory()->create([
            'slug' => 'kategoria-2',
            'is_active' => true,
        ]);

        Blog::factory()->create([
            'blog_category_id' => $category2->id,
            'slug' => 'teszt-post',
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get('/eroforrasok/kategoria-1/teszt-post');

        $response->assertNotFound();
    });
});

describe('TagPage', function (): void {
    it('renders the tag page', function (): void {
        $tag = Tag::factory()->create([
            'name' => 'Teszt címke',
            'slug' => 'teszt-cimke',
            'is_active' => true,
        ]);

        $response = $this->get('/tag/teszt-cimke');

        $response->assertOk();
        $response->assertSeeLivewire(TagPage::class);
    });

    it('displays the tag name', function (): void {
        $tag = Tag::factory()->create([
            'name' => 'Laravel tippek',
            'slug' => 'laravel-tippek',
            'is_active' => true,
        ]);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertSee('Laravel tippek');
    });

    it('displays published blog posts with the tag', function (): void {
        $category = BlogCategory::factory()->create([
            'is_active' => true,
        ]);

        $tag = Tag::factory()->create([
            'slug' => 'teszt-tag',
            'is_active' => true,
        ]);

        $blog = Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Teszt bejegyzés címkével',
            'slug' => 'teszt-bejegyzes-cimkevel',
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        $blog->tags()->attach($tag);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertSee('Teszt bejegyzés címkével');
    });

    it('does not display unpublished blog posts', function (): void {
        $category = BlogCategory::factory()->create([
            'is_active' => true,
        ]);

        $tag = Tag::factory()->create([
            'slug' => 'teszt-tag',
            'is_active' => true,
        ]);

        $blog = Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Nem publikált bejegyzés',
            'slug' => 'nem-publikalt',
            'is_active' => true,
            'published_at' => null,
        ]);

        $blog->tags()->attach($tag);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertDontSee('Nem publikált bejegyzés');
    });

    it('does not display inactive blog posts', function (): void {
        $category = BlogCategory::factory()->create([
            'is_active' => true,
        ]);

        $tag = Tag::factory()->create([
            'slug' => 'teszt-tag',
            'is_active' => true,
        ]);

        $blog = Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Inaktív bejegyzés',
            'slug' => 'inaktiv',
            'is_active' => false,
            'published_at' => now()->subDay(),
        ]);

        $blog->tags()->attach($tag);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertDontSee('Inaktív bejegyzés');
    });

    it('returns 404 for inactive tag', function (): void {
        Tag::factory()->create([
            'slug' => 'inaktiv-tag',
            'is_active' => false,
        ]);

        $response = $this->get('/tag/inaktiv-tag');

        $response->assertNotFound();
    });

    it('returns 404 for non-existent tag', function (): void {
        $response = $this->get('/tag/nem-letezik');

        $response->assertNotFound();
    });

    it('shows empty state when no posts exist', function (): void {
        $tag = Tag::factory()->create([
            'slug' => 'ures-tag',
            'is_active' => true,
        ]);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertSee('Ezzel a címkével még nincsenek bejegyzések.');
    });

    it('displays blog category name for each post', function (): void {
        $category = BlogCategory::factory()->create([
            'name' => 'Fejlesztés',
            'is_active' => true,
        ]);

        $tag = Tag::factory()->create([
            'slug' => 'teszt-tag',
            'is_active' => true,
        ]);

        $blog = Blog::factory()->create([
            'blog_category_id' => $category->id,
            'title' => 'Teszt bejegyzés',
            'slug' => 'teszt-bejegyzes',
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        $blog->tags()->attach($tag);

        Livewire::test(TagPage::class, ['tag' => $tag])
            ->assertSee('Fejlesztés');
    });
});
