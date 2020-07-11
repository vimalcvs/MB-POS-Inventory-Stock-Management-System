@extends('backend.layouts.app')
@section('title')
   {{__('pages.update_employees')}}
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center">
                         <h6 class="m-0 font-weight-bold text-primary ml-1">{{__('pages.update_employees')}}</h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{route('employee.update', [$employee->id])}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('patch')

                            <div class="bg-secondary text-white pl-2 pt-1 pb-1 mb-2">{{__('pages.personal_information')}}</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{__('pages.name')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" value="{{$employee->user->name}}" placeholder="{{__('pages.name')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">{{__('pages.gender')}} <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="form-control select2">
                                            <option value="">{{__('pages.select_gender')}}</option>
                                            <option value="Male" {{$employee->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                            <option value="Female" {{$employee->gender == 'Male' ? 'Female' : ''}}>Female</option>
                                        </select>

                                        @if ($errors->has('gender'))
                                            <div class="error">{{ $errors->first('gender') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth">{{__('pages.date_of_birth')}} <span class="text-danger">*</span></label>
                                        <input name="date_of_birth" value="{{$employee->date_of_birth}}" id="date_of_birth" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.date_of_birth')}}" autocomplete="off">
                                        @if ($errors->has('date_of_birth'))
                                            <div class="error">{{ $errors->first('date_of_birth') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group">{{__('pages.blood_group')}} <span class="text-danger">*</span></label>
                                        <select name="blood_group" id="blood_group" class="form-control select2">
                                            <option value="">{{__('pages.select_blood_group')}}</option>
                                            <option value="A+" {{$employee->blood_group == 'A+' ? 'selected' : ''}}>A+</option>
                                            <option value="A-" {{$employee->blood_group == 'A-' ? 'selected' : ''}}>A-</option>
                                            <option value="B+" {{$employee->blood_group == 'B+' ? 'selected' : ''}}>B+</option>
                                            <option value="B-" {{$employee->blood_group == 'B-' ? 'selected' : ''}}>B-</option>
                                            <option value="AB+" {{$employee->blood_group == 'AB+' ? 'selected' : ''}}>AB+</option>
                                            <option value="AB-" {{$employee->blood_group == 'AB-' ? 'selected' : ''}}>AB-</option>
                                            <option value="O+" {{$employee->blood_group == 'O+' ? 'selected' : ''}}>O+</option>
                                            <option value="O-" {{$employee->blood_group == 'O+' ? 'selected' : ''}}>O-</option>
                                        </select>
                                        @if ($errors->has('blood_group'))
                                            <div class="error">{{ $errors->first('blood_group') }}</div>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">{{__('pages.phone_number')}}</label>
                                        <input type="text" name="phone_number" id="phone_number"value="{{$employee->phone_number}}" placeholder="{{__('pages.phone_number')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('phone_number'))
                                            <div class="error">{{ $errors->first('phone_number') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{__('pages.address')}} <span class="text-danger">*</span> </label>
                                        <input type="text" name="address" id="address" value="{{$employee->address}}" placeholder="{{__('pages.address')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="educational_background"> {{__('pages.educational_background')}}</label>
                                        <input type="text" value="{{$employee->educational_background}}" name="educational_background" class="form-control" placeholder="{{__('pages.educational_background')}}">
                                        @if ($errors->has('educational_background'))
                                            <div class="error">{{ $errors->first('educational_background') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-3 mt-3">
                                    <div class="form-group">

                                        <div class="upload-img-box">

                                            @if($employee->profile_picture)
                                                <img src="{{asset($employee->profile_picture)}}">
                                            @else
                                                <img src="">
                                            @endif
                                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewFile(this)">
                                            <div class="upload-img-box-icon">
                                                <i class="fa fa-camera"></i>
                                                <p class="m-0">{{__('pages.profile_picture')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-secondary text-white pl-2 pt-1 pb-1 mb-2">{{__('pages.employment_info')}}</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department_id">{{__('pages.department')}} <span class="text-danger">*</span></label>
                                        <select name="department_id" id="department_id" class="form-control select2">
                                            <option value="">{{__('pages.select_department')}}</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}" {{$employee->department_id == $department->id ? 'selected' : ''}}>{{$department->title}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('department_id'))
                                            <div class="error">{{ $errors->first('department_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation_id">{{__('pages.designation')}} <span class="text-danger">*</span></label>
                                        <select name="designation_id" id="designation_id" class="form-control select2" >
                                            <option value="">{{__('pages.select_designation')}} </option>
                                            @foreach($designations as $designation)
                                                <option value="{{$designation->id}}" {{$employee->designation_id == $designation->id ? 'selected' : ''}}>{{$designation->title}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('designation_id'))
                                            <div class="error">{{ $errors->first('designation_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_id">{{__('pages.branch')}} <span class="text-danger">*</span></label>
                                        <select name="branch_id" id="branch_id" class="form-control select2">
                                            <option value="">{{__('pages.select_branch')}}</option>
                                            @foreach($branches as $branch)
                                                <option value="{{$branch->id}}" {{$employee->branch_id == $branch->id ? 'selected' : ''}}>{{$branch->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">{{__('pages.role')}} <span class="text-danger">*</span></label>
                                        <select name="role" id="role" class="form-control select2">
                                            <option value="">{{__('pages.select_role')}}</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->name}}" @if($role->id == $selected_role_id) selected @endif >{!! $role->name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_number"> {{__('pages.employee_id')}} </label>
                                        <input type="text" name="id_number" value="{{$employee->id_number}}" class="form-control" placeholder="{{__('pages.employee_id')}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="joining_date"> {{__('pages.joining_date')}} <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{$employee->joining_date}}" name="joining_date"  data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.joining_date')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-secondary text-white pl-2 pt-1 pb-1 mb-2">{{__('pages.login_info')}}</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{__('pages.email')}} <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" value="{{$employee->user->email}}" class="form-control" placeholder="{{__('pages.email')}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">{{__('pages.password')}} <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="{{__('pages.password')}}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="c_password">{{__('pages.re_type_password')}} <span class="text-danger">*</span></label>
                                        <input type="password" name="c_password" data-parsley-equalto="#password"  class="form-control" placeholder="{{__('pages.re_type_password')}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary btn-block">{{__('pages.save')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection


@section('js')
    <script src="{{asset('/backend/js/custom.js')}}"></script>
@endsection

