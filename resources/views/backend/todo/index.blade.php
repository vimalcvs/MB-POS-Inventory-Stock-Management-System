@extends('backend.layouts.app')
@section('title') {{__('pages.todo')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.todo_list')}}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th width="3%">{{__('pages.sl')}}</th>
                                        <th>{{__('pages.title')}}</th>
                                        <th width="13%">{{__('pages.created_at')}}</th>
                                        <th width="5%">{{__('pages.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($todos as $key => $todo)
                                    <tr class="{{$todo->status == 1 ? 'bg-success' : 'bg-warning'}}">
                                        <td>{{$key+1}}</td>
                                        <td>{{$todo->title}}</td>
                                        <td>{{$todo->created_at->format(get_option('app_date_format'))}}</td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="{{ route('todo.destroy',$todo->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{$todos->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

