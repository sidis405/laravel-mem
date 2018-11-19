<?php

namespace App\Providers;

use App\Tag;
use App\Post;
use App\Category;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);

        View::composer('layouts.app', function ($view) {
            $categories = Category::whereHas('posts')->withCount('posts')->get()->sortByDesc('posts_count');
            $tags = Tag::whereHas('posts')->withCount('posts')->get();


            $view->with('categories', $categories)->with('tags', $tags);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
