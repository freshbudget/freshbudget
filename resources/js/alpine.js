import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import '../../vendor/wire-elements/pro/resources/js/spotlight-component.js'
import contextMenu from './components/context-menu'

window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.data('contextMenu', contextMenu)
})

document.addEventListener('livewire:navigated', () => {
    Alpine.data('contextMenu', contextMenu)
})

document.addEventListener('livewire:init', () => {
    Alpine.data('contextMenu', contextMenu)
})

document.addEventListener('DOMContentLoaded', () => {
    Alpine.data('contextMenu', contextMenu)
})

document.addEventListener('keydown', (e) => {
  
    if (!e.target.hasAttribute('wire:navigate') && !e.target.hasAttribute('wire:navigate.hover')) {
        return;
    }
  
    if (e.key.toLowerCase() == 'enter') {
        Alpine.navigate(e.target.href);
    }
  
});

Livewire.start();