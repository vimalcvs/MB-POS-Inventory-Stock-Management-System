@extends('backend.layouts.app')
@section('title') {{__('pages.supplier')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid profile">
        <div class="row">
            <div class="col-md-3 pr-0">
                <div class="left-panel text-center">
                    <div class="logo p-2 text-center bg-secondary">
                        <img src="{{asset($supplier->logo ? $supplier->logo : 'backend/img/blank-thumbnail.jpg')}}" class="img-fluid">
                    </div>
                    <h5 class="text-center mt-4 company-name">{{$supplier->company_name}}</h5>
                    <span class="since">Member Since in {{$supplier->created_at->diffForHumans()}}</span>

                    <table class="table table-bordered text-left mt-3">
                        <tr class="text-center">
                            <td colspan="2"><b>{{__('pages.contact_information')}}</b></td>
                        </tr>
                        <tr>
                            <td>{{__('pages.name')}}:</td>
                            <td>{{$supplier->contact_person}}</td>
                        </tr>

                        <tr>
                            <td>{{__('pages.email')}}:</td>
                            <td>{{$supplier->email}}</td>
                        </tr>


                        <tr>
                            <td>{{__('pages.phone_number')}}:</td>
                            <td>{{$supplier->phone}}</td>
                        </tr>



                        <tr>
                            <td>{{__('pages.address')}}:</td>
                            <td>{{$supplier->address}}</td>
                        </tr>

                        <tr>
                            <td>{{__('pages.created_at')}}:</td>
                            <td>{{$supplier->created_at->format(get_option('app_date_format'))}}</td>
                        </tr>

                        <tr >
                            <td colspan="2" class="p-0">
                                @if($supplier->status == 1)
                                    <a href="javascript:void(0)" onclick="$(this).confirm('{{route('change-supplier-status', $supplier->id)}}');" class="btn btn-success btn-block btn-sm">
                                        {{__('pages.active')}}
                                    </a>
                                @else
                                    <a href="javascript:void(0)" onclick="$(this).confirm('{{route('change-supplier-status', $supplier->id)}}');" class="btn btn-danger btn-block btn-sm">
                                        {{__('pages.not_active')}}
                                    </a>
                                @endif
                            </td>
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
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('pages.total_purchase_amount')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{get_option('app_currency')}}
                                                @can('access_to_all_branch')
                                                    {{number_format($supplier->purchase->sum('total_amount'),2)}}
                                                @else
                                                    {{number_format($supplier->purchase->where('branch_id', auth()->user()->employee->branch_id)->sum('total_amount'),2)}}
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
                                                    {{number_format($supplier->payments->sum('amount'),2)}}
                                                @else
                                                    {{number_format($supplier->payments->where('branch_id', auth()->user()->employee->branch_id)->sum('amount'),2)}}
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
                                                    {{number_format($supplier->purchase->sum('due_amount') - $supplier->payments->sum('amount'),2)}}
                                                @else
                                                    {{number_format($supplier->purchase->where('branch_id', auth()->user()->employee->branch_id)->sum('due_amount') - $supplier->payments->where('branch_id', auth()->user()->employee->branch_id)->sum('amount'),2)}}
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
                                @foreach($purchase_by_branches as $key => $purchase_by_branch)
                                    <tr>
                                        <td>{{$purchase_by_branch['branch_name']}}</td>
                                        <td>{{get_option('app_currency')}}{{number_format($purchase_by_branch['total_purchase']->sum('total_amount'),2)}}</td>
                                        <td>
                                            {{get_option('app_currency')}}
                                            {{number_format($purchase_by_branch['total_purchase']->sum('paid_amount') + $purchase_by_branch['payment']->sum('amount'),2)}}
                                        </td>
                                        <td>{{get_option('app_currency')}}{{number_format($purchase_by_branch['total_purchase']->sum('due_amount') - $purchase_by_branch['payment']->sum('amount'),2)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                   <td class="text-right pr-2"><b>Total</b></td>
                                   <td><b>{{get_option('app_currency')}}{{number_format($supplier->purchase->sum('total_amount'),2)}}</b></td>
                                   <td><b>{{get_option('app_currency')}}{{number_format($supplier->purchase->sum('paid_amount') + $supplier->payments->sum('amount'),2)}}</b></td>
                                   <td><b>{{get_option('app_currency')}}{{number_format($supplier->purchase->sum('due_amount') - $supplier->payments->sum('amount'),2)}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endcan



                    <div class="table-responsive">
                        <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                            <thead>
                            <tr class="bg-secondary text-white">
                                <th>{{__('pages.sl')}}</th>
                                <th>{{__('pages.invoice_id')}}</th>
                                <th>{{__('pages.date')}}</th>
                                @if (Auth::user()->can('access_to_all_branch'))
                                    <th>{{__('pages.branch')}}</th>
                                @endif
                                <th>{{__('pages.total_amount')}}</th>
                                <th>{{__('pages.paid_amount')}}</th>
                                <th>{{__('pages.due_amount')}}</th>
                                <th width="4%">{{__('pages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchases as $key => $purchase)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <a href="{{route('purchase.show', [$purchase->id])}}" target="_blank">
                                            {{$purchase->invoice_id}}
                                        </a>
                                    </td>
                                    <td>{{$purchase->purchase_date->format(get_option('app_date_format'))}}</td>
                                    @if (Auth::user()->can('access_to_all_branch'))
                                        <td>
                                            {{$purchase->branch->title}}
                                        </td>
                                    @endif
                                    <td> {{get_option('app_currency')}}{{number_format($purchase->total_amount, 2)}} </td>
                                    <td> {{get_option('app_currency')}}{{number_format($purchase->paid_amount, 2)}} </td>
                                    <td> {{get_option('app_currency')}}{{number_format($purchase->due_amount, 2)}} </td>
                                    <td class="font-14">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                           <a href="{{route('purchase.show', [$purchase->id])}}" class="mr-2"><i class="fa fa-eye text-primary"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{$purchases->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

