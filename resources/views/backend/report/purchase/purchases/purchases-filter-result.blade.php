@extends('backend.layouts.app')
@section('title') Purchase Report @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        @include('backend.report.purchase.partial.nav')
                        <div class="btn-group btn-group-sm filter-pdf-btn" role="group">
                            <form action="{{url('report/purchase/purchase-pdf')}}" method="get">
                                @include('backend.report.purchase.partial.hidden-filter-value-pdf')
                                <input type="hidden" name="action_type" value="download">
                                <button type="submit" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> PDF </button>
                            </form>

                            <form action="{{url('report/purchase/purchase-pdf')}}" method="get" target="_blank">
                                @include('backend.report.purchase.partial.hidden-filter-value-pdf')
                                <input type="hidden" name="action_type" value="print">
                                <button type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> PRINT </button>
                            </form>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <form action="{{url('report/purchase/purchases-filter-result')}}" method="get">
                            @include('backend.report.purchase.purchases.filter-form')
                        </form>

                        <div class="table-responsive margin-t-m5">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pages.sl')}}</th>
                                    <th>{{__('pages.invoice_id')}}</th>
                                    @can('access_to_all_branch')
                                    <th>{{__('pages.branch')}}</th>
                                    @endcan
                                    <th>{{__('pages.supplier')}}</th>
                                    <th>{{__('pages.purchase_date')}}</th>
                                    <th>{{__('pages.total_amount')}}</th>
                                    <th>{{__('pages.paid_amount')}}</th>
                                    <th>{{__('pages.due_amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total_grand_total_amount = 0;
                                    $total_paid_amount = 0;
                                    $total_due_amount = 0;
                                @endphp
                                @foreach($purchases as $key => $purchase)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            <a href="{{route('purchase.show', [$purchase->id])}}" target="_blank">{{$purchase->invoice_id}}</a>
                                        </td>
                                        @can('access_to_all_branch')
                                        <td>{{$purchase->branch->title}}</td>
                                        @endcan
                                        <td>{{$purchase->supplier->company_name}}</td>
                                        <td>{{$purchase->purchase_date->format(get_option('app_date_format'))}}</td>
                                        <td>{{get_option('app_currency')}}{{number_format($purchase->total_amount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($purchase->paid_amount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($purchase->due_amount, 2)}} </td>
                                    </tr>

                                    @php
                                        $total_grand_total_amount += $purchase->total_amount;
                                        $total_paid_amount += $purchase->paid_amount;
                                        $total_due_amount += $purchase->due_amount;
                                    @endphp
                                @endforeach
                                <tr>
                                    @can('access_to_all_branch')
                                        <td colspan="5" class="text-right pr-3"><strong>{{__('pages.total')}}</strong></td>
                                    @else
                                        <td colspan="4" class="text-right pr-3"><strong>{{__('pages.total')}}</strong></td>
                                    @endcan
                                    <td><strong>{{get_option('app_currency')}}{{number_format($total_grand_total_amount, 2)}}</strong></td>
                                    <td><strong>{{get_option('app_currency')}}{{number_format($total_paid_amount, 2)}}</strong></td>
                                    <td><strong>{{get_option('app_currency')}}{{number_format($total_due_amount, 2)}}</strong></td>
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

@endsection

