@extends('backend.layouts.app')
@section('title') {{__('pages.expense')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header">
                        <div class="row margin-b-m15">
                            <div class="col-md-10 text-right">
                                @include('backend.expense.filter-from')
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('expense.create')}}" class="btn btn-secondary btn-block"><i class="fa fa-plus mr-2"></i> {{__('pages.new_expense')}}</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th width="3%">{{__('pages.sl')}}</th>
                                        <th width="10%">{{__('pages.expense_id')}}</th>
                                        @can('access_to_all_branch')
                                            <th width="15%">{{__('pages.branch')}}</th>
                                        @endcan
                                        <th >{{__('pages.expense_date')}}</th>
                                        <th width="15%">{{__('pages.expense_category')}}</th>

                                        <th>{{__('pages.amount')}}</th>
                                        <th width="8%">{{__('pages.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($expenses as $key => $expense)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$expense->expense_id}}</td>
                                        @can('access_to_all_branch')
                                            <td> {{$expense->branch->title}}</td>
                                        @endcan
                                        <td>{{$expense->expense_date->format(get_option('app_date_format'))}}</td>

                                        <td > {{$expense->expenseCategory ? $expense->expenseCategory->name : '--'}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($expense->amount, 2)}} </td>

                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{route('expense.edit', [$expense->id])}}" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                <a href="javascript:void(0)" class="mr-2 show-expense-details" data-expense-id="{{$expense->id}}"><i class="fa fa-eye"></i> </a>
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="{{ route('expense.destroy',$expense->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="drawer d-none shadow right expense-details-dwawer w-25" id="expenseDetails{{$expense->id}}">
                                        <button class="btn btn-primary btn-close drawer-close-btn-for-expense" >x</button>
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">{{__('pages.expense')}}</h6>
                                            </div>
                                            <div class="card-body pt-4">
                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right">{{__('pages.expense_id')}}:</div>
                                                    <div class="col-8 p-1 pl-5">{{$expense->expense_id}}</div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right">{{__('pages.amount')}}:</div>
                                                    <div class="col-8 p-1 pl-5"><b>{{get_option('app_currency')}} {{number_format($expense->amount, 2)}}</b></div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right">{{__('pages.expense_date')}}:</div>
                                                    <div class="col-8 p-1 pl-5">{{$expense->expense_date->format(get_option('app_date_format'))}}</div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right">{{__('pages.category')}}:</div>
                                                    <div class="col-8 p-1 pl-5">{{$expense->expenseCategory ? $expense->expenseCategory->name : '--'}}</div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right">{{__('pages.branch')}}:</div>
                                                    <div class="col-8 p-1 pl-5">{{$expense->branch->title}}</div>
                                                </div>



                                                <div class="row border-bottom p-2">
                                                    <div class="col-4 p-1 text-right">{{__('pages.note')}}:</div>
                                                    <div class="col-8 p-1 pl-5"> {{$expense->note}}</div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>

                            {{$expenses->links()}}
                        </div>


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

