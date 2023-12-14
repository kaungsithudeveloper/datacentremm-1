<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $taglist = [ "Batman", "Film", "Homeland", "Fast & Furious", "Dead Walker" ];
        foreach ( $taglist as $name ) {
            \App\Models\Backend\PostTags::create([
                "name" => $name
            ]);
        }

        $catlist = [ "General", "Tech", "Mobile", "News", "Language" ];
        foreach ( $catlist as $name ) {
            \App\Models\Backend\PostCategorie::create([
                "name" => $name
            ]);
        }


        $this->call(UserTableSeeder::class);
        //$this->call(BlogTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(MovieCategoriesSeeder::class);
        $this->call(MovieGenreSeeder::class);
        $this->call(CastSeeder::class);
        \App\Models\User::factory(6)->create();
        \App\Models\Backend\Blog::factory(20)->create();
        \App\Models\Backend\PostComment::factory(100)->create();
        \App\Models\Backend\Movie::factory(50)->create();
        \App\Models\Backend\Product::factory(100)->create();
        \App\Models\Frontend\ProductComment::factory(100)->create();

    }
}
