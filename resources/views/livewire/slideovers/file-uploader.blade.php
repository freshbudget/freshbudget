@persist('file-uploader')
    <section 
        x-data="{
            open: true,
            close() {
                this.open = false;
            },
            count: 0,
            init() {
                setInterval(() => {
                    this.count++;
                }, 1000);
            }
        }" 
        x-cloak
        x-show="open" 
        class="w-96 bg-white border-l border-gray-300 h-screen shadow-sm absolute top-0 right-0">
        
        <header class="sm:p-4 p-2.5 bg-white border-b border-gray-300 select-none flex items-center justify-between">
            <h2 class="font-bold text-xl leading-none sm:text-2xl">Upload Files</h2>
            <div>
                <button x-on:click="open = false">
                    @svg('x', 'h-6 w-6 text-gray-500 hover:text-gray-700')
                </button>
            </div>
        </header>

        <main class="sm:p-4 p-2.5">
            <p>Count <span x-html="count"></span></p>
        </main>

    </section>
@endpersist