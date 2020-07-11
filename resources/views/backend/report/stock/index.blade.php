@extends('backend.layouts.app')
@section('title') Stock Report @endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid settings-page">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 rounded-0">
                <!-- Card Header - Dropdown -->
                <div class="card-header p-0">
                    <div class="btn-group btn-group-justified nav-buttons" role="group" aria-label="Basic example">
                        <a href="{{url('report/stock-report')}}" class="btn btn-outline-primary {{ active_if_full_match('report/stock-report') }}"><i class="fas fa-money-check"></i> Stock Summary </a>
                    </div>

                    <div class="btn-group btn-group-sm filter-pdf-btn" role="group">
                        <form action="{{url('report/stock-report-pdf')}}" method="get">
                            <input type="hidden" name="action_type" value="download">
                            <button type="submit" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> {{__('pages.pdf')}} </button>
                        </form>

                        <form action="{{url('report/stock-report-pdf')}}" method="get" target="_blank">
                            <input type="hidden" name="action_type" value="print">
                            <button type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> {{__('pages.print')}} </button>
                        </form>

                        <form action="{{url('report/stock-report-pdf')}}" method="get">
                            <input type="hidden" name="action_type" value="csv">
                            <button type="submit" class="btn btn-secondary btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-file-csv mr-2"></i> {{__('pages.csv')}} </button>
                        </form>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body p-0">
                    @can('access_to_all_branch')
                    <form action="{{url('report/stock-report/filter')}}" method="get">
                        <div class="row pt-2 ml-0 mr-0 bg-primary">
                            <div class="col-md-4 pr-0">
                                <div class="form-group text-left">
                                    <select name="branch_id" class="form-control select2">
                                        <option value="">{{__('pages.all_branch')}}</option>
                                        @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-warning btn-block">{{__('pages.search')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endcan

                    <div class="table-responsive margin-t-m5" @can('access_to_all_branch') @endcan>
                        <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="2%">{{__('pages.sl')}}</th>
                                    <th>{{__('pages.product')}}</th>
                                    <th width="15%">{{__('pages.purchase')}} {{__('pages.quantity')}}</th>
                                    <th width="15%">{{__('pages.sells')}} {{__('pages.quantity')}}</th>
                                    <th width="15%">{{__('pages.current_stock_quantity')}}</th>
                                    <th width="15%">{{__('pages.current_stock_value')}} <sub>({{__('pages.apx')}})</sub></th>
                                </tr>
                            </thead>
                            <tbody>

                            @php
                                $total_purchase_qty = 0;
                                $total_sell_qty = 0;
                                $total_current_stock_qty = 0;
                                $total_current_stock_amount = 0;
                            @endphp
                            @foreach($products as $key => $product)
                                @can('access_to_all_branch')
                                    @php
                                        $current_stock_qty = $product->purchaseProducts->sum('quantity') - $product->sellProducts->sum('quantity');
                                    @endphp
                                @else
                                    @php
                                        $current_stock_qty =  productAvailableTransactionStockQty($product->id)
                                    @endphp
                                @endcan


                                <tr class="@if($current_stock_qty < 1 ) bg-danger text-white @elseif($current_stock_qty < 20) bg-warning text-white @else  @endif">
                                    <td>{{$key+1}}</td>
                                    <td>{{$product->title}} | {{$product->sku}}</td>
                                    <td>
                                        @can('access_to_all_branch')
                                            {{$product->purchaseProducts->sum('quantity')}}
                                        @else
                                            {{$product->purchaseProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity')}}
                                        @endcan
                                    </td>

                                    <td>
                                        @can('access_to_all_branch')
                                            {{$product->sellProducts->sum('quantity')}}
                                        @else
                                            {{$product->sellProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity')}}
                                        @endcan
                                    </td>

                                    <td>
                                        {{$current_stock_qty}}
                                    </td>
                                    <td>
                                        @php
                                            $product_tax = $product->sell_price * $product->tax->value / 100;
                                            $current_stock_amount = $current_stock_qty * ($product->sell_price + $product_tax);
                                        @endphp

                                        {{get_option('app_currency')}}{{number_format($current_stock_amount,2)}}
                                    </td>
                                </tr>



                                @can('access_to_all_branch')
                                    @php
                                        $total_purchase_qty += $product->purchaseProducts->sum('quantity');
                                        $total_sell_qty += $product->sellProducts->sum('quantity');
                                    @endphp
                                @else
                                    @php
                                        $total_purchase_qty += $product->purchaseProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity');
                                        $total_sell_qty += $product->sellProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity');
                                    @endphp
                                @endcan


                                @php
                                   $total_current_stock_qty += $current_stock_qty;
                                   $total_current_stock_amount += $current_stock_amount;
                                @endphp
                            @endforeach
                                <tr>
                                    <td colspan="2" class="text-right pr-3"><b>Total: </b></td>
                                    <td><b>{{$total_purchase_qty}}</b></td>


                                    <td><b>{{$total_sell_qty}}</b></td>


                                    <td><b>{{$total_current_stock_qty}}</b></td>
                                    <td><b>{{get_option('app_currency')}}{{number_format($total_current_stock_amount,2)}}</b></td>
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

