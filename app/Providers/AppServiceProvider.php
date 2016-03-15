<?php

namespace App\Providers;

use App\Post;
use App\Repos\Eloquent\EloquentPostRepository;
use App\Repos\Eloquent\EloquentTagRepository;
use App\Repos\Eloquent\EloquentUserRepository;
use App\Repos\PostRepository;
use App\Repos\TagRepository;
use App\Repos\UserRepository;
use App\Tag;
use App\User;
use Illuminate\Cache\Repository;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\CommonMarkConverter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->registerRepositories();

        $this->registerMarkdownService();
    }

    /**
     * Bind Repo Interfaces To The Implementation
     * We Want To Use.
     */
    protected function registerRepositories()
    {
        $this->app->singleton(TagRepository::class, function ($app) {
            $cache = $app['Illuminate\Cache\Repository'];
            $tag = new Tag();

            return new EloquentTagRepository($tag, $cache);
        });

        $this->app->singleton(PostRepository::class, function ($app) {
            $post = new Post();

            return new EloquentPostRepository($post);
        });

        $this->app->singleton(UserRepository::class, function ($app) {
            $cache = $app['Illuminate\Cache\Repository'];
            $user = new User();

            return new EloquentUserRepository($user, $cache);
        });
    }

    /**
     * Give our app basic markdown Functionality.
     */
    protected function registerMarkdownService()
    {
        $this->app->singleton(CommonMarkConverter::class, function ($app) {
            return new CommonMarkConverter();
        });
    }
}
