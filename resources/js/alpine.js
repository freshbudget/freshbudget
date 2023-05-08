import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'
import intersect from '@alpinejs/intersect'
import persist from '@alpinejs/persist'
import focus from '@alpinejs/focus'
 
window.Alpine = Alpine

Alpine.plugin(mask)
Alpine.plugin(focus)
Alpine.plugin(persist)
Alpine.plugin(intersect)
Alpine.start();