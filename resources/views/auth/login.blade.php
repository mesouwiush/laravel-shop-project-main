@extends('layouts.auth')

@section('content')
    <div class="relative justify-center items-center w-full h-[100vh] bg-white grid lg:grid-cols-2 lg:pl-6">
        <img src="/images/stars.svg" class="h-[12rem] w-auto absolute z-0 right-0 top-[15rem] left-auto m-0 p-0 opacity-50" alt="">
        <div class="w-full h-[95%] register-section shadow-[inset_-12px_-8px_40px_#46464620] hidden lg:flex items-center justify-center text-center rounded-[2em] ">
            <img class='w-[80%]' src="/images/login.gif" alt="">
        </div>
        <div class="relative w-full h-full flex flex-col justify-between px-8 py-8 lg:px-24 gap-[25px] order-last">
            <div class="relative flex items-start z-1">
                <x-logo />
            </div>
            <div>
            <div class="relative flex flex-col gap-[5px] z-1">
                <span class="lg:text-start text-center text-[#B0C3FF] text-[1em] font-semibold uppercase tracking-wide">Account</span>
                <span class="lg:text-start text-center text-[2.5em] font-bold  tracking-wide">Login</span>
                <span class="lg:text-start text-center text-[1em] font-normal tracking-normal">Enter your credentials to continue</span>
            </div>

            <form action=" {{route('login')}}" method="post" class="relative py-4 flex flex-col gap[25px] z-1">
                @csrf
                    <label for="email" class="py-2 text-start">
                        Email
                        <input type="email"
                        name="email"
                        id="email"
                        placeholder="Your Email"
                        class="bg-gray-100 border-2 w-full px-4 py-2 rounded-[2em] mt-2 @error('name') border-red-500 @enderror"
                        value="{{old('email')}}"
                        required >
                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </label>

                    <label for="password" class="py-2 text-start">
                        Password
                        <input type="text"
                        name="password"
                        id="password"
                        placeholder="Choose a password"
                        class="bg-gray-100 border-2 w-full px-4 py-2 rounded-[2em] mt-2 @error('name') border-red-500 @enderror"
                        value=""
                        required >
                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </label>

                        <div class="mt-2">
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember" class="mr-3">
                                <label for="remember">Remember me</label>
                            </div>
                        </div>

                    <a href="/register" class="pt-3 underline opacity-65">Don't have account? Register here</a>
                    <button
                    type="submit"
                    class="bg-[#B0C3FF] w-full py-3 text-white mt-6 font-semibold rounded-[2em] text-[1.2em] tracking-wide hover:text-black transition-all duration-500">
                        Login
                    </button>


            </form>

            @if (session('status'))
            <div class="text-red-500 mt-2 text-sm">
                {{session('status')}}
            </div>
        @endif

        </div>
        <div>
            <a href="/" class="opacity-50">Go Back</a>
        </div>
        </div>

    </div>
    <script src="{{ asset('js/form-validation.js') }}"></script>
@endsection
