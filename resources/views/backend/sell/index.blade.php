@extends('backend.layouts.app')
@section('title') {{__('pages.sells')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header">
                        <div class="row margin-b-m15">
                            <div class="col-md-12 text-right">
                                <form action="{{route('sell-filter')}}" method="get">
                                    <div class="row p-0">
                                        <div class="col-md-2 pr-0">
                                            <div class="form-group text-left">
                                               <input type="text" name="invoice_id" value="{{Request::get('invoice_id')}}" class="form-control" placeholder="{{__('pages.invoice_id')}}">
                                            </div>
                                        </div>

                                        @can('access_to_all_branch')
                                            <div class="col-md-2 pr-0">
                                                <div class="form-group text-left">
                                                    <select name="branch_id" class="form-control select2">
                                                        <option value="">{{__('pages.all_branch')}}</option>
                                                        @foreach($branches as $branch)
                                                            <option value="{{$branch->id}}" {{Request::get('branch_id') == $branch->id ? 'selected' : ''}}>{{$branch->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="branch_id" value="{{auth()->user()->employee->branch_id}}">
                                        @endcan


                                        <div class="col-md-2 pr-0">
                                            <div class="form-group text-left">
                                                <select name="customer_id" class="form-control select2">
                                                    <option value="">{{__('pages.all_customer')}}</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{$customer->id}}" {{Request::get('customer_id') == $customer->id ? 'selected' : ''}}>{{$customer->name}}, {{$customer->phone}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 pr-0">
                                            <div class="form-group text-left">
                                                <input type="text" name="start_date" value="{{Request::get('start_date')}}" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.start_date')}}" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group text-left">
                                                <input type="text" name="end_date" value="{{Request::get('end_date')}}" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.end_date')}}" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button class="btn btn-secondary btn-block">{{__('pages.search')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center font-size-12" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pages.sl')}}</th>
                                    <th>{{__('pages.invoice_id')}}</th>
                                    @can('access_to_all_branch')
                                        <th>{{__('pages.branch')}}</th>
                                    @endcan
                                    <th>{{__('pages.customer')}}</th>
                                    <th>{{__('pages.sell_date')}}</th>
                                    <th>{{__('pages.sub_total')}}</th>
                                    <th>{{__('pages.discount')}}</th>
                                    <th>{{__('pages.grand_total')}}</th>
                                    <th>{{__('pages.paid_amount')}}</th>
                                    <th>{{__('pages.due_amount')}}</th>
                                    <th width="8%">{{__('pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sells as $key => $sell)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$sell->invoice_id}}</td>
                                        @can('access_to_all_branch')
                                        <td>{{$sell->branch->title}}</td>
                                        @endcan
                                        <td>{{$sell->customer->name}}</td>
                                        <td>{{$sell->sell_date->format(get_option('app_date_format'))}}</td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->sub_total, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->discount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->grand_total_price, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->paid_amount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->due_amount, 2)}} </td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{route('sell.edit', [$sell->id])}}" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                <a href="{{route('sell.show', [$sell->id])}}" class="mr-2"><i class="fa fa-eye"></i> </a>
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="{{ route('sell.destroy',$sell->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{$sells->links()}}
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

