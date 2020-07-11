@extends('backend.layouts.app')
@section('title') {{__('pages.expense_category')}} @endsection
@section('content')
    <div id="app">
        <expense-category :all_categories="{{$categories}}"></expense-category>
    </div>
@endsection

@section('js')

@endsection

