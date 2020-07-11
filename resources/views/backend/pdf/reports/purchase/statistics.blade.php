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
            <h2 class="name">{{__('pages.purchase_statistics')}}</h2>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
            <thead>
                <tr class="bg-secondary text-white">
                    <th scope="col">#</th>
                    <th scope="col">{{__('pages.data_title')}}</th>
                    @can('access_to_all_branch')
                    <th scope="col">{{__('pages.branch')}}</th>
                    @endcan
                    <th scope="col">{{__('pages.total_amount')}}</th>
                </tr>
            </thead>
            <tbody>
                `@php
                    $grand_total_amount = 0;
                @endphp
                @for($d=0; $d < count($purchase_info); $d++)
                    <tr>
                        <th scope="row">{{$d + 1}}</th>
                        <td>
                            @if(Request::get('year')){{Request::get('year')}} ,@endif
                                @if(Request::get('search_type') != 'year')
                                    {{\Carbon\Carbon::parse($purchase_info[$d]['purchase_date'])->format(get_option('app_date_format'))}}
                                @else
                                    {{$purchase_info[$d]['purchase_date']}}
                                @endif
                        </td>
                        @can('access_to_all_branch')
                        <td>
                            @if(Request::get('branch_id'))
                                {{\App\Models\Branch::findOrFail(Request::get('branch_id'))->title}}
                            @else
                                {{__('pages.all_branch')}}
                            @endif
                        </td>
                        @endcan
                        <td>{{get_option('app_currency')}} {{number_format($purchase_info[$d]['total_purchase_amount'], 2)}}</td>
                        @php
                            $grand_total_amount += $purchase_info[$d]['total_purchase_amount'];
                        @endphp
                    </tr>
                @endfor
                <tr>
                    @can('access_to_all_branch')
                        <td colspan="3"><strong>{{__('pages.grand_total')}}</strong></td>
                    @else
                        <td colspan="2"><strong>{{__('pages.grand_total')}}</strong></td>
                    @endcan
                    <td><strong>{{get_option('app_currency')}} {{number_format($grand_total_amount, 2)}}</strong></td>
                </tr>
            </tbody>
        </table>


</main>
@include('backend.pdf.layouts.footer')
</body>
</html>
