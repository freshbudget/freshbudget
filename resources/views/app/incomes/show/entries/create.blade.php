@extends('app.incomes.show.layout')

@section('tab')

<div class="max-w-2xl prose">

    <table>
        <thead>
            <tr>
                <th>
                    Entitlement
                </th>
                <th>
                    Est Amount
                </th>
                <th>
                    Actual Amount
                </th>
                <th>
                    Percent Difference
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($income->entitlements as $entitlement)
                <tr>
                    <td>
                        {{ $entitlement->name }}
                    </td>
                    <td>
                        {{ $entitlement->amount }}
                    </td>
                    <td>
                        <input type="number" name="actual_amount" id="actual_amount" value="{{ $entitlement->amount }}">
                    </td>
                    <td>
                        0%
                    </td>
                </tr>                
            @endforeach
        </tbody>
        
        <thead>
            <tr>
                <th>
                    Tax
                </th>
                <th>
                    Est Amount
                </th>
                <th>
                    Actual Amount
                </th>
                <th>
                    Percent Difference
                </th>   
            </tr>
        </thead>

        <tbody>

            @foreach ($income->taxes as $tax)
                
                <tr>

                    <td>
                        {{ $tax->name }}
                    </td>
                    <td>
                        {{ $tax->presenter()->amount() }}
                    </td>
                    <td>
                        <input type="number" name="actual_amount" id="actual_amount" value="{{ $tax->amount }}">
                    </td>
                    <td>
                        0%
                    </td>
                    
                </tr>

            @endforeach

        </tbody>

        <thead>
            <tr>
                <th>
                    Deduction
                </th>
                <th>
                    Est Amount
                </th>
                <th>
                    Actual Amount
                </th>
                <th>
                    Percent Difference
                </th>   
            </tr>
        </thead>

        <tbody>

            @foreach ($income->deductions as $deduction)
                
                <tr>

                    <td>
                        {{ $deduction->name }}
                    </td>
                    <td>
                        {{ $deduction->amount }}
                    </td>
                    <td>
                        <input type="number" name="actual_amount" id="actual_amount" value="{{ $deduction->amount }}">
                    </td>
                    <td>
                        0%
                    </td>
                    
                </tr>

            @endforeach

        </tbody>

    </table>
    
</div>

@endsection