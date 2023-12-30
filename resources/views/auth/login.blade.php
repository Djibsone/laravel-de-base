@extends('base')

@section('title', 'Se connecter')

@section('content')

    <form method="post">

        @csrf
        <h1>Se connecter</h1>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email')
                {{ $message }}
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                {{ $message }} 
            @enderror
        </div>
        <div class="mb-3">
            <a class="" href="{{ route('auth.register') }}">S'inscrire</a>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>    
        {{-- <hr>
        <div class="my-3">
            <a class="" href="{{ route('auth.register') }}">S'inscrire</a>
        </div> --}}

    </form>

@endsection