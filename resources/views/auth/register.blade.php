@extends('layouts.app')

@section('content')
<div class="w3-row">
    <div class="w3-col s1 m2 l3"><p></p></div>
    <div class="w3-col s10 m8 l6">
        <div class="w3-card-2">
            <div class="w3-container w3-theme-l1">
                <h2>Criar uma nova conta</h2>
            </div>
            <form class="w3-container" method="POST" action="{{ route('register') }}">
                <br>{{ csrf_field() }}
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="email" >Nome</label>
                    <input class="w3-input" name="name" id="name" type="text" value="{{ old('name') }}"  required>
                </div>
                @if ($errors->has('name'))
                <div class="w3-panel w3-pale-red w3-round w3-text-red">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
                @endif

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" >E-mail</label>
                    <input class="w3-input" name="email" id="email" type="email" value="{{ old('email') }}" required >
                </div>
                @if ($errors->has('email'))
                <div class="w3-panel w3-pale-red w3-round w3-text-red">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
                @endif

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}" required>
                    <label for="email" >Senha</label>
                    <input class="w3-input" name="password" id="password" type="password" value="{{ old('password') }}" required >
                </div>

                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="email" >Corfirmar Senha</label>
                    <input class="w3-input" name="password_confirmation" id="password_confirmation" type="password" value="{{ old('password_confirmation') }}" required >
                </div>

                @if ($errors->has('password'))
                <div class="w3-panel w3-pale-red w3-round w3-text-red">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
                @endif
                <p>
                    <button type="submit" class="w3-btn w3-theme-l1">Criar conta</button>
                </p>
            </form>
        </div>
    </div>
    <div class="w3-col s1 m2 l3"><p></p></div>
</div>

@endsection
