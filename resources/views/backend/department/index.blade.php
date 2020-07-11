@extends('backend.layouts.app')
@section('title') Department @endsection
@section('content')
    <div id="app">
        <department :all_departments="{{$departments}}"></department>
    </div>

@endsection

@section('js')

@endsection

