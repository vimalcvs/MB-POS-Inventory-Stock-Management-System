@extends('backend.layouts.app')
@section('title') {{__('pages.supplier')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.update_supplier')}}</h6>
                        <a href="{{route('supplier.index')}}" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-1"></i> {{__('pages.all_supplier')}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        <form action="{{route('supplier.update', [$supplier->id])}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('patch')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_name">{{__('pages.company_name')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="company_name" id="company_name" value="{{$supplier->company_name}}" placeholder="{{__('pages.company_name')}}" class="form-control" aria-describedby="emailHelp" required>
                                        @if ($errors->has('company_name'))
                                            <div class="error">{{ $errors->first('company_name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person">{{__('pages.contact_person')}}</label>
                                        <input type="text" name="contact_person" id="contact_person" value="{{$supplier->contact_person}}" placeholder="{{__('pages.contact_person')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('contact_person'))
                                            <div class="error">{{ $errors->first('contact_person') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{__('pages.phone_number')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" value="{{$supplier->phone}}" placeholder="{{__('pages.phone_number')}}" class="form-control" aria-describedby="emailHelp" required>
                                        @if ($errors->has('phone'))
                                            <div class="error">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{__('pages.email')}}</label>
                                        <input type="email" name="email" id="email" value="{{$supplier->email}}" placeholder="{{__('pages.email')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">{{__('pages.address')}}</label>
                                        <input type="text" name="address" id="address" value="{{$supplier->address}}" placeholder="{{__('pages.address')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="upload-img-box">
                                            @if($supplier->logo)
                                                <img src="{{asset($supplier->logo)}}">
                                             @else
                                                <img src="">
                                            @endif
                                            <input type="file" name="logo" id="logo" accept="image/*" onchange="previewFile(this)">
                                            <div class="upload-img-box-icon">
                                                <i class="fa fa-camera"></i>
                                                <p class="m-0">Add Logo</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                               <div class="col-md-12 mt-3">
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
    <script src="{{asset('/backend/js/custom.js')}}"></script>
@endsection
