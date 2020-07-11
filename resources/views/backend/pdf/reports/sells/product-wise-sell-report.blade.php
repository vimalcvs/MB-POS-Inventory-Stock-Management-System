<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sells Report</title>
    @include('backend.pdf.layouts.css')
</head>
<body >
@include('backend.pdf.layouts.report-header')
<main>
    <div id="details" class="clearfix">
        <div id="client"class="mt-10">
            <h2 class="name">{{__('pages.sells_report')}}</h2>
            <div class="address">
                {{__('pages.filter_by')}}:- {{__('pages.branch')}}: {{$filter_by['branch_name']}},
                {{__('pages.product')}}: {{$filter_by['product_name']}} ,
                {{__('pages.date_range')}}: {{$filter_by['start_date']}} to {{$filter_by['end_date']}},
            </div>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
        <thead>
        <tr class="bg-secondary text-white">
            <th>{{__('pages.sl')}}</th>
            <th>{{__('pages.product')}}</th>
            <th>{{__('pages.sell_price')}}</th>
            <th>{{__('pages.quantity')}}</th>
            <th>{{__('pages.total_sell_price')}}</th>
        </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
                $total_sell_price = 0;
                $total_quantity = 0;
                $grand_total_price = 0;
            @endphp
            @foreach($sell_products as $key => $sell_product)
                <tr>
                    <td>{{$i}}</td>
                    <td>
                        <a href="{{route('product.show', [$key])}}">
                            {{$sell_product[0]->product->title}}
                        </a>
                    </td>
                    <td>{{get_option('app_currency')}} {{$sell_product->sum('sell_price')}}</td>
                    <td>{{$sell_product->sum('quantity')}}</td>
                    <td>{{get_option('app_currency')}} {{$sell_product->sum('total_price')}}</td>
                </tr>
                @php
                    $i ++;
                    $total_sell_price +=  $sell_product->sum('sell_price');
                    $total_quantity +=  $sell_product->sum('quantity');
                    $grand_total_price +=  $sell_product->sum('total_price');
                @endphp
            @endforeach

            <tr>
                <td colspan="2" class="text-right">{{__('pages.total')}}</td>
                <td><strong>{{get_option('app_currency')}} {{number_format($total_sell_price, 2)}}</strong></td>
                <td><strong>{{$total_quantity}}</strong></td>
                <td><strong>{{get_option('app_currency')}} {{number_format($grand_total_price, 2)}}</strong></td>
            </tr>
        </tbody>
    </table>


</main>
@include('backend.pdf.layouts.footer')
</body>
</html>
