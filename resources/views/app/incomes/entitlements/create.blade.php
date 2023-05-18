@extends('app.incomes.layout')

@section('section')

    <h3 class="px-6 pt-6 text-3xl font-bold tracking-tight select-none">
        Add Entitlements
    </h3>

    <div class="max-w-xl p-6 mb-8">

        <div class="prose prose-green">
            <p>
                Entitlements are basic groups of income that you expect to earn during a pay period. For example, you may have a base pay, this is one entitlement. On the same pay stub you may have overtime pay, this is another entitlement. You can add as many entitlements as you need to represent your expected income per pay period.
            </p>
        </div>

        <div class="my-8">

            <form action="" method="post" x-data="{
                entitlements: [],
                addEntitlement() {
                    this.entitlements.push({ name: '', amount: '' });
                },
                removeEntitlement(index) {
                    this.entitlements.splice(index, 1);
                },
                totalAmount() {
                    // check if entitlements is empty
                    if (this.entitlements.length === 0) {
                        return 0;
                    }

                    return this.entitlements.reduce((total, entitlement) => {
                        return total + (parseFloat(entitlement.amount) || 0);
                    }, 0);
                }
            }">

                @csrf

                <div class="pb-6 space-y-2 border-b border-gray-300">

                    <div class="flex items-center flex-1 space-x-2">

                        <div class="space-y-1.5 flex-1" x-id="['name']">
                            <x-forms.label x-bind:for="$id('name')">
                                Name
                            </x-forms.label>

                            <x-forms.input type="text" name="name" x-bind:id="$id('name')" />
                        </div>

                        <div class="space-y-1.5 flex-1" x-id="['amount']">
                            <x-forms.label x-bind:for="$id('amount')">
                                Amount
                            </x-forms.label>

                            <div class="flex items-center flex-1 space-x-2">

                                <x-forms.input type="text" name="amount" class="flex-1" x-bind:id="$id('amount')" x-mask:dynamic="$money($input)" />

                                <button 
                                    type="button"
                                    x-on:click="addEntitlement"
                                    class="flex items-center justify-center text-gray-500" 
                                    title="Add another entitlement">
                                    @svg('pluscircle', 'w-6 h-6') <span class="sr-only">Add entitlement</span>
                                </button>

                            </div>
                            
                        </div>

                    </div>

                    <template x-for="(entitlement, index) in entitlements" :key="index">

                        <div class="flex items-center space-x-2">
                            
                            <x-forms.input 
                                type="text" 
                                class="flex-1" 
                                x-bind:name="'entitlements[' + index + '][name]'" 
                                x-bind:id="'name-' + index" 
                                x-model="entitlements[index].name" />

                            <x-forms.input 
                                type="text" 
                                class="flex-1" 
                                x-bind:name="'entitlements[' + index + '][amount]'" 
                                x-bind:id="'amount-' + index" 
                                x-model="entitlements[index].amount"
                                x-mask:dynamic="$money($input)" />

                            <button 
                                type="button" 
                                x-on:click="removeEntitlement(index)" 
                                class="flex items-center justify-center text-gray-500" 
                                title="Remove entitlement">
                                @svg('x-circle', 'w-6 h-6') <span class="sr-only">Remove entitlement</span>
                            </button>

                        </div>
                
                    </template>

                </div>

                <div class="flex items-center justify-between py-3 text-lg text-gray-500 border-b border-gray-300 select-none">

                    <p>Estimated entitlements per income period</p>

                    <p>
                        $<span x-text="Number(totalAmount()).toFixed(2)">0.00</span>
                    </p>

                </div>

            </form>

        </div>

    </div>

@endsection