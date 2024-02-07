    {{-- NavBar functionality FRONTEND --}}
    <nav class="relative lg:px-24 mx-auto p-6 w-full bg-white flex lg:hidden justify-between z-40">
        <x-logo />
        <button id="sidebarToggle" class="lg:hidden">

            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24" fill="none">
                <g clip-path="url(#clip0_429_11066)">
                <path d="M3 6.00092H21M3 12.0009H21M3 18.0009H21" stroke="#292929" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
                <defs>
                <clipPath id="clip0_429_11066">
                <rect width="24" height="24" fill="white" transform="translate(0 0.000915527)"/>
                </clipPath>
                </defs>
                </svg>


        </button>
    </nav>

    <div id="sidebar" class="fixed right-0 top-0 h-full bg-white transform translate-x-full overflow-auto transition-transform duration-200 ease-in-out lg:hidden z-30" style="width: 100%;">
        {{-- Inner container for controlable padding --}}
        <div class="relative flex flex-col py-[8em] w-full h-full px-8 justify-between">
            <div class="">
                <ul class="text-center">
                    <li class="py-2 border border-opacity-50 border-t-0 border-l-0 border-r-0 border-b-1 border-black"><a href="#">Link $</a></li>
                    <li class="py-2 border border-opacity-50 border-t-0 border-l-0 border-r-0 border-b-1 border-black"><a href="#">Link $</a></li>
                    <li class="py-2 border border-opacity-50 border-t-0 border-l-0 border-r-0 border-b-1 border-black"><a href="#">Link $</a></li>
                    <li class="py-2 border border-opacity-50 border-t-0 border-l-0 border-r-0 border-b-1 border-black"><a href="#">Link $</a></li>
                </ul>
                <x-dropdown class="py-2 border border-opacity-50 border-t-0 border-l-0 border-r-0 border-b-1 border-black" :items="[
                    ['label' => 'Login', 'href' => '/login'],
                    ['label' => 'Register', 'href' => '/register'],
                    // Add more items here
                ]" />
            </div>
            <button class="w-full p-4 bg-[#20A4F3]">
                <a href="" class="font-semibold">Text</a>
            </button>
        </div>

    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('translate-x-full');
        });
    </script>
