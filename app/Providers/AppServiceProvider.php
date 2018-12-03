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

            //select year(created_at) year, monthname(created_at) month, count(*) published  from posts group by 1, 2 order by min(created_at) DESC

            $archiveArticles = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published ')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) DESC')->get();

            $view->with('categories', $categories)->with('tags', $tags)->with('archiveArticles', $archiveArticles);
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
