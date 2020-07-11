@extends('backend.layouts.app')
@section('title') {{__('pages.customer')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid profile">
        <div class="row">
            <div class="col-md-3 pr-0">
                <div class="left-panel text-center">
                    <div class="logo p-2 text-center bg-secondary">
                        <img src="{{asset($customer->photo ? $customer->photo : 'backend/img/user-placeholder.png')}}" class="img-fluid">
                    </div>
                    <h5 class="text-center mt-4 company-name">{{$customer->name}}</h5>
                    <span class="since">Member Since in {{$customer->created_at->diffForHumans()}}</span>

                    <table class="table table-bordered text-left mt-3">
                        <tr>
                            <td>{{__('pages.name')}}:</td>
                            <td>{{$customer->name}}</td>
                        </tr>

                        <tr>
                            <td>{{__('pages.email')}}:</td>
                            <td>{{$customer->email}}</td>
                        </tr>


                        <tr>
                            <td>{{__('pages.phone_number')}}:</td>
                            <td>{{$customer->phone}}</td>
                        </tr>



                        <tr>
                            <td>{{__('pages.address')}}:</td>
                            <td>{{$customer->address}}</td>
                        </tr>

                        <tr>
                            <td>{{__('pages.created_at')}}:</td>
                            <td>{{$customer->created_at->format(get_option('app_date_format'))}}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-md-9">
                <div class="right-panel">
                    <div class="row p-3">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('pages.total_sell_amount')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{get_option('app_currency')}}
                                                @can('access_to_all_branch')
                                                    {{number_format($customer->sells->sum('grand_total_price'),2)}}
                                                @else
                                                    {{number_format($customer->sells->where('branch_id', auth()->user()->employee->branch_id)->sum('grand_total_price'),2)}}
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('pages.total_paid')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{get_option('app_currency')}}

                                                @can('access_to_all_branch')
                                                    {{number_format($customer->sells->sum('paid_amount'),2)}}
                                                @else
                                                    {{number_format($customer->sells->where('branch_id', auth()->user()->employee->branch_id)->sum('paid_amount'),2)}}
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('pages.total_due')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{get_option('app_currency')}}

                                                @can('access_to_all_branch')
                                                    {{number_format($customer->sells->sum('due_amount'),2)}}
                                                @else
                                                    {{number_format($customer->sells->where('branch_id', auth()->user()->employee->branch_id)->sum('due_amount'),2)}}
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @can('access_to_all_branch')
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pages.branch')}}</th>
                                    <th>{{__('pages.total_purchase')}}</th>
                                    <th>{{__('pages.total_paid')}}</th>
                                    <th>{{__('pages.total_due')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sell_by_branches as $key => $sell_by_branch)
                                    <tr>
                                        <td>{{$sell_by_branch['branch_name']}}</td>
                                        <td>{{get_option('app_currency')}}{{number_format($sell_by_branch['sells']->sum('grand_total_price'),2)}}</td>
                                        <td>
                                            {{get_option('app_currency')}}{{number_format($sell_by_branch['sells']->sum('paid_amount'),2)}}
                                        </td>
                                        <td>{{get_option('app_currency')}}{{number_format($sell_by_branch['sells']->sum('due_amount'),2)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-right pr-2"><b>Total</b></td>
                                    <td><b>{{get_option('app_currency')}}{{number_format($customer->sells->sum('grand_total_price'),2)}}</b></td>
                                    <td><b>{{get_option('app_currency')}}{{number_format($customer->sells->sum('paid_amount'),2)}}</b></td>
                                    <td><b>{{get_option('app_currency')}}{{number_format($customer->sells->sum('due_amount'),2)}}</b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endcan

                    @if($sells->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center font-size-12" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pages.invoice_id')}}</th>
                                    @can('access_to_all_branch')
                                        <th>{{__('pages.branch')}}</th>
                                    @endcan
                                    <th>{{__('pages.sell_date')}}</th>
                                    <th>{{__('pages.sub_total')}}</th>
                                    <th>{{__('pages.discount')}}</th>
                                    <th>{{__('pages.grand_total')}}</th>
                                    <th>{{__('pages.paid_amount')}}</th>
                                    <th>{{__('pages.due_amount')}}</th>
                                    <th width="5%">{{__('pages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sells as $key => $sell)
                                    <tr>
                                        <td>
                                            <a href="{{route('sell.show', [$sell->id])}}" target="_blank">
                                                {{$sell->invoice_id}}
                                            </a>
                                        </td>
                                        @can('access_to_all_branch')
                                            <td>{{$sell->branch->title}}</td>
                                        @endcan
                                        <td>{{$sell->sell_date->format(get_option('app_date_format'))}}</td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->sub_total, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->discount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->grand_total_price, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->paid_amount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->due_amount, 2)}} </td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{route('sell.show', [$sell->id])}}" class="mr-2" target="_blank"><i class="fa fa-eye"></i> </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{$sells->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

