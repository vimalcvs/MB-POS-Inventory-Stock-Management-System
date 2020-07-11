@extends('backend.layouts.app')
@section('title') {{__('pages.notice')}}  @endsection

@section('css')

@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.notice')}}</h6>
                        <a href="{{route('notice.index')}}" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-2"></i> {{__('pages.all')}} {{__('pages.notice')}}</a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body pb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <b>Title:</b> {{$notice->title}}
                            </div>

                            <div class="col-md-12">
                                <b>From:</b> {{$notice->createdBy->name}}
                            </div>

                            <div class="col-md-12 mt-1">
                                <b>Date:</b> {{$notice->notify_date->format(get_option('app_date_format'))}} , {{\Carbon\Carbon::parse($notice->notify_time)->format('h:m a')}}
                            </div>

                            <div class="col-md-12 mt-1">
                                <b>Description:</b> {{$notice->description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

