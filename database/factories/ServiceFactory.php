<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $titleUz = $this->faker->unique()->sentence(3);
        return [
            'slug'         => Str::slug($titleUz),
            'is_active'    => true,
            'sort_order'   => $this->faker->numberBetween(0, 100),
            'published_at' => now()->subDays(rand(0, 30)),
            'title_uz'     => $titleUz,
            'title_ru'     => $this->faker->sentence(3),
            'title_en'     => $this->faker->sentence(3),
            'excerpt_uz'   => $this->faker->sentence(10),
            'excerpt_ru'   => $this->faker->sentence(10),
            'excerpt_en'   => $this->faker->sentence(10),
            'content_uz'   => $this->faker->paragraph(5),
            'content_ru'   => $this->faker->paragraph(5),
            'content_en'   => $this->faker->paragraph(5),
            'icon'         => 'fa-solid fa-cog',
        ];
    }
}
