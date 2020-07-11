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
                            <a href="{{url('report/stock-report')}}" class="btn btn-outline-primary {{ active_if_full_match('report/stock-report/*') }}"><i class="fas fa-money-check"></i> Stock Summary </a>
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
                                                <option value="">All Branch</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}" {{Request::get('branch_id') == $branch->id ? 'selected' : ''}}>{{$branch->title}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button class="btn btn-warning btn-block">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endcan

                        <div class="table-responsive margin-t-m5">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="2%">SL</th>
                                    <th>Product Title</th>
                                    <th width="10%">Purchase Qty</th>
                                    <th width="15%">Received From Requisition</th>
                                    <th width="10%">Sell Qty </th>
                                    <th width="15%">Send To Requisition</th>
                                    <th width="10%">Current Stock Qty</th>
                                    <th width="15%">Current Stock Amount <sub>(Apx)</sub></th>
                                </tr>
                                </thead>
                                <tbody>

                                @php
                                    $total_purchase_qty = 0;
                                    $branch_requisitions_from_qty = 0;
                                    $total_sell_qty = 0;
                                    $branch_requisitions_to_qty = 0;
                                    $total_current_stock_qty = 0;
                                    $total_current_stock_amount = 0;
                                @endphp
                                @foreach($product_requisitions as $key => $product)
                                    <tr class="@if($product['current_stock'] < 1 ) bg-danger text-white @elseif($product['current_stock'] < 20) bg-warning text-white @else  @endif">
                                        <td>{{$key+1}}</td>
                                        <td>{{$product['product_title']}} | {{$product['product_sku']}}</td>
                                        <td>{{$product['purchase_qty']}}</td>
                                        <td>{{$product['branch_requisitions_from_qty']}}</td>
                                        <td>{{$product['sell_qty']}}</td>
                                        <td>{{$product['branch_requisitions_to_qty'] }}</td>
                                        <td>
                                            {{$product['current_stock']}}
                                        </td>
                                        <td>
                                            {{$product['current_stock'] * $product['product_sell_price']}}
                                        </td>
                                    </tr>

                                    @php
                                        $total_purchase_qty += $product['purchase_qty'];
                                        $branch_requisitions_from_qty += $product['branch_requisitions_from_qty'];

                                        $total_sell_qty += $product['sell_qty'];
                                        $branch_requisitions_to_qty += $product['branch_requisitions_to_qty'];
                                        $total_current_stock_qty += $product['current_stock'];
                                        $total_current_stock_amount += $product['current_stock'] * $product['product_sell_price'];
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-right pr-3"><b>Total: </b></td>
                                    <td><b>{{$total_purchase_qty}}</b></td>
                                    <td><b>{{$branch_requisitions_from_qty}}</b></td>

                                    <td><b>{{$total_sell_qty}}</b></td>
                                    <td><b>{{$branch_requisitions_to_qty}}</b></td>

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

