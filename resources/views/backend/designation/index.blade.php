@extends('backend.layouts.app')
@section('title') Designation @endsection
@section('content')
    <div id="app">
        <designation :all_designations="{{$designations}}"></designation>
    </div>
@endsection

@section('js')

@endsection

