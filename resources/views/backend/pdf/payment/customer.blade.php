<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Payment From Customer</title>
    @include('backend.pdf.layouts.css')
</head>
<body >
@include('backend.pdf.layouts.report-header')
<main>
    <div id="details" class="clearfix">
        <div id="client"class="mt-10">
            <h2 class="name">{{__('pages.payment_from_customer')}}</h2>
            <div class="address">
                {{__('pages.filter_by')}}:- Branch: {{$filter_by['branch_name']}},
                {{__('pages.customer')}}: {{$filter_by['customer_name']}},
                {{__('pages.date_range')}}: {{$filter_by['start_date']}} to {{$filter_by['end_date']}}
            </div>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
        <thead>
        <tr class="bg-secondary text-white">
            <th width="3%">{{__('pages.sl')}}</th>
            @can('access_to_all_branch')
                <th width="20%">{{__('pages.branch')}}</th>
            @endcan
            <th width="20%">{{__('pages.customer')}}</th>
            <th >{{__('pages.date')}}</th>
            <th>{{__('pages.amount')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $key => $payment)
            <tr>
                <td>{{$key+1}}</td>
                @can('access_to_all_branch')
                    <td> {{$payment->branch->title}}</td>
                @endcan
                <td>{{$payment->customer ? $payment->customer->name : '--'}} </td>
                <td>{{$payment->payment_date->format(get_option('app_date_format'))}}</td>
                <td> {{get_option('app_currency')}} {{number_format($payment->amount, 2)}} </td>
            </tr>
        @endforeach
        <tr>
            @can('access_to_all_branch')
                <td colspan="4" class="text-right pr-3"><b>{{__('pages.total_amount')}}</b></td>
            @else
                <td colspan="3" class="text-right pr-3"><b>{{__('pages.total_amount')}}</b></td>
            @endif
            <td><b>{{get_option('app_currency')}} {{number_format($payments->sum('amount'), 2)}}</b></td>
        </tr>
        </tbody>
    </table>


</main>
@include('backend.pdf.layouts.footer')
</body>
</html>
