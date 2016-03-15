@extends('admin.layout.main')

@section('content')

    <div class="container">
        <h3>Name: {!! $user->name !!}</h3>
        <h3>Email: {!! $user->email !!}</h3>
    </div>

    <div class="container">
        {!! dump($user->posts) !!}
    </div>

    <div class="container">
        {!! dump($user->posts->pluck('tags')->flatten()->groupBy('name')) !!}
    </div>
    
@endsection