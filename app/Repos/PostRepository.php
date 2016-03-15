<?php

namespace App\Repos;

use Illuminate\Http\Request;

interface PostRepository
{
    /**
     * use the request query string to filter a
     * paginated list of posts.
     * 
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Post $post
     */
    public function paginate(Request $request);

    /**
     * validate and add an orderby direction to
     * the query.
     * 
     * @param string|null $direction ('asc' or 'desc')
     *
     * @return string|null $direction
     */
    public function orderByDirection($direction);

    /**
     * use a post slug to get a post with Tags and Author.
     * 
     * @param string $slug
     *
     * @return \App\Post $post
     */
    public function findBySlug($slug);
}
