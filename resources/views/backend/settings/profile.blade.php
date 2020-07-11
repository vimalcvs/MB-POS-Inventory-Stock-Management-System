@extends('backend.layouts.app')
@section('title') {{__('pages.settings')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        @include('backend.settings.partial.user-account-nav')
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{route('update-profile')}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{__('pages.name')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" value="{{$employee->user->name}}" placeholder="{{__('pages.name')}}" class="form-control" aria-describedby="emailHelp" required>
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">{{__('pages.gender')}} <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="">{{__('pages.select_gender')}}</option>
                                            <option value="Male" {{$employee->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                            <option value="Female" {{$employee->gender == 'Male' ? 'Female' : ''}}>Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth">{{__('pages.date_of_birth')}} <span class="text-danger">*</span></label>
                                        <input name="date_of_birth" value="{{\Carbon\Carbon::parse($employee->date_of_birth)->toDateString()}}" id="date_of_birth" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.date_of_birth')}}" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group">{{__('pages.blood_group')}}</label>
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
                                        <input type="text" name="address" id="address" value="{{$employee->address}}" placeholder="{{__('pages.address')}}" required class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="educational_background"> {{__('pages.educational_background')}}</label>
                                        <input type="text" name="educational_background" class="form-control" placeholder="{{__('pages.educational_background')}}">
                                    </div>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <div class="form-group">
                                        <label for="profile_picture">{{__('pages.profile_picture')}} <span class="text-danger">*</span></label>

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

                            <div class="row">
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

