@extends('layouts.app')

{{-- @section('page::title', 'Configure Income') --}}
@section('breadcrumbs', Breadcrumbs::render('app.incomes.show', $income))
@section('content')

<div class="max-w-3xl mx-auto px-4">

    <header class="space-y-2 mt-8 mb-6 select-none">
        <h2 class="font-bold text-xl text-gray-800">Income Configuration Wizard</h2>
        <p class="text-sm text-gray-700">
            This wizard will walk you through the steps to get your income configured.
        </p>
    </header>

    <!-- Edit form -->
    <section class="border border-gray-300 bg-white rounded my-8">
        
        <div x-data="{ active: 1 }" class="divide-y divide-gray-300">

            <!-- step 1 -->
            <div x-data="{
                id: 1,
                get expanded() {
                    return this.active === this.id
                },
                set expanded(value) {
                    this.active = value ? this.id : null
                },
            }" role="region">
                <h2>
                    <button
                        x-on:click="expanded = !expanded"
                        :aria-expanded="expanded"
                        class="flex w-full items-center justify-between px-6 py-4 text-xl font-bold"
                    >
                        <span>Manage Entitlements</span>
                        <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                        <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                    </button>
                </h2>

                <div x-show="expanded" x-collapse>
                    <div class="px-6 pb-4">
                        <p>
                            Manage entitlements for this income.
                        </p>
                    </div>
                </div>
            </div>

            <!-- step 2 -->
            <div x-data="{
                id: 2,
                get expanded() {
                    return this.active === this.id
                },
                set expanded(value) {
                    this.active = value ? this.id : null
                },
            }" role="region">
                <h2>
                    <button
                        x-on:click="expanded = !expanded"
                        :aria-expanded="expanded"
                        class="flex w-full items-center justify-between px-6 py-4 text-xl font-bold"
                    >
                        <span>Manage Taxes</span>
                        <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                        <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                    </button>
                </h2>

                <div x-show="expanded" x-collapse>
                    <div class="px-6 pb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. In magnam quod natus deleniti architecto eaque consequuntur ex, illo neque iste repellendus modi, quasi ipsa commodi saepe? Provident ipsa nulla earum.</div>
                </div>
            </div>

        </div>
        
        {{-- <livewire:wizards.incomes.configure-income-wizard /> --}}
    
    </section>

</div>

@endsection