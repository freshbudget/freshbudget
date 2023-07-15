@extends('layouts.app')

@section('page::title', $budget->name)
@section('breadcrumbs', Breadcrumbs::render('app.budgets.index'))

@section('content')

    <section class="w-full h-screen overflow-hidden">
        @yield('section')  
    </section>
    
@endsection