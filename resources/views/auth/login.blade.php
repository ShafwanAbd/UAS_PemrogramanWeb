@extends('layouts.layoutMain')

@section('content')
<div class="container_login">
    <div class="container_isi">
        <form method="POST" action="{{ route('login') }}">
        @csrf

            <h1>Masuk</h1>

            <div class="input">
                <h5>Username</h5>
                <input class="form-control @error('uname') is-invalid @enderror" name="uname" value="{{ old('uname') }}" required autocomplete="uname" autofocus>
            
                @error('uname')
                <span class="alert-message" role="alert">
                    {{ $message }}
                </span>
                @enderror
            
            </div>


            <div class="input">
                <h5>Password</h5>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                
                @error('password')
                <span class="alert-message" role="alert">
                    {{ $message }}
                </span>
                @enderror
            
            </div>


            <div class="container_bottom flex">

                <div class="input">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember Me?</label>
                </div>

                <div class="register">
                    <a href="{{ route('register') }}">Buat Akun Baru</a>
                </div>

            </div>

            <h2><button type="submit">Submit</button></h2>

        </form>
    </div>
</div>
@endsection
