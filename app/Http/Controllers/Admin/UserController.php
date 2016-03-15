<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repos\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * User Repository.
     *
     * @var \App\Repos\UserRepository
     */
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->user->paginate($request);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form where an admin can create
     * A user from the backend.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        // Delete Post The User Has Written
        if ($user->posts->count() > 0) {
            foreach ($user->posts as $post) {
                $post->delete();
            }
        }

        // Delete the actual user
        $user->delete();

        // Don't redirect if ajax just
        // send the browser a 200
        if (request()->ajax()) {
            return response(['message' => 'User Deleted'], 200);
        }

        // why didn't we use ajax?
        // go back to user list
        return redirect()->route('admin.user.index');
    }

    /**
     * not quite sure where to put this route
     * but it is helpful to be able to clear cached users.
     *
     * @return \Illuminate\Http\response $response
     */
    public function clearCache()
    {
        // Clear User Cache
        \Artisan::call('cache:flush:users');

            // Return Json
        if (request()->ajax()) {
            return response(['results' => 'Cached Cleared Successfully'], 200);
        }
    }
}
