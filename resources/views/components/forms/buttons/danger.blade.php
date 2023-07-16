@props([
    'as' => 'button',
    'type' => 'button',
    'confirm' => false,
    'class' => 'px-5 font-semibold inline-block py-2.5 bg-red-50 hover:bg-gradient-to-br hover:from-red-50 hover:to-red-100 border border-red-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-red-400 focus:outline-none focus:shadow text-red-700 shadow-sm hover:shadow hover:text-red-900 select-none'
])

<div x-data="{
    confirm: {{ $confirm ? 'true' : 'false' }},
    clicked: false,
    timer: null,
}" x-init="$watch('clicked', value => {
    if (value) {
        timer = setTimeout(() => {
            clicked = false;
        }, 4000);
    } else {
        clearTimeout(timer);
    }
})">
    
    @if ($confirm)
        <button type="button" class="{{ $class }}" x-show="!clicked" x-on:click="clicked=true">
            {{ $slot }}
        </button>
    @endif

    <{{ $as }} @if($confirm)x-cloak x-show="clicked"@endif @if($as == 'button')type="{{ $type }}"@endif {{ $attributes->twMerge($class) }}>
        @if ($confirm)
            Confirm
        @else
            {{ $slot }}            
        @endif
    </{{ $as }}>

</div>
