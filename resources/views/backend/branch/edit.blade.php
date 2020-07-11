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
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.update_branch')}}</h6>
                        <a href="{{route('branch.index')}}" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-2"></i> {{__('pages.all_branch')}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        <form action="{{route('branch.update', [$branch->id])}}" method="post" data-parsley-validate>
                            @csrf
                            @method('patch')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">{{__('pages.branch_name')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" value="{{$branch->title}}" placeholder="{{__('pages.branch_name')}}" class="form-control"  required>
                                        @if ($errors->has('title'))
                                            <div class="error">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person">{{__('pages.contact_person')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="contact_person" id="contact_person" value="{{$branch->contact_person}}" placeholder="{{__('pages.contact_person')}}" class="form-control"  required>
                                        @if ($errors->has('contact_person'))
                                            <div class="error">{{ $errors->first('contact_person') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{__('pages.phone_number')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" value="{{$branch->phone}}" placeholder="{{__('pages.phone_number')}}" class="form-control"  required>
                                        @if ($errors->has('phone'))
                                            <div class="error">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{__('pages.address')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="address" value="{{$branch->address}}" placeholder="{{__('pages.address')}}" class="form-control"  required>
                                        @if ($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_description">{{__('pages.short_description')}}</label>
                                        <textarea name="short_description" id="short_description" placeholder="{{__('pages.short_description')}}" class="form-control">{{$branch->short_description}}</textarea>
                                        @if ($errors->has('short_description'))
                                            <div class="error">{{ $errors->first('short_description') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row justify-content-end">
                                        <div class="col-md-2 pull-right">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">{{__('pages.update')}}</button>
                                            </div>
                                        </div>
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

