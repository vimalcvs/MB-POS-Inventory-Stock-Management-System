@extends('backend.layouts.app')
@section('title') {{__('pages.category')}}  @endsection
@section('content')
    <div id="app">
        <category :all_categories="{{$categories}}"></category>
    </div>
@endsection

@section('js')

@endsection
