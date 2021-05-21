<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = config('tags');
        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->name = $tag['name'];
            $new_tag->slug = $tag['slug'];
            $new_tag->save();
        }
    }
}
