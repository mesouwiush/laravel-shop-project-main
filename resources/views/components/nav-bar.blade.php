    {{-- NavBar functionality FRONTEND --}}
    <nav class="hidden lg:px-24 mx-auto p-6 w-full bg-white lg:flex justify-between my-auto">
        <x-logo />

        <ul class="lg:flex flex-row hidden my-auto">

            <li class="px-6 font-semibold text-md "><a href="">Main Page</a></li>
            <li class="px-6 font-semibold text-md "><a href=" {{ route('products') }} ">News</a></li>
            <li class="px-6 font-semibold text-md "><a href="">About Us</a></li>
            <li class="px-6 font-semibold text-md "><a href="{{ route('cart.index') }}">Cart</a></li>
            {{-- Show when logged in --}}
            @auth
            <li class="px-6 font-semibold text-md ">
                <x-dropdown-menu buttonText="Account" :items="[
                    ['label' => 'Dashboard', 'href' => '/dashboard'],
                    ['label' => 'Logout', 'href' => route('logout'), 'logout' => true],
                ]" />
            </li>
            @endauth
            {{-- Show to a guest --}}
            @guest
            <li class="px-6 font-semibold text-md ">
                <x-dropdown-menu buttonText="Account" :items="[
                    ['label' => 'Login', 'href' => '/login'],
                    ['label' => 'Register', 'href' => '/register'],
                ]" />
            </li>
            @endguest
        </ul>


    </nav>
