import { Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

Alpine.directive("search", (el, { expression }, { evaluateLater, effect }) => {
    let getSearch = evaluateLater(expression);

    effect(() => {
        getSearch((search) => {
            if (search === "") {
                el.classList.remove("hidden");
            }

            if (el.textContent?.toLowerCase().includes(search.toLowerCase())) {
                el.classList.remove("hidden");
            } else {
                el.classList.add("hidden");
            }
        });
    });
});
