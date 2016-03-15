<?php

namespace App\Repos;

interface TagRepository
{
    /**
     * get all the tags.
     * 
     * @return \App\Tag $tags
     */
    public function all();
}
