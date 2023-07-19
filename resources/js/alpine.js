import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'
import focus from '@alpinejs/focus'
import persist from '@alpinejs/persist'
import collapse from '@alpinejs/collapse'
import intersect from '@alpinejs/intersect'
import contextMenu from './components/context-menu'

Alpine.directive('search', (el, { expression }, { evaluateLater, effect }) => {
    
    let getSearch = evaluateLater(expression)

    effect(() => {
        getSearch(search => {
            if(search === '') {
                el.classList.remove('hidden')
            } 

            if(el.textContent?.toLowerCase().includes(search.toLowerCase())) {
                el.classList.remove('hidden')
            } else {
                el.classList.add('hidden')
            }
        })
    })
});

window.Alpine = Alpine

Alpine.plugin(mask)
Alpine.plugin(focus)
Alpine.plugin(persist)
Alpine.plugin(collapse)
// Alpine.plugin(intersect)

Alpine.data('contextMenu', contextMenu)

Alpine.start();