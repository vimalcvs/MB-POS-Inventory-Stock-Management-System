@extends('backend.layouts.app')
@section('title') {{__('pages.dashboard')}} @endsection
@section('content')
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('pages.sales_of_month')}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{get_option('app_currency')}}{{number_format($sell_of_this_month,2)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('pages.total_sales_amount')}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{get_option('app_currency')}}{{number_format($total_sell,2)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('pages.purchase_of_month')}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{get_option('app_currency')}}{{number_format($purchase_of_this_month,2)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck-moving fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('pages.total_purchase_amount')}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{get_option('app_currency')}}{{number_format($total_purchase,2)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck-moving fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.sales_summary_last_30_days')}}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 col-12 pr-1">
                <div class="card shadow mb-5 pb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.trending_products')}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center font-size-12" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pages.sl')}}</th>
                                    <th>{{__('pages.title')}}</th>
                                    <th>{{__('pages.sku')}}</th>
                                    <th>{{__('pages.amount')}}</th>
                                    <th>{{__('pages.sell_qty')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trending_products as $key => $product)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <a href="{{route('product.show', $product->id)}}">
                                                {{str_limit($product->title, 20)}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('product.show', $product->id)}}">
                                                {{$product->sku}}
                                            </a>
                                        </td>
                                        <td> {{get_option('app_currency')}} {{number_format($product->sellProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('total_price'), 2)}} </td>
                                        <td>{{$product->total_sell_qty}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12 pl-1">
                <div class="card shadow mb-5 pb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.low_stock_products')}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center font-size-12" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pages.sl')}}</th>
                                    <th>{{__('pages.title')}}</th>
                                    <th>{{__('pages.sku')}}</th>
                                    <th>{{__('pages.current_stock_qty')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($low_stock_products as $key => $product)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <a href="{{route('product.show', $product->id)}}">
                                                {{str_limit($product->title, 20)}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('product.show', $product->id)}}">
                                                {{$product->sku}}
                                            </a>
                                        </td>
                                        <td>{{$product->current_stock_quantity}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12">

                <!-- Project Card Example -->
                <div class="card shadow mb-5 pb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.branches_target_this_month')}}</h6>
                    </div>
                    <div class="card-body">

                        @foreach($sells_targets as $key => $sell_target)
                            @php
                                if(monthlySells($sell_target->branch_id, $sell_target->month) > 0){
                                    $result = monthlySells($sell_target->branch_id, $sell_target->month) * 100 / $sell_target->target_amount;
                                }else{
                                    $result = 0;
                                }
                            @endphp

                            <h4 class="small font-weight-bold">{{$sell_target->branch->title}} <span class="float-right">{{number_format($result,2)}}%</span></h4>
                            <div class="progress mb-4">
                                @if($result < 15)
                                    <div class="progress-bar progress-bar-striped bg-danger w10p" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{number_format($result,2)}}% {{__('pages.complete')}}</div>
                                @elseif($result < 40)
                                    <div class="progress-bar progress-bar-striped bg-warning dwp-{{round($result)}}" role="progressbar" aria-valuenow="{{$result}}" aria-valuemin="0" aria-valuemax="100">{{number_format($result,2)}}% {{__('pages.complete')}}</div>
                                @elseif($result < 60)
                                    <div class="progress-bar progress-bar-striped bg-info dwp-{{round($result)}}" role="progressbar" aria-valuenow="{{$result}}" aria-valuemin="0" aria-valuemax="100">{{number_format($result,2)}}% {{__('pages.complete')}}</div>
                                @elseif($result < 80)
                                    <div class="progress-bar progress-bar-striped bg-info dwp-{{round($result)}}" role="progressbar" aria-valuenow="{{$result}}" aria-valuemin="0" aria-valuemax="100">{{number_format($result,2)}}% {{__('pages.complete')}}</div>
                                @else
                                    <div class="progress-bar progress-bar-striped bg-info dwp-{{round($result)}}" role="progressbar" aria-valuenow="{{$result}}" aria-valuemin="0" aria-valuemax="100">{{number_format($result,2)}}% {{__('pages.complete')}}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@section('js')
    <!-- Page level plugins -->
    <script src="{{asset('/backend/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('/backend/js/partial/dashboard.js')}}"></script>
@endsection

