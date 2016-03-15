@extends('public.layout.main')

@section('content')
<div class="container">
    <h1>Login</h1>

    <form method="POST" action="{{ route('login.post') }}">
        {{ csrf_field() }}
        <div>
            <label for="email">Email</label>
            @if($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
            <input name="email" type="email" value="{{ old('email') }}"></input>
        </div>

        <div>        
            <label for="password">Password</label>
            @if($errors->has('password'))
                <span class="error">{{ $errors->first('password') }}</span>
            @endif
            <input type="password" name="password" value="{{ old('password') }}"></input>
        </div>

        <label for="remember">
            Remember Me? <input type="checkbox" name="remember"></input>
        </label>

        <button type="submit">Login</button>
    </form>
</div>
@endsection
