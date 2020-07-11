@extends('backend.layouts.app')
@section('title') {{__('pages.sell')}}  @endsection
@section('content')
    <div id="app" class="min-800">
        <new-sell :all_categories="{{$categories}}"></new-sell>
    </div>
@endsection

@section('js')

@endsection

