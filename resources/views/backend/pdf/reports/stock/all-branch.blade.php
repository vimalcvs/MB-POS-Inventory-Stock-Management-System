<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Stock Report</title>
    @include('backend.pdf.layouts.css')
</head>
<body >
@include('backend.pdf.layouts.report-header')
<main>
    <div id="details" class="clearfix">
        <div id="client"class="mt-10">
            <h2 class="name">{{__('pages.stock_report')}}</h2>
            <div class="address">
                @can('access_to_all_branch')
                    {{__('pages.branch')}}: {{__('pages.all_branch')}},
                @else
                    {{__('pages.branch')}}: {{auth()->user()->employee->branch->title}},
                @endcan
                    {{__('pages.date')}}: {{\Carbon\Carbon::now()->format(get_option('app_date_format'))}}
            </div>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
        <thead>
        <tr class="bg-secondary text-white">
            <th width="2%">{{__('pages.sl')}}</th>
            <th width="25%">{{__('pages.product_title')}}</th>
            <th width="5%">{{__('pages.purchase_qty')}}</th>
            <th width="5%">{{__('pages.sell_qty')}} </th>
            <th width="5%">{{__('pages.current_stock_qty')}}</th>
            <th width="18%">{{__('pages.current_stock_amount')}} <sub>(Apx)</sub></th>
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
            <tr>
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
                    @can('access_to_all_branch')
                        @php
                            $current_stock_qty = $product->purchaseProducts->sum('quantity') - $product->sellProducts->sum('quantity');
                        @endphp
                    @else
                        @php
                            $current_stock_qty =  productAvailableTransactionStockQty($product->id)
                        @endphp
                    @endcan

                    {{$current_stock_qty}}
                </td>
                <td>
                    @php
                        $product_tax = $product->sell_price * $product->tax->value / 100;
                        $current_stock_amount = $current_stock_qty * ($product->sell_price + $product_tax);
                    @endphp

                    {{get_option('app_currency')}} {{number_format($current_stock_amount,2)}}
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
            <td colspan="2" class="text-right pr-3"><b>{{__('pages.total')}}: </b></td>
            <td><b>{{$total_purchase_qty}}</b></td>
            <td><b>{{$total_sell_qty}}</b></td>
            <td><b>{{$total_current_stock_qty}}</b></td>
            <td><b>{{get_option('app_currency')}} {{number_format($total_current_stock_amount,2)}}</b></td>
        </tr>
        </tbody>
    </table>


</main>
@include('backend.pdf.layouts.footer')
</body>
</html>
