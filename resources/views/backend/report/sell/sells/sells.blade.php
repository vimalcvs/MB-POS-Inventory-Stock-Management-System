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
                                </tbody>
                            </table>

                           <div class="text-center pl-2">
                               {{$sells->links()}}
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

