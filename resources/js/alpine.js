import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'
import focus from '@alpinejs/focus'
import persist from '@alpinejs/persist'
import collapse from '@alpinejs/collapse'
import contextMenu from './components/context-menu'
import './directives/search.js'


window.Alpine = Alpine

Alpine.plugin(mask)
Alpine.plugin(focus)
Alpine.plugin(persist)
Alpine.plugin(collapse)
Alpine.data('contextMenu', contextMenu)

Alpine.start();