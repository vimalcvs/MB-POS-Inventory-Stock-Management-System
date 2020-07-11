@extends('backend.layouts.app')
@section('title') Customer  @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Create Customer</h6>
                        <a href="{{route('customer.index')}}" class="btn btn-secondary btn-sm rounded-0">All Customers</a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{route('customer.store')}}" method="post" data-parsley-validate>
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" value="{{old('name')}}" placeholder="Customer Name" class="form-control" aria-describedby="emailHelp" required>
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" name="phone" id="phone" value="{{old('phone')}}" placeholder="Phone Number" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('phone'))
                                            <div class="error">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="Email Address" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Full Address</label>
                                        <input type="text" name="address" id="address" value="{{old('address')}}" placeholder="Full Address" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2 pull-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
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

