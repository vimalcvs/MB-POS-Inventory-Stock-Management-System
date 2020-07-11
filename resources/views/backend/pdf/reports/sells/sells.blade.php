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
            <h2 class="name">Sells Report</h2>
            <div class="address">
                {{__('pages.filter_by')}}:- {{__('pages.branch')}}: {{$filter_by['branch_name']}},
                {{__('pages.date_range')}}: {{$filter_by['start_date']}} to {{$filter_by['end_date']}},
            </div>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
        <thead>
            <tr class="bg-secondary text-white">
                <th>{{__('pages.sl')}}</th>
                <th>{{__('pages.invoice_id')}}</th>
                @can('access_to_all_branch')
                    <th>{{__('pages.branch')}}</th>
                @endcan
                <th width="10%">{{__('pages.sell_date')}}</th>
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
                    <td> {{get_option('app_currency')}} {{number_format($sell->sub_total, 2)}} </td>
                    <td> {{get_option('app_currency')}} {{number_format($sell->discount, 2)}} </td>
                    <td> {{get_option('app_currency')}} {{number_format($sell->grand_total_price, 2)}} </td>
                    <td> {{get_option('app_currency')}} {{number_format($sell->paid_amount, 2)}} </td>
                </tr>
            @endforeach
            <tr>
                @can('access_to_all_branch')
                    <td colspan="4" class="text-right"><strong>{{__('pages.total')}}</strong></td>
                @else
                    <td colspan="3" class="text-right"><strong>{{__('pages.total')}}</strong></td>
                @endcan
                <td> <strong>{{get_option('app_currency')}} {{number_format($sells->sum('sub_total'), 2)}}</strong>  </td>
                <td> <strong>{{get_option('app_currency')}} {{number_format($sell->sum('discount'), 2)}}</strong> </td>
                <td> <strong>{{get_option('app_currency')}} {{number_format($sell->sum('grand_total_price'), 2)}}</strong> </td>
                <td> <strong>{{get_option('app_currency')}} {{number_format($sell->sum('paid_amount'), 2)}}</strong> </td>
            </tr>
        </tbody>
    </table>


</main>
@include('backend.pdf.layouts.footer')
</body>
</html>
