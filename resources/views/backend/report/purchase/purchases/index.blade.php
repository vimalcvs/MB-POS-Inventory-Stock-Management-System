@extends('backend.layouts.app')
@section('title') Purchases Report @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        @include('backend.report.purchase.partial.nav')
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
                                        <td> {{get_option('app_currency')}}{{number_format($purchase->total_amount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($purchase->paid_amount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($purchase->due_amount, 2)}} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="text-center pl-2">
                                {{$purchases->links()}}
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

