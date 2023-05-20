@extends('app.incomes.show.layout')

@section('tab')

    <div class="max-w-xl mb-8">

        <div class="prose select-none prose-green">

            <h2>Create deductions</h2>

            <p>
                Deductions are any sort of deductions that are taken from your income. For example, you may have a 401k deduction, this is one deduction. On the same pay stub you may have a health insurance deduction, this is another deduction. You can add as many deductions as you need to represent your expected deductions per pay period. Remember, this is just an estimate, when you log your income you will be able to input how much you actually paid for each item.
            </p>

        </div>

        <div class="flex-1 my-6">

            <form action="{{ route('app.incomes.deductions.store', $income) }}" method="post" x-cloak x-data="form">

                @csrf

                <div>

                    <div class="space-y-2">
    
                        <!-- labels -->
                        <div class="flex items-center flex-1">
    
                            <x-forms.label class="w-1/2" for="name-0" required>
                                Name
                            </x-forms.label>
    
                            <x-forms.label class="w-1/2" for="amount-0" required>
                                Amount
                            </x-forms.label>
    
                            <div class="w-6 h-6">
                                
                            </div>
    
                        </div>
    
                        <!-- inputs -->
                        <template x-for="(deduction, index) in deductions" :key="index">
    
                            <div class="flex items-center space-x-2">
                                
                                <x-forms.input 
                                    required
                                    type="text" 
                                    class="flex-1" 
                                    x-bind:name="'deductions[' + index + '][name]'" 
                                    x-bind:id="'name-' + index" />
    
                                <x-forms.input 
                                    required
                                    type="text" 
                                    class="flex-1" 
                                    x-bind:name="'deductions[' + index + '][amount]'" 
                                    x-bind:id="'amount-' + index" 
                                    x-model="deductions[index].amount"
                                    x-mask:dynamic="$money($input)" />
    
                                <div class="w-6 h-6">
                                    <button 
                                        type="button" 
                                        x-show="deductions.length > 1"
                                        x-on:click="removeDeduction(index)" 
                                        class="flex items-center justify-center text-gray-500 rounded-full focus:text-green-500 focus:outline-none hover:text-green-500 hover:ring-green-500" 
                                        title="Remove deduction">
                                        @svg('x-circle', 'w-6 h-6') <span class="sr-only">Remove deduction</span>
                                    </button>
                                </div>
    
                            </div>
                    
                        </template>
                        
                    </div>
                    
                    <div class="flex items-center my-3 mr-6">
    
                        <button 
                            type="button" 
                            x-on:click.thottle="addDeduction" 
                            class="inline-block px-3 py-1 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg shadow-sm bg-gray-50 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow hover:shadow hover:text-gray-900">
                            Add another deduction
                        </button>
    
                    </div>
                    
                </div>

                <div class="flex items-center justify-between py-3 mr-6 text-lg text-gray-500 border-gray-300 select-none border-y">

                    <p>Estimated deductions per income period</p>

                    <p>
                        $<span x-text="totalAmount">0.00</span>
                    </p>

                </div>

                <div class="flex items-center justify-end py-3 mr-6">
                    <x-forms.buttons.primary type="submit">
                        Save deductions
                    </x-forms.buttons.primary>
                </div>

            </form>

        </div>

    </div>

@endsection

@push('body::end')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('form', () => ({
            /**
             * The deductions.
             * 
             * @var {Array}
             */
            deductions: [{
                name: '', amount: ''
            }],

            /**
             * Add an entitlement.
             * 
             * @return {void}
             */
            addDeduction() {
                this.deductions.push({ name: '', amount: '' });

                // now we need to focus the new input
                let index = this.deductions.length - 1;

                setTimeout(() => {
                    document.getElementById('name-' + index).focus();
                }, 100);
            },

            /**
             * Remove an entitlement.
             * 
             * @param {Number} index 
             * @return {void}
             */
            removeDeduction(index) {
                if (this.deductions.length === 1) {
                    return;
                }

                // remove the x-model bindings from the inputs
                this.deductions[index].name = '';
                this.deductions[index].amount = '';

                this.deductions.splice(index, 1);
            },

            /**
             * Calculate the total amount of all deductions.
             * 
             * @return {Number}
             */
            totalAmount() {
                if (this.deductions.length === 0) {
                    return 0;
                }

                let total = this.deductions.reduce((total, deduction) => {
                    // we need to strip any non-numeric characters from the amount before we add it to the total
                    let amount = deduction.amount.replace(/[^0-9.]/g, '');
                    
                    // if the amount is empty, return the total
                    if (amount === '') {
                        return total;
                    }

                    // round the amount to 2 decimal places
                    amount = Number(amount).toFixed(2);

                    // add the amount to the total
                    return total + Number(amount);
                }, 0);

                // format the total to 2 decimal places and to have a , for the thousands separator
                return total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            }
        }))
    })
</script>
@endpush