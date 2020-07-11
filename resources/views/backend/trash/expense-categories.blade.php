@extends('backend.layouts.app')
@section('title') {{__('pages.expense_category')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.expense_category')}}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="3%">{{__('pages.sl')}}</th>
                                    <th>{{__('pages.category_name')}}</th>
                                    <th width="8%">{{__('pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categories as $key => $category)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0);" class="btn btn-success" onclick="$(this).confirmRestore($('#delete-{{$key}}')) " class=""><i class="fas fa-trash-restore-alt mr-2"></i> Restore</a>
                                                <form action="{{ route('expense-category-restore-ok',['id' => $category->id]) }}" method="post" id="delete-{{$key}}"> @csrf </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted">No Data Found</td>
                                    </tr>
                                @endforelse
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

