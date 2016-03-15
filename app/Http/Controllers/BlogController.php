<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repos\TagRepository as Tag;
use App\Repos\PostRepository as Post;

class BlogController extends Controller
{
    /**
     * Post Repository.
     *
     * @var \App\Contracts\PostRepository
     */
    protected $post;

    /**
     * Tag Repository.
     *
     * @var \App\Contracts\TagRepository
     */
    protected $tag;

    public function __construct(Post $post, Tag $tag)
    {
        $this->post = $post;

        $this->tag = $tag;
    }

    /**
     * Show A List Of Blog Articles.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response $response
     */
    public function index(Request $request)
    {
        $posts = $this->post->paginate($request);

        $tags = $this->tag->all();

        return view('public.blog.index', compact('posts', 'tags'));
    }

    /**
     * Show A Blog Post.
     *
     * @param Post $post [description]
     *
     * @return \Illuminate\Http\Response $response
     */
    public function show($post)
    {
        return view('public.blog.show', compact('post'));
    }
}
