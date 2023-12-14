<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Backend\Blog;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blog =[
            [
                'id' => 1,
                'title' => 'About Us',
                'description' => 'COntent is comming soon',
                'post_slug' => 'about-us ',
                'status' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Terms & Condition ',
                'description' => 'Content is comming soon',
                'post_slug' => 'terms-condition ',
                'status' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Privacy Policy',
                'description' => 'COntent is comming soon',
                'post_slug' => 'privacy-policy ',
                'status' => 1,
            ],

        ];
        Blog::insert($blog);
    }
}
