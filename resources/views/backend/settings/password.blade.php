@extends('backend.layouts.app')
@section('title') Settings @endsection
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
                    <div class="card-body p-5">


                        <form action="{{route('update-password')}}" method="post" class="form-horizontal" enctype="multipart/form-data"  data-parsley-validate>
                            @csrf

                            <div class="row justify-content-center p-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="current_password">{{__('pages.current_password')}} <span class="text-danger">*</span></label>
                                        <input required name="current_password" minlength="5" type="password" class="form-control" placeholder="{{__('pages.current_password')}}">
                                    </div>


                                    <div class="form-group">
                                        <label for="password">{{__('pages.new_password')}}<span class="text-danger">*</span></label>
                                        <input required name="password" id="password" minlength="5" type="password" class="form-control"
                                               placeholder="{{__('pages.new_password')}}">
                                    </div>



                                    <div class="form-group">
                                        <label for="cnfirm_password">{{__('pages.re_type_password')}} <span class="text-danger">*</span></label>
                                        <input required name="c_password" minlength="5" data-parsley-equalto="#password" type="password" class="form-control"
                                               placeholder="{{__('pages.re_type_password')}}">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">{{__('pages.save_and_update')}}</button>
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

@endsection

