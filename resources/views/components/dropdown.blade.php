<div class="relative inline-block w-full border border-opacity-50 border-t-0 border-l-0 border-r-0 border-b-1 transition-all border-black">

    {{-- Toggle Button For Mobile Functionality --}}
    <div id="dropdownButton" class="lg:hidden w-full cursor-pointer text-center" onclick="toggleMenu(event)">
        <p class="py-2"> Link </p>
    </div>

    <ul id="dropdownMenu" class="relative flex flex-col hidden text-center" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        @if(isset($items))
            @foreach ($items as $item)
            <li class="py-1">
                @if($item['label'] === 'Logout')
                    <form method="POST" action="{{ $item['href'] }}">
                        @csrf
                        <button type="submit" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-{{ $loop->index }}">{{ $item['label'] }}</button>
                    </form>
                @else
                    <a href="{{ $item['href'] }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-{{ $loop->index }}">{{ $item['label'] }}</a>
                @endif
            </li>
            @endforeach
        @endif
    </ul>
</div>
