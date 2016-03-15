<fieldset class="container">
    <form method="POST" action="{{ route('register.post') }}">
        {{ csrf_field() }}
        <div>
            <label for="firstname">First Name</label>
            @if($errors->has('firstname'))
                <span class="error">{{ $errors->first('firstname')}}</span>
            @endif
            <input name="firstname" type="text" value="{{ old('firstname') }}" placeholder="First Name"></input>
        </div>
        <div>
            <label for="lastname">Last Name</label>
            @if($errors->has('lastname'))
                <span class="error">{{ $errors->first('lastname')}}</span>
            @endif            
            <input name="lastname" type="text" value="{{ old('lastname') }}" placeholder="Last Name"></input>
        </div>        
        <div>
            <label for="email">Email</label>
            @if($errors->has('email'))
                <span class="error">{{ $errors->first('email')}}</span>
            @endif            
            <input name="email" type="email" value="{{ old('email') }}" placeholder="Email Address"></input>
        </div>
        <div>
            <label for="password">Password</label>
            @if($errors->has('password'))
                <span class="error">{{ $errors->first('password')}}</span>
            @endif            
            <input name="password" type="password" value="{{ old('password') }}" placeholder="Secrets...."></input>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            @if($errors->has('password_confirmation'))
                <span class="error">{{ $errors->first('password_confirmation')}}</span>
            @endif            
            <input name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" placeholder="Confirm Your Secret"></input>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i>Register
        </button>
    </form>
</fieldset>