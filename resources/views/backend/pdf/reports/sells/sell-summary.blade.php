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
                <h2 class="name">{{__('pages.sells_summary')}}</h2>
                <div class="address">
                    {{__('pages.filter_by')}}:- {{__('pages.branch')}}: {{$filter_by['branch_name']}},
                    {{__('pages.date_range')}}: {{$filter_by['start_date']}} to {{$filter_by['end_date']}},
                    {{__('pages.report_type')}}: {{$filter_by['duration_type']}}
                </div>
            </div>
        </div>

        @foreach($sells as $key=> $sell)
            <table class="table" width="100%" cellspacing="0">
                <thead>
                <tr class="bg-secondary text-white">
                    <th colspan="9">
                        @if(Request::get('by_duration') == 'Y-m-d' or Request::get('by_duration') == '')
                            {{\Carbon\Carbon::parse($key)->format(get_option('app_date_format'))}}
                        @else
                            {{$key}}
                        @endif
                    </th>
                </tr>
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
                    <th>{{__('pages.due_amount')}}</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total_sub_total = 0;
                    $total_discount = 0;
                    $total_grand_total_price = 0;
                    $total_paid_amount = 0;
                    $total_due_amount = 0;
                @endphp
                @foreach($sell as $key => $single_sell)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <a href="{{route('sell.show', [$single_sell->id])}}">{{$single_sell->invoice_id}}</a>
                        </td>
                        @can('access_to_all_branch')
                            <td>{{$single_sell->branch->title}}</td>
                        @endcan

                        <td>{{$single_sell->sell_date->format(get_option('app_date_format'))}}</td>
                        <td> {{get_option('app_currency')}} {{number_format($single_sell->sub_total, 2)}} </td>
                        <td> {{get_option('app_currency')}} {{number_format($single_sell->discount, 2)}} </td>
                        <td> {{get_option('app_currency')}} {{number_format($single_sell->grand_total_price, 2)}} </td>
                        <td> {{get_option('app_currency')}} {{number_format($single_sell->paid_amount, 2)}} </td>
                        <td> {{get_option('app_currency')}} {{number_format($single_sell->due_amount, 2)}} </td>
                    </tr>

                    @php
                        $total_sub_total += $single_sell->sub_total;
                        $total_discount += $single_sell->discount;
                        $total_grand_total_price += $single_sell->grand_total_price;
                        $total_paid_amount += $single_sell->paid_amount;
                        $total_due_amount += $single_sell->due_amount;
                    @endphp
                @endforeach


                <tr>
                    @can('access_to_all_branch')
                        <td colspan="4" class="text-right pr-3"><strong>{{__('pages.total')}}</strong></td>
                    @else
                        <td colspan="3" class="text-right pr-3"><strong>{{__('pages.total')}}</strong></td>
                    @endcan
                    <td><strong>{{get_option('app_currency')}} {{number_format($total_sub_total, 2)}}</strong></td>
                    <td><strong>{{get_option('app_currency')}} {{number_format($total_discount, 2)}}</strong></td>
                    <td><strong>{{get_option('app_currency')}} {{number_format($total_grand_total_price, 2)}}</strong></td>
                    <td><strong>{{get_option('app_currency')}} {{number_format($total_paid_amount, 2)}}</strong></td>
                    <td><strong>{{get_option('app_currency')}} {{number_format($total_due_amount, 2)}}</strong></td>
                </tr>
                </tbody>
            </table>
        @endforeach

    </main>
    @include('backend.pdf.layouts.footer')
</body>
</html>
