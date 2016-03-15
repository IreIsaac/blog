<?php

namespace App\Repos;

use Illuminate\Http\Request;

interface UserRepository
{
    /**
     * Get A paginated list of users with relationships.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Users|mixed $users
     */
    public function paginate(Request $request);

    public function findBySlug($slug);
}
