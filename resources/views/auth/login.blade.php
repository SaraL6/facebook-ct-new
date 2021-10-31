@extends('layouts.app')

@section('content')
<div class=" p-20 h-screen w-screen flex flex-col-reverse md:flex-row items-center justify-center bg-gray-200" >
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
            <button class="modal-open w-full bg-green-400 mt-8 mb-4 text-white p-3 rounded-lg font-semibold text-lg" id="delete-btn" > Create New Account</button>


        </div>
            <div class=" overflow-y-auto h-full w-full absolute inset-0 hidden justify-center items-center" id="overlay">
                <div class="py-2 rounded text-gray-800 register-form">


                  <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4  text-white text-sm z-50">
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                      <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                    <span class="text-sm">(Esc)</span>
                  </div>

                  <div class="modal-content py-4 text-left px-6">
                        <form
                        method="POST" action="{{ route('register') }}"
                            class="w-80 p-4 flex flex-col bg-white rounded-lg"
                        >
                        @csrf
                            <div class="flex justify-between items-center pb-3">
                               <div class="flex-row">
                                <p class="text-2xl font-bold">Sign Up</p>
                                <p class="text-xl ">It's quick and easy</p>
                               </div>
                                <div class="modal-close cursor-pointer z-50 mb-16">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"  id="close-modal">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                </svg>
                                </div>
                            </div>
                                <input
                                    id="name"
                                    type="text"
                                    class="mb-3 py-3 px-4 border border-gray-400 bg-gray-100 focus:outline-none rounded-lg focus:ring-1 ring-cyan-500"
                                    name="name"
                                    value=""
                                    required
                                    autocomplete="name"
                                    autofocus
                                    placeholder="Name"
                                    ref="name"

                                />

                                <input
                                    id="email"
                                    type="email"
                                    class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-lg focus:ring-1 ring-cyan-500"
                                    name="email"
                                    value=""
                                    required
                                    autocomplete="email"
                                    placeholder="Email adress"

                                />

                                <input
                                    id="password"
                                    type="password"
                                    class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-lg focus:ring-1 ring-cyan-500"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Password"

                                />

                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="mb-3 py-3 px-4 border border-gray-400 focus:outline-none rounded-lg focus:ring-1 ring-cyan-500"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Confirm password"

                                />
                                <div class="flex justify-end pt-2">
                                    <button type="submit"
                                    class="mx-auto bg-fb-green mb-2  text-white p-2 px-4 rounded-lg font-semibold text-lg">Sign Up</button>
                                </div>
                        </form>

                     </div>
                </div>
        </div>

</div>


@endsection
@push('js')
<script src="{{ asset('js/custom.js') }}" ></script>
@endpush
