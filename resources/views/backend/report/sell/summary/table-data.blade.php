@foreach($sells as $key=> $sell)
    <table class="table table-bordered text-center" width="100%" cellspacing="0">
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

            @if(Request::get('by_duration') != 'Y-m-d')
            <th>{{__('pages.sell_date')}}</th>
            @endif

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
                    <a href="{{route('sell.show', [$single_sell->id])}}" target="_blank">{{$single_sell->invoice_id}}</a>
                </td>
                @can('access_to_all_branch')
                    <td>{{$single_sell->branch->title}}</td>
                @endcan

                @if(Request::get('by_duration') != 'Y-m-d')
                <td>{{$single_sell->sell_date->format(get_option('app_date_format'))}}</td>
                @endif

                <td> {{get_option('app_currency')}}{{number_format($single_sell->sub_total, 2)}} </td>
                <td> {{get_option('app_currency')}}{{number_format($single_sell->discount, 2)}} </td>
                <td> {{get_option('app_currency')}}{{number_format($single_sell->grand_total_price, 2)}} </td>
                <td> {{get_option('app_currency')}}{{number_format($single_sell->paid_amount, 2)}} </td>
                <td> {{get_option('app_currency')}}{{number_format($single_sell->due_amount, 2)}} </td>
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
                <td colspan="{{Request::get('by_duration') == 'Y-m-d' ? 3 : 4}}" class="text-right pr-3"><strong>Total</strong></td>
            @else
                <td colspan="{{Request::get('by_duration') == 'Y-m-d' ? 2 : 3}}" class="text-right pr-3"><strong>Total</strong></td>
            @endcan
            <td><strong>{{get_option('app_currency')}}{{number_format($total_sub_total, 2)}}</strong></td>
            <td><strong>{{get_option('app_currency')}}{{number_format($total_discount, 2)}}</strong></td>
            <td><strong>{{get_option('app_currency')}}{{number_format($total_grand_total_price, 2)}}</strong></td>
            <td><strong>{{get_option('app_currency')}}{{number_format($total_paid_amount, 2)}}</strong></td>
            <td><strong>{{get_option('app_currency')}}{{number_format($total_due_amount, 2)}}</strong></td>
        </tr>
        </tbody>
    </table>
@endforeach
