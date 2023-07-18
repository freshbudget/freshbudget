<div x-data="contextMenu()" x-on:contextmenu="contextMenuToggle(event)" {{ $attributes }}>

    {{ $slot }}

    <template x-teleport="body">
        <div 
            x-cloak
            x-ref="contextmenu" 
            x-show="contextMenuOpen" 
            x-on:click.away="contextMenuOpen=false" 
            x-trap.inert="contextMenuOpen"
            x-on:keydown.escape.window="contextMenuOpen=false"
            class="z-50 min-w-[8rem] text-gray-800 rounded-md border border-gray-300/70 bg-white text-sm fixed p-1 shadow-md w-64">

            {{ $options }}

        </div>
    </template>
</div>