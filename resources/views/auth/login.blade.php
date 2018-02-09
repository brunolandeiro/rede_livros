@extends('layouts.app')

@section('content')
<div class="w3-row">
    <div class="w3-col s1 m2 l3"><p></p></div>
    <div class="w3-col s10 m8 l6">
        <div class="w3-card-2">
            <div class="w3-container w3-theme-d2">
                <h2>Login</h2>
            </div>
            <form class="w3-container" method="POST" action="{{ route('login') }}">
                <br>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" >E-mail</label>
                    <input class="w3-input" name="email" id="email" type="email" value="{{ old('email') }}" required autofocus>
                </div>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="email" >Senha</label>
                    <input class="w3-input" name="password" id="password" type="password" value="{{ old('password') }}" required autofocus>
                </div>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <p>
                    <button type="submit" class="w3-btn w3-theme-d2">Login</button>
                    <a class="w3-btn" href="{{ route('password.request') }}">Esqueceu a senha?</a>
                </p>
            </form>
        </div>
    </div>
    <div class="w3-col s1 m2 l3"><p></p></div>
</div>
@endsection
