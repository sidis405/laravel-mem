<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(App\Category::class, 10)->create();
        $tags = factory(App\Tag::class, 30)->create();

        App\User::create([
            'name' => 'Sidrit',
            'email' => 'forge405@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 'admin'
        ]);

        factory(App\User::class, 9)->create();

        $users = App\User::all();

        foreach ($users as $user) {
            $posts = factory(App\Post::class, 15)->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()
            ]);

            foreach ($posts as $post) {
                $randomTags = $tags->random(3);

                $post->tags()->sync($randomTags->pluck('id'));
            }
        }
    }
}
