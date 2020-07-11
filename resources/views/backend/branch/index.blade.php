@extends('backend.layouts.app')
@section('title') {{__('pages.branch')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.all_branch')}}</h6>
                        <a href="{{route('branch.create')}}" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-plus"></i> {{__('pages.create_branch')}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pages.sl')}}</th>
                                    <th>{{__('pages.branch_name')}}</th>
                                    <th>{{__('pages.contact_person')}}</th>
                                    <th>{{__('pages.phone_number')}}</th>
                                    <th>{{__('pages.note')}}</th>
                                    <th>{{__('pages.address')}}</th>
                                    <th width="8%">{{__('pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($branches as $key => $branch)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$branch->title}}</td>
                                        <td>{{$branch->contact_person}}</td>
                                        <td>{{$branch->phone}}</td>
                                        <td>{{$branch->short_description}}</td>
                                        <td>{{$branch->address}}</td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{route('branch.edit', [$branch->id])}}" class="mr-2"><i class="fa fa-edit"></i> </a>
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="{{ route('branch.destroy',$branch->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
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

