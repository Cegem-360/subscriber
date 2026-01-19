<?php

declare(strict_types=1);

namespace Database\Factories\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(4);

        return [
            'blog_category_id' => BlogCategory::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->randomNumber(4),
            'content' => fake()->paragraphs(5, true),
            'excerpt' => fake()->paragraph(),
            'featured_image' => null,
            'meta_title' => fake()->sentence(),
            'meta_description' => fake()->sentences(2, true),
            'og_image' => null,
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'is_active' => true,
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes): array => [
            'published_at' => null,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_active' => false,
        ]);
    }

    public function scheduled(): static
    {
        return $this->state(fn (array $attributes): array => [
            'published_at' => fake()->dateTimeBetween('+1 day', '+1 month'),
        ]);
    }
}
