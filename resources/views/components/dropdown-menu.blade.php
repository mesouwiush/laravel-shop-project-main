{{-- Functionality and presentation of Component --}}

<div class="relative inline-block my-auto ">

    {{-- Toggle Button For Mobile Functionality --}}

    <button class="" onclick="toggleMenu(event)">{{ $buttonText ?? 'Toggle Menu' }}</button>

    {{-- Mobile DROPDOWN --}}

    <ul id="dropdown" class="accordion-menu absolute left-1/2 transform -translate-x-1/2 w-fit mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        @if(isset($items))
            @foreach ($items as $item)
                <li class=" ">
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
