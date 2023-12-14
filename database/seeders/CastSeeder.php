<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Backend\Cast;
use Illuminate\Support\Facades\DB;

class CastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $casts = [
            [
                'name' => 'Tom Hiddleston',
                'slug' => 'tom-hiddleston',
            ],

            // Add more categories as needed
        ];

        foreach ($casts as $cast) {
            Cast::create($cast);
        }
    }
}
