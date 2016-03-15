@extends('public.layout.main')

@section('content')

    <div class="container">
        <h1>{{ $post->title }}</h1>

        <p>{!! $post->html !!}</p>
    </div>

@endsection