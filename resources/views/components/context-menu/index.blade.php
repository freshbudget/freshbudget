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
            
            {{-- <div tabindex="0" x-on:click="contextMenuOpen=false" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-gray-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                <span>New Folder</span>
                <span class="ml-auto text-xs tracking-widest text-gray-400 group-hover:text-gray-600">⌘N</span>
            </div>
            
            <div class="h-px my-1 -mx-1 bg-gray-200"></div>
            
            <div tabindex="0" x-on:click="contextMenuOpen=false" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-gray-100 outline-none pl-8 data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                <span>Get Info</span>
                <span class="ml-auto text-xs tracking-widest text-gray-400 group-hover:text-gray-600">⌘I</span>
            </div>

            <div tabindex="0" x-on:click="contextMenuOpen=false" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-gray-100 outline-none pl-8 data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                <span>Change Background...</span>
            </div>
            
            <div class="h-px my-1 -mx-1 bg-gray-200"></div>
            
            <div class="relative group">
                
                <div class="flex cursor-default select-none items-center rounded px-2 hover:bg-gray-100 py-1.5 outline-none pl-8">
                    <span>Sort By</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-auto"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>

                <div data-submenu class="absolute top-0 right-0 invisible mr-1 duration-200 ease-out translate-x-full opacity-0 group-hover:mr-0 group-hover:visible group-hover:opacity-100">
                    <div class="z-50 min-w-[8rem] overflow-hidden rounded-md border bg-white p-1 shadow-md animate-in slide-in-from-left-1 w-48">
                        <div x-on:click="contextMenuOpen=false" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-gray-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">Kind</div>
                        <div x-on:click="contextMenuOpen=false" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-gray-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">Date Last Opened</div>
                        <div x-on:click="contextMenuOpen=false" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-gray-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">Date Added</div>
                        <div x-on:click="contextMenuOpen=false" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-gray-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">Date Modified</div>
                        <div x-on:click="contextMenuOpen=false" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-gray-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">Date Created</div>
                        <div x-on:click="contextMenuOpen=false" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-gray-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">Tags</div>
                    </div>
                </div>

            </div> --}}

        </div>
    </template>
</div>