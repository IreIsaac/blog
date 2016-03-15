@extends('admin.layout.main')

@section('content')
    <div class="container">
        <table id="admin-posts" class="tables">
        <div class="right">
            <ul>
                <li><a class="button" href="{{ route('admin.post.create') }} " title="Create A New Post">Create New Post</a></li>
            </ul>
        </div>
            <thead>
                <tr>
                    <th>Title <i class="fa fa-sort"></i></th>
                    <th>Author <i class="fa fa-sort"></i></th>
                    <th>Created <i class="fa fa-sort"></i></th>
                    <th>Updated <i class="fa fa-sort"></i></th>
                    <th>Actions <i class="fa fa-sort"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td style="text-align: center; padding-left:0; padding-right: 0;">
                            <a class="button" href="{{ route('admin.post.show', ['post' => $post->slug ]) }}">
                                <i class="fa fa-file-code-o"></i>  Preview
                            </a>
                            <a class="button" href="{{ route('admin.post.edit', ['post' => $post->slug ]) }}">
                                <i class="fa fa-pencil"></i>  Edit
                            </a>
                            <button  class="button button-delete" v-delete-btn route="{{ route('admin.post.destroy', ['post' => $post->slug]) }}">
                                    <i class="fa fa-trash"></i>  Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('public.partials.pagination', ['model' => $posts])
    </div>
@endsection