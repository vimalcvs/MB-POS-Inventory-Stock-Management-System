@extends('backend.layouts.app')
@section('title') Sells Report @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        @include('backend.report.sell.partial.nav')
                        <div class="btn-group btn-group-sm filter-pdf-btn" role="group">
                            <form action="{{url('report/sell/sells-pdf')}}" method="get">
                                @include('backend.report.sell.partial.hidden-filter-value-pdf')
                                <input type="hidden" name="action_type" value="download">
                                <button type="submit" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> {{__('pages.pdf')}} </button>
                            </form>

                            <form action="{{url('report/sell/sells-pdf')}}" method="get" target="_blank">
                                @include('backend.report.sell.partial.hidden-filter-value-pdf')
                                <input type="hidden" name="action_type" value="print">
                                <button type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> {{__('pages.print')}} </button>
                            </form>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <form action="{{url('report/sell/sells-filter-result')}}" method="get">
                            @include('backend.report.sell.sells.filter-from')
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
                                    <th>{{__('pages.sell_date')}}</th>
                                    <th>{{__('pages.sub_total')}}</th>
                                    <th>{{__('pages.discount')}}</th>
                                    <th>{{__('pages.grand_total')}}</th>
                                    <th>{{__('pages.paid_amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($sells as $key => $sell)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a href="{{route('sell.show', [$sell->id])}}">{{$sell->invoice_id}}</a>
                                            </td>
                                            @can('access_to_all_branch')
                                                <td>{{$sell->branch->title}}</td>
                                            @endcan
                                            <td>{{$sell->sell_date->format(get_option('app_date_format'))}}</td>
                                            <td> {{get_option('app_currency')}}{{number_format($sell->sub_total, 2)}} </td>
                                            <td> {{get_option('app_currency')}}{{number_format($sell->discount, 2)}} </td>
                                            <td> {{get_option('app_currency')}}{{number_format($sell->grand_total_price, 2)}} </td>
                                            <td> {{get_option('app_currency')}}{{number_format($sell->paid_amount, 2)}} </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        @can('access_to_all_branch')
                                            <td colspan="4" class="text-right"><strong>{{__('pages.total')}}</strong></td>
                                        @else
                                            <td colspan="3" class="text-right"><strong>{{__('pages.total')}}</strong></td>
                                        @endcan

                                        <td> <strong>{{get_option('app_currency')}}{{number_format($sells->sum('sub_total'), 2)}}</strong>  </td>
                                        <td> <strong>{{get_option('app_currency')}}{{number_format($sells->sum('discount'), 2)}}</strong> </td>
                                        <td> <strong>{{get_option('app_currency')}}{{number_format($sells->sum('grand_total_price'), 2)}}</strong> </td>
                                        <td> <strong>{{get_option('app_currency')}}{{number_format($sells->sum('paid_amount'), 2)}}</strong> </td>
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

