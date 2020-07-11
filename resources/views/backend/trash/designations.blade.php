@extends('backend.layouts.app')
@section('title') {{__('pages.designation')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.designation')}}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="3%">{{__('pages.sl')}}</th>
                                    <th>{{__('pages.designation_name')}}</th>
                                    <th width="8%">{{__('pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($designations as $key => $designation)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$designation->title}}</td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0);" class="btn btn-success" onclick="$(this).confirmRestore($('#delete-{{$key}}')) " class=""><i class="fas fa-trash-restore-alt mr-2"></i> Restore</a>
                                                <form action="{{ route('designation-restore-ok',['id' => $designation->id]) }}" method="post" id="delete-{{$key}}"> @csrf </form>
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

