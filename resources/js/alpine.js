import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import contextMenu from './components/context-menu'

window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.data('contextMenu', contextMenu)
})

Livewire.start();