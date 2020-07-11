@extends('backend.layouts.app')
@section('title') {{__('pages.notice')}}  @endsection

@section('css')
    <link rel="stylesheet" href="{{asset('backend/css/jquery.timepicker.min.css')}}">
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.edit')}} {{__('pages.notice')}}</h6>
                        <a href="{{route('notice.index')}}" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-2"></i> {{__('pages.manage')}} {{__('pages.notice')}}</a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body min-height-550">
                        <form action="{{route('notice.update', $notice->id)}}" method="post" data-parsley-validate>
                            @csrf
                            @method('patch')

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">{{__('pages.title')}} <span class="text-danger">*</span></label>
                                                <input name="title" value="{{old('title') ? old('title') : $notice->title}}" id="title" type="text" class="form-control" placeholder="{{__('pages.title')}}" required autocomplete="off">
                                                @if ($errors->has('title'))
                                                    <div class="error">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="user_id">{{__('pages.notify_to')}} <span class="text-danger">*</span></label>
                                                <select name="user_id[]" id="user_id" class="form-control select2" multiple="true">
                                                    <option value="all">{{__('pages.all_employee')}}</option>

                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}" @if(in_array($user->id, $selectedUser)) selected @endif >{{$user->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('user_id'))
                                                    <div class="error mt-1">{{ $errors->first('user_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="notify_date">{{__('pages.notify_date')}} <span class="text-danger">*</span></label>
                                                <input name="notify_date" value="{{old('notify_date') ? old('notify_date') : $notice->notify_date->format('Y-m-d')}}" id="notify_date" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.notify_date')}}" required autocomplete="off">
                                                @if ($errors->has('notify_date'))
                                                    <div class="error">{{ $errors->first('notify_date') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="notify_time">{{__('pages.notify_time')}} <span class="text-danger">*</span></label>
                                                <input type="text" name="notify_time" value="{{$notice->notify_time}}" id="notify_time" class="form-control timepicker" placeholder="{{__('pages.notify_time')}}" autocomplete="off">
                                                @if ($errors->has('notify_time'))
                                                    <div class="error">{{ $errors->first('notify_time') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="note">{{__('pages.description')}}</label>
                                                <textarea name="description" placeholder="{{__('pages.description')}}" class="form-control" rows="5" required>{{$notice->description}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mt-2">
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
    <script src="{{asset('backend/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('backend/js/timepicker.js')}}"></script>
@endsection

