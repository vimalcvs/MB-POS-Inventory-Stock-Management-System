@extends('backend.layouts.app')
@section('title') {{__('pages.notice')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.manage')}} {{__('pages.notice')}}</h6>
                        <a href="{{route('notice.create')}}" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-plus"></i> {{__('pages.create')}} {{__('pages.notice')}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="3%">{{__('pages.sl')}}</th>
                                    <th>{{__('pages.title')}}</th>
                                    <th width="15%">{{__('pages.date_time')}}</th>
                                    <th width="10%">{{__('pages.notify_from')}}</th>
                                    <th width="20%">{{__('pages.notify_to')}}</th>
                                    <th width="30%">{{__('pages.description')}}</th>
                                    <th width="8%">{{__('pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notices as $key => $notice)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$notice->title}}</td>
                                        <td>{{$notice->notify_date->format(get_option('app_date_format'))}} <br> {{\Carbon\Carbon::parse($notice->notify_time)->format('h:00 a')}}</td>
                                        <td>{{$notice->createdBy->name}}</td>
                                        <td>
                                            @foreach($notice->notifications as $notification)
                                                <img class="img-profile border w-30p rounded-circle"  title="{{$notification->messageTo->name}}" src="{{asset($notification->messageTo->employee->profile_picture != '' ? $notification->messageTo->employee->profile_picture : 'backend/img/user-placeholder.png')}}">
                                            @endforeach
                                        </td>
                                        <td>{{str_limit($notice->description, 180)}}</td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{route('notice.edit', [$notice->id])}}" class="mr-2"><i class="fa fa-edit"></i> </a>
                                                <a href="{{route('notice.show', [$notice->id])}}" class="mr-2"><i class="fa fa-eye text-primary"></i> </a>
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="{{ route('notice.destroy',$notice->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
