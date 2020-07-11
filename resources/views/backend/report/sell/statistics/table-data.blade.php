<table class="table table-bordered mb-5 mt-5 w-75 text-center m-0-auto-mb-pos"  >
    <thead>
        <tr class="bg-secondary text-white">
            <th scope="col">{{__('pages.sl')}}</th>
            <th scope="col">{{__('pages.date')}}</th>
            @can('access_to_all_branch')
                <th>{{__('pages.branch')}}</th>
            @endcan
            <th scope="col">{{__('pages.total_amount')}}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $grand_total_amount = 0;
        @endphp
        @for($d=0; $d < count($sell_info); $d++)
            <tr>
                <th scope="row">{{$d + 1}}</th>
                <td>
                    @if(Request::get('year')){{Request::get('year')}} ,@endif

                    @if(Request::get('search_type') != 'year')
                        {{\Carbon\Carbon::parse($sell_info[$d]['sell_date'])->format(get_option('app_date_format'))}}
                    @else
                        {{ $sell_info[$d]['sell_date']}}
                    @endif

                </td>
                @can('access_to_all_branch')
                <td>
                    @if(Request::get('branch_id'))
                        {{\App\Models\Branch::findOrFail(Request::get('branch_id'))->title}}
                    @else
                        All
                    @endif
                </td>
                @endcan
                <td>{{get_option('app_currency')}}{{number_format($sell_info[$d]['total_sell_amount'], 2)}}</td>
                @php
                    $grand_total_amount += $sell_info[$d]['total_sell_amount'];
                @endphp
            </tr>
        @endfor
        <tr>
            @can('access_to_all_branch')
                <td colspan="3" class="text-right pr-2"><strong>{{__('pages.grand_total')}}</strong></td>
            @else
                <td colspan="2" class="text-right pr-2"><strong>{{__('pages.grand_total')}}</strong></td>
            @endcan

            <td><strong>{{get_option('app_currency')}}{{number_format($grand_total_amount, 2)}}</strong></td>
        </tr>
    </tbody>
</table>
