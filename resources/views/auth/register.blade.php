@extends('layouts.layoutMain')

@section('content')
<div class="container_login container_register">
    <div class="container_isi">
        <form method="POST" action="{{ route('register') }}">
        @csrf

            <h1>Daftar</h1>

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
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
           
                @error('password')
                <span class="alert-message" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            

            <div class="input">
                <h5>Re-Password</h5>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div> 

            <h2><button type="submit">Submit</button></h2>

        </form>
    </div>
</div>
@endsection
