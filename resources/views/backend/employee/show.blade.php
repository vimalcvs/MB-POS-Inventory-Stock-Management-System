@extends('backend.layouts.app')
@section('title')
    {{__('pages.employee')}}
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary ml-1"> {{__('pages.employee')}}</h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                       <div class="row">
                           <div class="col-md-3">
                               <img src="{{asset($employee->profile_picture ? $employee->profile_picture : 'backend/img/user-placeholder.png')}}" class="img-fluid thumbnail" width="100%">

                               @if($employee->user->active_status == 1)
                                   <a  href="javascript:void(0)" onclick="$(this).confirm('{{url('change-user-status/'.$employee->user->id)}}');" class="btn btn-primary btn-block mt-1">{{__('pages.active')}}</a>
                               @else
                                   <a  href="javascript:void(0)" onclick="$(this).confirm('{{url('change-user-status/'.$employee->user->id)}}');" class="btn btn-danger btn-block mt-1">{{__('pages.not_active')}}</a>
                               @endif
                           </div>
                           <div class="col-md-7">
                               <div class="bg-secondary text-white pl-2 pt-1 pb-1 mb-2 text-center">{{__('pages.personal_information')}}</div>
                               <table class="table table-bordered">
                                   <tbody>
                                       <tr>
                                           <th width="30%">{{__('pages.name')}}</th>
                                           <td>{{$employee->user->name}}</td>
                                       </tr>
                                       <tr>
                                           <th>{{__('pages.email')}}</th>
                                           <td>{{$employee->user->email}}</td>
                                       </tr>

                                       <tr>
                                           <th>{{__('pages.gender')}}</th>
                                           <td>{{$employee->gender == 1 ? 'Male' : 'Female'}}</td>
                                       </tr>

                                       <tr>
                                           <th>{{__('pages.date_of_birth')}}</th>
                                           <td>{{$employee->date_of_birth ? $employee->date_of_birth->format(get_option('app_date_format')) : '--'}}</td>
                                       </tr>

                                       <tr>
                                           <th>{{__('pages.blood_group')}}</th>
                                           <td>{{$employee->blood_group}}</td>
                                       </tr>

                                       <tr>
                                           <th>{{__('pages.phone_number')}}</th>
                                           <td>{{$employee->phone_number}}</td>
                                       </tr>

                                       <tr>
                                           <th>{{__('pages.address')}}</th>
                                           <td>{{$employee->address}}</td>
                                       </tr>

                                       <tr>
                                           <th>{{__('pages.educational_background')}}</th>
                                           <td>{{$employee->educational_background}}</td>
                                       </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>

                        <div class="row mt-5">
                            <div class="col-md-3"></div>
                            <div class="col-md-7">
                                <div class="bg-primary text-white pl-2 pt-1 pb-1 mb-2 text-center">{{__('pages.employment_info')}}</div>

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="30%">{{__('pages.branch')}}</th>
                                            <td>{{$employee->branch ? $employee->branch->title : '--'}}</td>
                                        </tr>

                                        <tr>
                                            <th width="30%">{{__('pages.role')}}</th>
                                            <td>{!! ucwords(str_replace("_", " ", $role)) !!}</td>
                                        </tr>

                                        <tr>
                                            <th width="30%">{{__('pages.department')}}</th>
                                            <td>{{$employee->department ? $employee->department->title : '--'}}</td>
                                        </tr>
                                        <tr>
                                            <th>{{__('pages.designation')}}</th>
                                            <td>{{$employee->designation ? $employee->designation->title : '--'}}</td>
                                        </tr>

                                        <tr>
                                            <th>{{__('pages.employee_id')}}</th>
                                            <td>{{$employee->id_number}}</td>
                                        </tr>

                                        <tr>
                                            <th>{{__('pages.joining_date')}}</th>
                                            <td>{{$employee->joining_date ? $employee->joining_date->format(get_option('app_date_format')) : '--'}}</td>
                                        </tr>
                                    </tbody>
                                </table>
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

