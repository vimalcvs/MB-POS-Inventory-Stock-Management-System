@extends('backend.layouts.app')
@section('title') {{__('pages.product')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid profile">
        <div class="row">
            <div class="col-md-3 pr-0">
                <div class="left-panel text-center">
                    <div class="logo p-2 text-center bg-secondary">
                        <img src="{{asset($product->thumbnail ? $product->thumbnail : 'backend/img/blank-thumbnail.jpg')}}" class="img-fluid">
                    </div>
                    <h5 class="text-center mt-4 company-name">{{$product->title}}</h5>
                    <span class="since">{{__('pages.created_at')}}: {{$product->created_at->diffForHumans()}}</span>

                    <table class="table table-bordered text-left mt-3 table-sm">
                        <tr>
                            <td>{{__('pages.sku')}}:</td>
                            <td>{{$product->sku}}</td>
                        </tr>

                        <tr>
                            <td>{{__('pages.category')}}:</td>
                            <td>{{$product->category ? $product->category->title : '--'}}</td>
                        </tr>


                        <tr>
                            <td>{{__('pages.purchase_price')}}:</td>
                            <td>{{get_option('app_currency')}}{{$product->purchase_price}}</td>
                        </tr>


                        <tr>
                            <td>{{__('pages.sell_price')}}:</td>
                            <td>{{get_option('app_currency')}}{{$product->sell_price}}</td>
                        </tr>

                        <tr>
                            <td>{{__('pages.sell_price_type')}}:</td>
                            <td>{{$product->price_type == 1 ? 'Fixed' : 'Negotiable'}}</td>
                        </tr>

                        <tr>
                            <td>{{__('pages.tax')}}:</td>
                            <td>{{$product->tax->title}}</td>
                        </tr>

                        <tr >
                            <td colspan="2" class="p-2 text-center">
                                {{$product->short_description}}
                            </td>
                        </tr>



                        <tr >
                            <td colspan="2" class="p-0">
                                <div class="row">
                                    <div class="col-md-4 pr-0">
                                        @if($product->status == 1)
                                            <a href="javascript:void(0)" onclick="$(this).confirm('{{url('change-product-status/'.$product->id)}}');" class="btn btn-success btn-block btn-sm">
                                                {{__('pages.active')}}
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" onclick="$(this).confirm('{{url('change-product-status/'.$product->id)}}');" class="btn btn-danger btn-block btn-sm">
                                                {{__('pages.not_active')}}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-md-4 pl-0 pr-0">
                                        <a href="{{route('product.edit', $product->id)}}"  class="btn btn-warning btn-block btn-sm" target="_blank">
                                            {{__('pages.edit')}}
                                        </a>
                                    </div>
                                    <div class="col-md-4 pl-0">
                                        <a href="javascript:void(0)" data-id="{{$product->id}}" class="btn btn-secondary btn-block btn-sm download-bar-code">
                                            {{__('pages.barcode')}}
                                        </a>
                                    </div>
                                </div>

                            </td>
                        </tr>

                    </table>
                </div>
            </div>

            <div class="col-md-9">
                <div class="right-panel">
                    <div class="row p-3">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('pages.purchase_quantity')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{$product->purchaseProducts->where('branch_id', auth()->user()->employee->branch->id)->sum('quantity')}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-th fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('pages.received_from_others_branches')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{productReceivedFromOthersBranch($product->id)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('pages.sell_quantity')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{$product->sellProducts->where('branch_id', auth()->user()->employee->branch->id)->sum('quantity')}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-th fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('pages.send_to_others_branch')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{productSendToOthersBranch($product->id)}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-th fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('pages.stock_quantity')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{productAvailableTransactionStockQty($product->id)}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-th fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{__('pages.total_purchase_amount')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                @can('access_to_all_branch')
                                                    {{get_option('app_currency')}}{{number_format($product->purchaseProducts->sum('total_price'),2)}}
                                                @else
                                                    {{get_option('app_currency')}}{{number_format($product->purchaseProducts->where('branch_id', auth()->user()->employee->branch->id)->sum('total_price'),2)}}
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

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('pages.total_sell_amount')}}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                @can('access_to_all_branch')
                                                    {{get_option('app_currency')}}{{number_format($product->sellProducts->sum('total_price'),2)}}
                                                @else
                                                    {{get_option('app_currency')}}{{number_format($product->sellProducts->where('branch_id', auth()->user()->employee->branch->id)->sum('total_price'),2)}}
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

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{__('pages.current_stock_value')}} <sub>(Apx)</sub></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                @can('access_to_all_branch')
                                                    {{get_option('app_currency')}}{{number_format(($product->purchaseProducts->sum('quantity') - $product->sellProducts->sum('quantity')) * $product->sell_price,2)}}
                                                @else
                                                    {{get_option('app_currency')}}{{productAvailableTransactionStockQty($product->id) * $product->sell_price}}
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


                    <div class="row p-3">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center table-sm">
                                    <thead>
                                        <tr class="bg-secondary text-white">
                                            <th scope="col" width="4%">{{__('pages.sl')}}</th>
                                            <th scope="col">{{__('pages.branch_name')}}</th>
                                            <th scope="col">{{__('pages.stock_quantity')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @php

                                            @endphp
                                        @foreach($branches_product as $key => $branch_product)
                                            <tr>
                                                <th scope="row">{{$key + 1}}</th>
                                                <td>{{$branch_product['branch_name']}}</td>
                                                <td>
                                                    {{$branch_product['current_stock']}}

                                                    @php

                                                    @endphp
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="2" class="text-right pr-2"><b>{{__('pages.total')}}:</b></td>
                                            <td>
                                                <b>{{$product->purchaseProducts->sum('quantity') - $product->sellProducts->sum('quantity')}}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row p-3">
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade mt-5" id="barCodeQty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Barcode Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="productBarCode" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="number" name="quantity" value="1" min="1" max="500" class="form-control" placeholder="Input Barcode Quantity" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Download</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden"  id="productID" value="{{$product->id}}">
    <input type="hidden"  id="baseURL" value="{{url('/')}}">
    <!-- /.container-fluid -->
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{asset('/backend/js/partial/product.js')}}"></script>
    <script src="{{asset('/backend/js/custom.js')}}"></script>
@endsection

