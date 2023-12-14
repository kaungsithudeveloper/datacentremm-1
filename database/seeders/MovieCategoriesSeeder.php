<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Backend\Category;
use Illuminate\Support\Facades\DB;

class MovieCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Add more movie categories as needed
            [
                'name' => ' Animation Movies',
                'slug' => 'animation-movies',
                'type' => 'movie',
            ],
            [
                'name' => 'Asean Movies',
                'slug' => 'asean-movies',
                'type' => 'movie',
            ],
            [
                'name' => 'Bolllywood Movies',
                'slug' => 'bolllywood-movies',
                'type' => 'movie',
            ],
            [
                'name' => 'China Movies',
                'slug' => 'china-movies',
                'type' => 'movie',
            ],
            [
                'name' => 'Hollywood Movies',
                'slug' => 'hollywood-movies',
                'type' => 'movie',
            ],
            [
                'name' => 'Japan Movies',
                'slug' => 'japan-movies',
                'type' => 'movie',
            ],
            [
                'name' => 'Korea Movies',
                'slug' => 'korea-movies',
                'type' => 'movie',
            ],

            // Add more series categories as needed

            [
                'name' => 'Animation Series',
                'slug' => 'animation-series',
                'type' => 'serie',
            ],
            [
                'name' => 'Asean Series',
                'slug' => 'asean-series',
                'type' => 'serie',
            ],
            [
                'name' => 'Bolllywood Series',
                'slug' => 'bolllywood-series',
                'type' => 'serie',
            ],
            [
                'name' => 'China Series',
                'slug' => 'china-series',
                'type' => 'serie',
            ],
            [
                'name' => 'Hollywood Series',
                'slug' => 'hollywood-series',
                'type' => 'serie',
            ],
            [
                'name' => 'Japan Series',
                'slug' => 'japan-series',
                'type' => 'serie',
            ],
            [
                'name' => 'Korea Series',
                'slug' => 'korea-series',
                'type' => 'serie',
            ],

            // Add more categories as needed
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

    }
}
