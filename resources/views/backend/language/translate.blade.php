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
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.translate_your_language')}} ( English => {{$language->language}} ) </h6>
                        <a href="{{route('language.index')}}" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-list mr-1"></i> {{__('pages.all_language')}}</a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{route('update-translate')}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                            @csrf

                            <input type="hidden" name="language_id" value="{{$language->id}}">
                            <div class="row">
                                @foreach($language_array as $key => $value)
                                    <div class="col-md-6">
                                        <div class="form-group row justify-content-center">
                                            <label class="col-sm-5 col-form-label text-right">{{ucwords(str_replace("_", " ", $key))}}  => </label>
                                            <div class="col-sm-7">
                                                <input type="text" name="{{$key}}" value="{{$value}}" placeholder="{{__('pages.title')}}" class="form-control" aria-describedby="emailHelp" required>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-12 mt-3">
                                    <div class="row justify-content-end">
                                        <div class="col-md-3 pull-right">
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

