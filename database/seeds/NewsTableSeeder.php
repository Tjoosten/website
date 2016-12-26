<?php

use App\News;
use App\Tags;
use App\User;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        $tags = factory(Tags::class, 3)->create();
        $news = factory(News::class, 3)
           ->create(['user_id' => $user->id,])
           ->each(function ($news) use ($tags) {
                $news->tags()->attach($tags);
            });
    }
}
