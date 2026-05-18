<?php

namespace Juniyasyos\TableRepeater\Tests\Database\Factories;

use Juniyasyos\TableRepeater\Tests\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'seo' => null,
        ];
    }
}
