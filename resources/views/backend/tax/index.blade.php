@extends('backend.layouts.app')
@section('title') {{__('pages.tax')}} @endsection
@section('content')
    <div id="app">
        <tax :all_taxes="{{$taxes}}"></tax>
    </div>
@endsection

@section('js')

@endsection

