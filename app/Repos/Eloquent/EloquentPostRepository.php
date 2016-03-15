<?php

namespace App\Repos\Eloquent;

use App\Post;
use Illuminate\Http\Request;
use App\Repos\PostRepository;

/**
 * Eloquent Post Repo.
 */
class EloquentPostRepository implements PostRepository
{
    /**
     * Eloquent Post Model.
     *
     * @var \App\Post
     */
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Retrieve A List Of Paginated Articles
     * and apply any filters that may be passed
     * in the request query.
     *
     * @param Request $request
     *
     * @return \App\Post $post
     */
    public function paginate(Request $request)
    {
        $posts = $this->post
            ->taggedBy($request->query('tag'))
            ->writtenBy($request->query('by'))
            ->orderBy(
                $request->query('order', 'id'),
                $this->orderByDirection($request->query('dir'))
            )
            ->paginate($request->query('per', 15));

        //  If a filter was applyed and there is
        //  more results than can be shown on one page 
        //  we need to apply the query string
        if (count($request->query()) > 0) {
            $posts->appends($request->query());
        }

        return $posts;
    }

    /**
     * Check request for a sort direction and 
     * make sure it is a direction and not gibberish.
     * 
     * @param string|null $direction
     *
     * @return string
     */
    public function orderByDirection($direction)
    {
        if ($direction && in_array($direction, ['asc', 'desc'])) {
            return (string) $direction;
        }

        return 'desc';
    }

    /**
     * Find A model by its slug.
     * 
     * @param string $slug
     *
     * @return \App\Post $post
     */
    public function findBySlug($slug)
    {
        return $this->post
            ->where('slug', $slug)
            ->with(['tags', 'user'])
            ->first();
    }

    /**
     * Easy way to pass any methody not found in
     * the repo to the underlying Eloquent Model.
     * 
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, array $args)
    {
        return call_user_func_array([$this->post, $method], $args);
    }
}
