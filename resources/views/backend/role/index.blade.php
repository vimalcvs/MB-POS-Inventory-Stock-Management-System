@extends('backend.layouts.app')
@section('title') {{__('pages.roles')}}  @endsection
@section('content')
    <div id="app">
        <role :all_roles="{{$roles}}"></role>
    </div>
@endsection

@section('js')

@endsection
