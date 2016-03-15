<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repos\PostRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;

class PostController extends Controller
{
    protected $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->post->paginate($request);

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create', [
            'post' => $this->post->newInstance(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\PostFormRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $post = $this->post->create(
            $request->only(['title', 'body'])
        );

        if (count($request->get('tags')) > 0) {
            $post->tags()->sync($request->get('tags'));
        }

        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        dump($slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\PostFormRequest $request
     * @param string                                   $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $slug)
    {
        $post = $this->post->findBySlug($slug);

        $post->update([
            'title' => $request->get('title'),
            'body'  => $request->get('body'),
        ]);

        $post->tags()->sync($request->get('tags'));

        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = $this->post->findBySlug($slug);

        $post->tags()->sync([]);

        $post->delete();

        return redirect()->route('admin.post.index');
    }
}
