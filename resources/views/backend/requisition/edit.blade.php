@extends('backend.layouts.app')
@section('title') Edit Requisition  @endsection
@section('content')
    <div id="app">
        <edit-requisition :requisition="{{ $requisition }}"></edit-requisition>
    </div>
@endsection

@section('js')

@endsection
