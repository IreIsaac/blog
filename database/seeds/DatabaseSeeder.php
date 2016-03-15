<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(App\User::class, 3)->create();

        factory(App\Tag::class, 25)->create();

        factory(App\Post::class, 100)->create()->each(function ($post) {
            $tagCount = App\Tag::count();
            $tags = [];

            for ($i = 0; $i < rand(1, 5); ++$i) {
                $tags[] = rand(1, $tagCount);
            }

            $post->tags()->attach($tags);
        });
    }
}
