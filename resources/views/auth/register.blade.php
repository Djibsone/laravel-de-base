@extends('base')

@section('title', 'S\'inscrire')

@section('content')

    <form method="post">

        @csrf
        <h1>S'inscrire</h1>

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="name" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                {{ $message }}
            @enderror
        </div>
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
        <div class="my-3">
            <a class="" href="{{ route('auth.login') }}">Se connecter</a>
        </div>
        
        <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>    
        {{-- <hr>
        <div class="my-3">
            <a class="" href="{{ route('auth.login') }}">Se connecter</a>
        </div> --}}

    </form>

@endsection