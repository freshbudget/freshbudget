@extends('app.incomes.show.layout')

@section('tab')

<div class="prose prose-green">

    <ul>
        <li><a href="{{ route('app.incomes.entries.create', $income) }}">Log income entry</a></li>
        <li>Est deductions per period: {{ $income->presenter()->estimatedDeductionsPerPeriod() }}</li>
        <li>Est entitlements per period: {{ $income->presenter()->estimatedEntitlementsPerPeriod() }}</li>
        <li>Est taxes per period: {{ $income->presenter()->estimatedTaxesPerPeriod() }}</li>
        <li>Est net per period: {{ $income->presenter()->estimatedNetPerPeriod() }}</li>
    </ul>
    
</div>

@endsection