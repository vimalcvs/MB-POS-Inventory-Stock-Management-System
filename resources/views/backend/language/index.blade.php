@extends('backend.layouts.app')
@section('title') {{__('pages.language')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.language')}}</h6>
                        <a href="{{route('language.create')}}" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-plus"></i> {{__('pages.add_language')}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="3%">{{__('pages.sl')}}</th>
                                    <th width="10%">{{__('pages.flag')}}</th>
                                    <th>{{__('pages.country')}}</th>
                                    <th>{{__('pages.iso_code')}}</th>
                                    <th width="15%">{{__('pages.content')}}</th>
                                    <th width="8%">{{__('pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($languages as $key => $language)
                                        <tr>
                                            <td width="3%">{{$key + 1}}</td>
                                            <td><img src="{{asset($language->flag)}}" class="h-30"></td>
                                            <td>{{$language->language}}</td>
                                            <td width="10%">{{$language->iso_code}}</td>
                                            <td>
                                                <a href="{{route('translate', $language->id)}}" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i> {{__('pages.translate')}}</a>
                                            </td>
                                            <td class="font-14">
                                                @if($language->iso_code != 'en')
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                        <a href="{{route('language.edit', [$language->id])}}" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                        <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                        <form action="{{ route('language.destroy',$language->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                                                    </div>
                                                @else
                                                   --
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

