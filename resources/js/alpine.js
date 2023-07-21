import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import contextMenu from './components/context-menu'
import './directives/search.js'

window.Alpine = Alpine

Alpine.data('contextMenu', contextMenu)

Livewire.start();