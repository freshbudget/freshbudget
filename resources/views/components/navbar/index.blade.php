@props([
    'links' => []
])

<nav class="flex w-full px-4 -mb-px space-x-3 bg-white border-b border-gray-300 select-none">

    @foreach ($links as $link)
        <a href="{!! $link['route'] ?? '#' !!}" class="block px-1 text-sm py-3 border-b-2 {{ active($link['active'] ?? '#', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
            {!! $link['label'] ?? 'Label' !!}
        </a>                
    @endforeach

</nav>