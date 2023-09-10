@section('page::title', 'Files')

<div>

    <button class="p-5 bg-green-300 rounded" draggable="true"> this is test</button>

    <div
        x-data="{
            dragging: false,
            handleDrop(event) {
                @this.uploadMultiple('files', 
                    Array.from(event.target.files)
                )
            }
        }"
        x-on:dragstart.self="dragging = true"
        x-on:dragover.prevent="dragging = true"
        x-on:dragleave.prevent="dragging = false"
        x-on:drop="dragging = false"
        x-on:drop.prevent="handleDrop($event)"
        x-bind:class="{ 'border-gray-500 border-dashed border-2': dragging }"
        class="max-w-5xl mx-auto px-4 my-10 bg-gray-300 rounded-lg py-10 border border-transparent transition-all duration-100">    
        <p class="text-center text-gray-500" x-on:click="$refs.input.click()">Drop files here to upload</p>

        <input type="file" class="hidden" multiple x-ref="input" x-on:change="handleDrop($event)">
        
    </div>
</div>