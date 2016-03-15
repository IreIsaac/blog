<?php

namespace App\Http\ViewComposers\Forms;

use Exception;
use Illuminate\View\View;
use App\Repos\TagRepository;

/**
 * Give The Form Responsible For
 * Blog Post Some Data It Needs.
 */
class PostForm
{
    /**
     * Tag Repository.
     * 
     * @var \App\Repos\EloquentTagRepository
     */
    protected $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Attach The Data To The View.
     *
     * @param \Illuminate\View\View $view
     */
    public function compose(View $view)
    {
        $view->with('tags', $this->tag->all());

        $view->with('action', $this->getAction($view->getData()));
    }

    /**
     * Using the same form for creating
     * and updating posts so to clean up view
     * use laravels route resource naming convention
     * to decide which route the form should be sent to.
     * 
     * @return array $action
     */
    protected function getAction($data)
    {
        $name = request()->route()->getName();

        if (str_contains($name, '.edit')) {
            return $this->updateAction($name, $data);
        }

        if (str_contains($name, '.create')) {
            return $this->createAction($name, $data);
        }

        throw new Exception(
            'Could not find the correct action to complete the Post form, NAME YOUR ROUTES!'
        );
    }

    /**
     * get route & method for storing/creating new post.
     * 
     * @param string $name
     *
     * @return array $action
     */
    protected function createAction($name)
    {
        return [
            'url'    => route(str_replace('.create', '.store', $name)),
            'method' => 'POST',
        ];
    }

    /**
     * get route & method for edit/updating a post.
     * 
     * @param string $name
     *
     * @return array $action
     */
    protected function updateAction($name, $data)
    {
        return [
            'url' => route(
                str_replace('.edit', '.update', $name), ['post' => $data['post']->slug]
            ),
            'method' => 'PUT',
        ];
    }
}
