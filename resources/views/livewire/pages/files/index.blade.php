@section('page::title', 'Files')

<div class="px-4 py-6">

    {{-- <div
        x-data="{
            dragging: false,
            progress: 0,
            handleDrop(event) {
                @this.uploadMultiple('files', 
                    Array.from(event.dataTransfer?.files || event.target.files), 
                    (fileName) => {
                        // starts
                    }, 
                    (err) => {
                        // error
                        this.progress = 0
                    }, 
                    (ev) => {
                        // progress
                        this.progress = ev.detail.progress
                    }
                )
            }
        }"
        x-on:dragover.prevent="dragging = true"
        x-on:dragleave.prevent="dragging = false"
        x-on:drop="dragging = false"
        x-on:drop.prevent="handleDrop($event)"
        x-bind:class="{ 'bg-gray-200': dragging }"
        class="max-w-5xl mx-auto px-4 my-10 bg-gray-300 rounded-lg py-10 transition-all duration-100">    
        <p class="text-center text-gray-500" x-on:click="$refs.input.click()">Drop files here to upload</p>

        <input type="file" class="hidden" multiple x-ref="input" wire:model.live="files" x-on:change="handleDrop($event)">

        @error('files.*') <span class="error">{{ $message }}</span> @enderror

        <!-- progress bar -->
        <div x-show="progress" x-cloak class="rounded-full w-full bg-gray-200 border h-2 flex items-center px-0 my-4">
            <div class="rounded-full bg-green-400 w-[50%] h-2 border" x-bind:style="`width: $(progress)%`"></div>
        </div>

    </div> --}}

    <div
        x-data="{ dragging: false, uploading: false, progress: 0 }"
        
        {{-- x-on:dragleave.prevent="dragging = false"
        x-on:dragover.prevent="dragging = true"
        x-on:drop="dragging = false" --}}
        {{-- x-on:drop.prevent="$refs.files.files = $event.dataTransfer.files" --}}
        x-on:livewire-upload-start="uploading = true"
        x-on:livewire-upload-finish="uploading = false"
        x-on:livewire-upload-error="uploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
        class="w-full bg-gray-200 rounded-lg py-10 transition-all duration-100 flex justify-center items-center"
    >
        <!-- File Input -->
        <input type="file" wire:model="files" multiple x-ref="files">
    
        <!-- Progress Bar -->
        <div x-show="uploading" x-cloak>
            <progress max="100" x-bind:value="progress"></progress>
        </div>
    </div>
</div>