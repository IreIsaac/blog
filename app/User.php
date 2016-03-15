<?php

namespace App;

use App\Post;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password',
    ];

    /**
     * Easy way to add a human readable name to 
     * the json/query results.
     * 
     * @var array
     */
    protected $appends = ['name'];

    /**
     */
    protected static function boot()
    {
        static::deleting(function ($user) {
            if (\Cache::has($user->cacheKey())) {
                \Cache::forget($user->cacheKey());
            }
        });

        static::saving(function ($user) {
            // username has to be unique so if
            // we made it this far I think its 
            // save to use a simple function to create
            // a slug/username
            if (!$user->username) {
                $user->username = str_slug($user->name);
            }

            //  for now manually check cache and
            //  remove key when something is changed
            if (\Cache::has($user->cacheKey())) {
                \Cache::forget($user->cacheKey());
            }
        });
    }

    /**
     * need to find a better solution here.
     *
     * @return string $key
     */
    public function cacheKey()
    {
        return 'user:'.$this->username;
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user/author can write many posts.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany $posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * accessor to get a human readable name for
     * making sentences and other english essentials...
     * 
     * @return string $name
     */
    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
