<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++) {
            $new_post = new Post();
            $new_post->title = $faker->sentence(rand(2,5));
            $new_post->content = $faker->text(rand(100,200));
            $new_post->category_id = $faker->numberBetween(1, 5);
            $slug = Str::slug($new_post->title, '-');
            $slug_appoggio = $slug;

            $post_attuale = Post::where('slug', $slug)->first();
            $cont = 1;

            if($post_attuale) {
                $slug = $slug_appoggio . '-' . $cont;
                $cont++;
                $post_attuale = Post::where('slug', $slug)->first();
            }

            $new_post->slug = $slug;
            $new_post->user_id = 1;
            $new_post->save();
        }
    }
}
