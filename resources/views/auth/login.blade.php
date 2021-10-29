@extends('layouts.app')

@section('content')
<div class=" p-20 h-screen w-screen flex flex-col-reverse md:flex-row items-center justify-center bg-gray-200">
    <div class="content p-6 text-3xl text-center md:text-left">
        <h1 class="text-5xl text-blue-500 font-bold">Facebook</h1>
        <p>Connect with friends and the world around you on Facebook.</p>
    </div>

    <div class="mx-auto flex flex-col login-form ">
        <form method="POST" action="{{ route('login') }}" class="shadow-lg w-80 p-4 flex flex-col bg-white rounded-lg">
            @csrf





            <input id="email" type="email" placeholder="Email or Phone Number"
                class=" rounded-lg mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-md focus:ring-1 ring-cyan-500 @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="password" type="password" placeholder="Pasword"
                class=" rounded-lg mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-md focus:ring-1 ring-cyan-500 @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror



            <div class="form-group row m-4">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>



            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg font-semibold text-lg">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
            <a class="text-blue-400 text-center my-2" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif

            <hr>

        </form>
        <modal-register />
    </div>


</div>
</div>
@endsection
