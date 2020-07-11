@extends('backend.layouts.app')
@section('title') Purchase  @endsection

@section('css')

@endsection

@section('content')
    <div id="app">
        <edit-purchase :purchase="{{$purchase}}"></edit-purchase>
    </div>
@endsection

@section('js')

@endsection
