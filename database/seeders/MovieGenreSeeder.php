<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Backend\Genre;
use Illuminate\Support\Facades\DB;

class MovieGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $genres = [
            [
                'name' => 'Action',
                'slug' => 'action',
                'type' => 'movie',
            ],
            [
                'name' => 'Drama',
                'slug' => 'drama',
                'type' => 'serie',
            ],
            [
                'name' => 'Video',
                'slug' => 'video',
                'type' => 'game',
            ],
            // Add more categories as needed
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
