@extends('layouts.auth')

@section('content')
    <div class="justify-center items-center w-full h-[100vh] bg-white grid lg:grid-cols-2 lg:pr-6">
        <img src="/images/stars.svg" class="h-[12rem] w-auto absolute z-0 left-0 top-[10rem] m-0 p-0 transform scale-x-[-1] opacity-50" alt="">
        <div class="relative w-full h-full flex flex-col justify-between px-8 py-8 lg:px-24 gap-[25px]">
            <div class="flex items-start">
                <x-logo />
            </div>
            <div>
            <div class="flex flex-col gap-[5px]">
                <span class="lg:text-start text-center text-[#B0C3FF] text-[1em] font-semibold uppercase tracking-wide">Account</span>
                <span class="lg:text-start text-center text-[2.5em] font-bold  tracking-wide">Registration</span>
                <span class="lg:text-start text-center text-[1em] font-normal tracking-normal">Enter your credentials to continue</span>
            </div>
            <form action=" {{route('register')}}" method="post" class="py-4 flex flex-col gap[25px] ">
                @csrf
                    <div class="flex flex-col lg:flex-row w-full lg:gap-[25px]">
                        <label for="name" class="py-2 w-full text-start">
                            <span class="">Name</span>
                            <input type="text"
                            name="name"
                            id="name"
                            placeholder="Name"
                            class="bg-gray-100 border-2 w-full px-4 py-2 rounded-[2em] mt-2 @error('name') border-red-500 @enderror"
                            value="{{old('name')}}"
                            required >
                            @error('name')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
                        </label>

                        <label for="username" class="py-2 w-full text-start">
                            Username
                            <input type="text"
                            name="username"
                            id="username"
                            placeholder="Username"
                            class="bg-gray-100 border-2 w-full px-4 py-2 rounded-[2em] mt-2 @error('name') border-red-500 @enderror"
                            value="{{old('username')}}"
                            required >
                            @error('username')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
                        </label>
                    </div>
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


                    <label for="password_confirmation'" class="py-2 text-start">
                        Password Confirmation
                        <input type="text"
                        name="password_confirmation"
                        id="password_confirmation'"
                        placeholder="Choose a password"
                        class="bg-gray-100 border-2 w-full px-4 py-2 rounded-[2em] mt-2 @error('name') border-red-500 @enderror"
                        value=""
                        required >
                        @error('password_confirmation')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </label>


                    <div class="flex items-start pt-5 h-fit">
                        <input type="checkbox" id="terms" name="terms" class='mt-1' required>
                        <label for="terms" class="ml-4 font-light text-[0.8em]">We at Wasai LLC respect the privacy of your personal information and, as such, make every effort to ensure your information is protected and remains private. As the owner and operator of loremipsum.io (the "Website") hereafter referred to in this Privacy Policy as "Lorem Ipsum", "us", "our" or "we", we have provided this Privacy Policy to explain how we collect, use, share and protect information about the <a href="/privacy" class="underline">Privacy policy</a></label>
                        <p id="termsError" class="hidden text-red-500 mt-2">You must agree to the terms and conditions.</p>
                    </div>

                    <button
                    type="submit"
                    class="bg-[#B0C3FF] w-full py-3 text-white mt-6 font-semibold rounded-[2em] text-[1.2em] tracking-wide hover:text-black transition-all duration-500">
                        Register
                    </button>

            </form>
        </div>
        <div>
            <a href="/" class="opacity-50">Go Back</a>
        </div>
        </div>
        <div class="w-full h-[95%] register-section shadow-[inset_-12px_-8px_40px_#46464620] hidden lg:flex items-center justify-center text-center rounded-[2em]">
            <img class='w-[80%]' src="/images/animated-security.gif" alt="">
        </div>
    </div>
    <script src="{{ asset('js/form-validation.js') }}"></script>
@endsection
