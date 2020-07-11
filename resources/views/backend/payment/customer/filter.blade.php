@extends('backend.layouts.app')
@section('title') {{__('pages.payment')}} @endsection
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
                                @include('backend.payment.customer.filter-from')
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <form action="{{url('report/payment/customer')}}" method="get" target="_blank">
                                        <input type="hidden" name="start_date" value="{{Request::get('start_date')}}">
                                        <input type="hidden" name="end_date" value="{{Request::get('end_date')}}">
                                        <input type="hidden" name="branch_id" value="{{Request::get('branch_id')}}">
                                        <input type="hidden" name="customer_id" value="{{Request::get('customer_id')}}">
                                        <button type="submit" class="btn btn-warning btn-block rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> {{__('pages.print')}} </button>
                                    </form>
                                </div>
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
                                    @can('access_to_all_branch')
                                        <th width="20%">{{__('pages.branch')}}</th>
                                    @endcan
                                    <th width="20%">{{__('pages.customer')}}</th>
                                    <th >{{__('pages.date')}}</th>
                                    <th>{{__('pages.amount')}}</th>
                                    <th width="8%">{{__('pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $key => $payment)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            @can('access_to_all_branch')
                                                <td> {{$payment->branch->title}}</td>
                                            @endcan
                                            <td>{{$payment->customer ? $payment->customer->name : '--'}} </td>
                                            <td>{{$payment->payment_date->format(get_option('app_date_format'))}}</td>
                                            <td> {{get_option('app_currency')}}{{number_format($payment->amount, 2)}} </td>

                                            <td class="font-14">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <a href="{{route('payment-from-customer.edit', [$payment->id])}}" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                    <a href="javascript:void(0)" class="mr-2 show-payment-details-for-customer" data-payment-id="{{$payment->id}}"><i class="fa fa-eye"></i> </a>
                                                    <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                    <form action="{{ route('payment-from-customer.destroy',$payment->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="drawer d-none shadow right payment-details-drawer w-500" id="paymentDetails{{$payment->id}}">
                                            <button class="btn btn-primary btn-close drawer-close-btn-for-customer" >x</button>
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">{{__('pages.payment')}}</h6>
                                                </div>
                                                <div class="card-body pt-4">

                                                    @can('access_to_all_branch')
                                                        <div class="row border-bottom">
                                                            <div class="col-4 p-1 text-right">{{__('pages.branch')}}:</div>
                                                            <div class="col-8 p-1 pl-5">{{$payment->branch->title}}</div>
                                                        </div>
                                                    @endcan

                                                    <div class="row border-bottom">
                                                        <div class="col-4 p-1 text-right">{{__('pages.customer')}}:</div>
                                                        <div class="col-8 p-1 pl-5">{{$payment->customer ? $payment->customer->name : '--'}}</div>
                                                    </div>

                                                    <div class="row border-bottom">
                                                        <div class="col-4 p-1 text-right">{{__('pages.amount')}}:</div>
                                                        <div class="col-8 p-1 pl-5"><b>{{get_option('app_currency')}}{{number_format($payment->amount, 2)}}</b></div>
                                                    </div>

                                                    <div class="row border-bottom">
                                                        <div class="col-4 p-1 text-right">{{__('pages.payment_date')}}:</div>
                                                        <div class="col-8 p-1 pl-5">{{$payment->payment_date->format(get_option('app_date_format'))}}</div>
                                                    </div>

                                                    <div class="row border-bottom">
                                                        <div class="col-4 p-1 text-right">{{__('pages.note')}}:</div>
                                                        <div class="col-8 p-1 pl-5">{{$payment->note}}</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <tr>

                                       <td colspan="@can('access_to_all_branch') 4 @else 3 @endif" class="text-right pr-3"><b>Total Amount</b></td>
                                       <td><b>{{get_option('app_currency')}}{{number_format($payments->sum('amount'), 2)}}</b></td>
                                       <td>--</td>
                                    </tr>
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
    <script src="{{asset('/backend/js/custom.js')}}"></script>
@endsection

