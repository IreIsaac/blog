<div class="container">
    <form id="posts-form" method="POST" action="{{ $action['url'] }}">
        {{ csrf_field() }}

        @if($action['method'] !== 'POST')
            {!! method_field($action['method']) !!}
        @endif

        <input type="hidden" name="post_id" value="{{ $post->id }}"></input>

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}"></input>
        </div>

        <div>
            <label for="body">Body</label>
            <textarea name="body" rows="10">{{ old('body', $post->body) }}</textarea>
        </div>

        <div class="container">
            <h2>Select Tags That Apply</h2>
            @foreach($tags as $tag)
                <div class="checkbox">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ ($post->tags->contains('name', $tag->name)) ? 'checked' : '' }}>
                    {{ $tag->name }}
                </div>
            @endforeach
        </div>

        <div>
            <button type="submit">Save Post</button>
        </div>
    </form>
</div>