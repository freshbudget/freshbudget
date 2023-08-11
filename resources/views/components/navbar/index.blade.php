@props([
    'links' => []
])

<nav class="flex w-full px-4 -mb-px space-x-3 bg-white border-b border-gray-300 select-none">

    @foreach ($links as $link)
        <a wire:navigate href="{!! $link['route'] ?? '#' !!}" class="flex items-center px-1 text-sm py-3 border-b-2 {{ active($link['active'] ?? '#', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
            @if (isset($link['icon']))
                @svg($link['icon'], 'w-4 h-4 mx-1 inline-block')                
            @endif
            {!! $link['label'] ?? 'Label' !!}

        </a>                
    @endforeach

</nav>