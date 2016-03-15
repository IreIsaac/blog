<?php

namespace App;

use Auth;
use App\Tag;
use Markdown;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'slug', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        // Must be signed in to create user so
        // instead of putting it in the form
        // lets grab it from session
        static::creating(function ($post) {
            if (!$post->user_id) {
                $post->user_id = Auth::id();
            }

        });

        // since title needs to unique I 
        // think we are ok using a simple
        // function to make a url safe slug
        static::saving(function ($post) {
            if (!$post->slug) {
                $post->slug = str_slug($post->title);
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo $relation
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo $relation
     */
    public function author()
    {
        return $this->user();
    }

    /**
     * Blog Post Can Have Many Tags.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * get post but only if it has the tag
     * requested. Userful for request filter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $tag
     *
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeTaggedBy($query, $tag)
    {
        if ($tag && $this->foreignParamExists(Tag::class, 'name', $tag)) {
            return $query->has('tags', '>=', 1, 'and', function ($q) use ($tag) {
                    $q->where('name', $tag);
            });
        }

        return $query->with('tags');
    }

    /**
     * get post but only if the were written by the author
     * requested. Userful for request filter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $author
     *
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeWrittenBy($query, $author)
    {
        if ($author && $this->foreignParamExists(User::class, 'username', $author)) {
            return $query->has('user', '>=', 1, 'and', function ($q) use ($author) {
                $q->where('username', $author);
            });
        }

        return $query->with('user');
    }

    /**
     * Get the body of a post in html instead of
     * the markdown it was hopefully written in..
     * 
     * @param mixed $body
     *
     * @return string
     */
    public function getHtmlAttribute($body = null)
    {
        return Markdown::convertToHtml($this->body);
    }

    /**
     * Check/Validate a relationship has the
     * key we want to filter our query by.
     * 
     * @param string $model
     * @param string $key
     * @param string $value
     * @param string $method
     *
     * @return bool $exists
     */
    protected function foreignParamExists($model, $key, $value, $method = 'where')
    {
        return forward_static_call_array([$model, $method], [$key, $value])->exists();
    }
}
