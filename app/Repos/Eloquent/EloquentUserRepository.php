<?php

namespace App\Repos\Eloquent;

use App\Repos\UserRepository;
use App\User;
use Illuminate\Cache\Repository as Cache;
use Illuminate\Http\Request;

/**
 * User Repo.
 */
class EloquentUserRepository implements UserRepository
{
    /**
     * Elquent User Model.
     *
     * @var \App\User
     */
    protected $user;

    /**
     * App Cache Repository.
     *
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    public function __construct(User $user, Cache $cache)
    {
        $this->user = $user;

        $this->cache = $cache;
    }

    public function paginate(Request $request)
    {
        $cacheKey = 'user:list:page-'.($page = $request->query('page', 1));

        return $this->cache->remember($cacheKey, $this->getCacheTime(), function () use ($request, $page) {

            return $this->user->paginate();
        });
    }

    public function findBySlug($slug)
    {
        return $this->cache->rememberForever('user:'.$slug, function () use ($slug) {

            $user = $this->user->newQuery()->with('posts.tags')->where('username', $slug)->first();

            return $user;
        });
    }

    protected function getCacheTime()
    {
        if (app()->environment('local')) {
            return 0;
        }

        return 60;
    }
}
