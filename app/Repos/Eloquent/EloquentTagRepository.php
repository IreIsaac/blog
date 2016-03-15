<?php

namespace App\Repos\Eloquent;

use App\Tag;
use App\Repos\TagRepository;
use Illuminate\Cache\Repository as Cache;

/**
 * Eloquent Tag Repo.
 */
class EloquentTagRepository implements TagRepository
{
    protected $tag;

    protected $cache;

    /**
     * @param \App\Tag                     $tag
     * @param \Illuminate\Cache\Repository $cache
     */
    public function __construct(Tag $tag, Cache $cache)
    {
        $this->tag = $tag;

        $this->cache = $cache;
    }

    public function all()
    {
        return $this->cache->rememberForever('tags:all', function () {

            return $this->tag->get(['id', 'name', 'description']);
        });
    }
}
