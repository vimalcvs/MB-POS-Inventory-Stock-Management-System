@extends('backend.layouts.app')
@section('title') {{__('pages.employee')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> {{__('pages.employees')}} </h6>
                        <a href="{{route('employee.create')}}" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-plus"></i> {{__('pages.create_employees')}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pages.sl')}}</th>
                                    <th>{{__('pages.name')}}</th>
                                    <th>{{__('pages.designation')}}</th>
                                    <th>{{__('pages.phone_number')}}</th>
                                    <th>{{__('pages.email')}}</th>
                                    @can('access_to_all_branch')
                                        <th>{{__('pages.branch')}}</th>
                                    @endcan
                                    <th>{{__('pages.status')}}</th>
                                    <th width="8%">{{__('pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $key => $employee)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$employee->user->name}}</td>
                                            <td>{{$employee->designation->title}}</td>
                                            <td>{{$employee->phone_number}}</td>
                                            <td>{{$employee->user->email}}</td>
                                            @can('access_to_all_branch')
                                                <td>{{$employee->branch->title}}</td>
                                            @endcan

                                            <td>
                                                @if($employee->user->active_status == 1)
                                                    <a  href="javascript:void(0)" onclick="$(this).confirm('{{url('change-user-status/'.$employee->user->id)}}');" class="badge badge-success p-1">{{__('pages.active')}}</a>
                                                @else
                                                    <a  href="javascript:void(0)" onclick="$(this).confirm('{{url('change-user-status/'.$employee->user->id)}}');" class="badge badge-danger">{{__('pages.not_active')}}</a>
                                                @endif
                                            </td>
                                           <td class="font-14">
                                               <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                   <a href="{{route('employee.edit', [$employee->id])}}" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                   <a href="{{route('employee.show', [$employee->id])}}" class="mr-2"><i class="fa fa-eye text-primary"></i> </a>
                                                   <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                   <form action="{{ route('employee.destroy',$employee->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
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

