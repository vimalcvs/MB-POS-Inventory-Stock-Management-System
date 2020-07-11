@extends('backend.layouts.app')
@section('title') {{__('pages.language')}}  @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.add_language')}}</h6>
                        <a href="{{route('language.index')}}" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-list mr-1"></i> {{__('pages.all_language')}}</a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{route('language.update', $language->id)}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('patch')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{__('pages.language')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="{{$language->language}}" placeholder="{{__('pages.language')}}" class="form-control" aria-describedby="emailHelp" required>
                                        @if ($errors->has('language'))
                                            <div class="error">{{ $errors->first('language') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">{{__('pages.iso_code')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="iso_code" id="iso_code" value="{{$language->iso_code}}" placeholder="{{__('pages.iso_code')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('iso_code'))
                                            <div class="error">{{ $errors->first('iso_code') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group pt-35">
                                        <a href="https://en.wikipedia.org/wiki/ISO_3166-1" target="_blank"><b> <i class="fa fa-list mr-1"></i> ISO Code List</b></a>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" name="flag" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose Flag</label>
                                            @if ($errors->has('flag'))
                                                <div class="error">{{ $errors->first('flag') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 mt-3">
                                    <div class="row justify-content-end">
                                        <div class="col-md-2 pull-right">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">{{__('pages.save')}}</button>
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

