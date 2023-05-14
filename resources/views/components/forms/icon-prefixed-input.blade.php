@props(['icon'])

<div class="flex items-center w-full transition duration-75 border-gray-300 rounded-lg focus:outline-none ring-green-500 focus:border-gray-300 focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-green-400 focus:bg-gray-50">
    
    <div class="flex items-center bg-white rounded-l-lg h-[42px] w-[42px] border border-gray-300 border-r-0 justify-center">
        @svg($icon, 'text-gray-400 w-4 h-4')
    </div>

    <x-forms.input {{ $attributes->merge(['class' => '!rounded-l-none !border-l-none']) }} />

</div>