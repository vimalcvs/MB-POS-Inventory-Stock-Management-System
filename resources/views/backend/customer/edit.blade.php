@extends('backend.layouts.app')
@section('title') {{__('pages.customer')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.update_customer')}}</h6>
                        <a href="{{route('customer.index')}}" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-list mr-1"></i> {{__('pages.all_customer')}} </a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        <form action="{{route('customer.update', [$customer->id])}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('patch')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{__('pages.name')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" value="{{$customer->name}}" required placeholder="{{__('pages.customer_name')}}" class="form-control" aria-describedby="emailHelp" required>
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{__('pages.phone_number')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" value="{{$customer->phone}}" placeholder="{{__('pages.phone_number')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('phone'))
                                            <div class="error">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{__('pages.email')}}</label>
                                        <input type="email" name="email" id="email" value="{{$customer->email}}" placeholder="{{__('pages.email')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{__('pages.email')}}</label>
                                        <input type="text" name="address" id="address" value="{{$customer->address}}" placeholder="{{__('pages.address')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_description">{{__('pages.photo')}}</label>
                                        <input type="file" name="photo" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                <div class="col-md-2 pull-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">{{__('pages.update')}}</button>
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

