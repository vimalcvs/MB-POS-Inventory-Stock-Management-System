@extends('backend.layouts.app')
@section('title') Users @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                        <a href="{{route('user.create')}}" class="btn btn-secondary btn-sm rounded-0">Create User</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Branch</th>
                                            <th>Status</th>
                                            <th width="8%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->address}}</td>
                                            <td></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <a href="{{route('user.edit', [encrypt($user->id)])}}" class="btn btn-primary rounded-0"><i class="fa fa-pencil-alt"></i> </a>
                                                    <a href="{{route('user.show', [encrypt($user->id)])}}" class="btn btn-secondary rounded-0"><i class="fa fa-eye"></i> </a>
                                                    <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    <form action="{{ route('user.destroy',encrypt($user->id)) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                                                </div>
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
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

