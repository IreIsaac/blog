@extends('admin.layout.main')

@section('content')

<div style="text-align: center; margin-top: 2em;" class="container">
    <h1>Edit Blog Post</h1>
</div>
<hr>
@include('admin.post.form', ['post' => $post])

@endsection