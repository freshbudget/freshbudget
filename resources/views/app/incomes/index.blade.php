@extends('app.incomes.layout')

@push('body::end')
    <script src="https://code.highcharts.com/highcharts.js"></script>    
@endpush

@section('section')

    <h3 class="p-6 text-3xl font-bold tracking-tight select-none">
        Income Overview
    </h3>

    <div class="p-6 prose prose-green">

        <p>You currently have active {{ $incomes->count() }} {{ str('income')->plural($incomes->count()) }}, bringing in a estimated monthly amount of $3,120.27.</p>

        <blockquote>
            Show a bar chart of how each income contributes to the total monthly income.
        </blockquote>

        <p>
            Last month, you estimated you would earn $3,120.27, but you actually earned $3,120.27. This is a difference of $0.00, or 0.00%.
        </p>

        <blockquote>
            Show a bar chart of the estimated vs actual income for the last month.
        </blockquote>

        <p>
            This month, you have estimated you will earn $3,120.27. You have earned $0.00 so far. This is a difference of $3,120.27, or 100%.
        </p>

        <p>
            Your next expected income is your <strong>Salary</strong>, which is due on the 15th of this month and is estimated to be $3,120.27.
        </p>

        <blockquote>
            Show a bar chart of the estimated vs actual income for the current month.
        </blockquote>

        <p>
            Year to date, you have earned $3,120.27, which is 16% of what you estimate you will earn this year.
        </p>

    </div>

@endsection