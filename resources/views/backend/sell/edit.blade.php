@extends('backend.layouts.app')
@section('title') Edit Sell  @endsection
@section('content')
    <div id="app">
        <edit-sell :sell="{{ $sell }}" :all_categories="{{$categories}}"></edit-sell>
    </div>
@endsection

@section('js')

@endsection

