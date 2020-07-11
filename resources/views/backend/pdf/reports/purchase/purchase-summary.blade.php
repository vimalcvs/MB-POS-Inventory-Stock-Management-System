<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Purchase Report</title>
    @include('backend.pdf.layouts.css')
</head>
<body >
@include('backend.pdf.layouts.report-header')
<main>
    <div id="details" class="clearfix">
        <div id="client"class="mt-10">
            <h2 class="name">{{__('pages.purchase_summary')}}</h2>
            <div class="address">
                {{__('pages.filter_by')}}:- {{__('pages.branch')}}: {{$filter_by['branch_name']}},
                {{__('pages.supplier')}}: {{$filter_by['supplier_name']}},
                {{__('pages.date_range')}}: {{$filter_by['start_date']}} to {{$filter_by['end_date']}},
                {{__('pages.report_type')}}: {{$filter_by['duration_type']}}
            </div>
        </div>
    </div>

    @foreach($purchases as $key=> $purchase)
        <table class="table" width="100%" cellspacing="0">
            <thead>
            <tr class="bg-secondary text-white">
                <th colspan="8">{{$key}}</th>
            </tr>
            <tr class="bg-secondary text-white">
                <th>{{__('pages.sl')}}</th>
                <th>{{__('pages.invoice_id')}}</th>
                @can('access_to_all_branch')
                    <th>{{__('pages.branch')}}</th>
                @endcan
                <th>{{__('pages.supplier')}}</th>
                <th>{{__('pages.purchase_date')}}</th>
                <th>{{__('pages.total_amount')}}</th>
                <th>{{__('pages.paid_amount')}}</th>
                <th>{{__('pages.due_amount')}}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $total_grand_total_amount = 0;
                $total_paid_amount = 0;
                $total_due_amount = 0;
            @endphp
            @foreach($purchase as $key => $single_purchase)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>
                        <a href="{{route('purchase.show', [$single_purchase->id])}}">{{$single_purchase->invoice_id}}</a>
                    </td>
                    @can('access_to_all_branch')
                    <td>{{$single_purchase->branch->title}}</td>
                    @endcan
                    <td>{{$single_purchase->supplier->company_name}}</td>
                    <td>{{$single_purchase->purchase_date->format(get_option('app_date_format'))}}</td>
                    <td> {{get_option('app_currency')}}  {{number_format($single_purchase->total_amount, 2)}} </td>
                    <td> {{get_option('app_currency')}}  {{number_format($single_purchase->paid_amount, 2)}} </td>
                    <td> {{get_option('app_currency')}}  {{number_format($single_purchase->due_amount, 2)}} </td>
                </tr>

                @php
                    $total_grand_total_amount += $single_purchase->total_amount;
                    $total_paid_amount += $single_purchase->paid_amount;
                    $total_due_amount += $single_purchase->due_amount;
                @endphp
            @endforeach


            <tr>
                @can('access_to_all_branch')
                    <td colspan="5" class="text-right pr-3"><strong>{{__('pages.total')}}</strong></td>
                @else
                    <td colspan="4" class="text-right pr-3"><strong>{{__('pages.total')}}</strong></td>
                @endcan
                <td><strong>{{get_option('app_currency')}} {{number_format($total_grand_total_amount, 2)}}</strong></td>
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
