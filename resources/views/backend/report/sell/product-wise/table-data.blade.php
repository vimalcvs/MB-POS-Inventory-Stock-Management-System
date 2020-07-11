<table class="table table-bordered text-center" width="100%" cellspacing="0">
    <thead>
    <tr class="bg-secondary text-white">
        <th>{{__('pages.sl')}}</th>
        <th>{{__('pages.product')}}</th>
        <th>{{__('pages.quantity')}}</th>
        <th>{{__('pages.total_price')}}</th>
    </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
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
                <td>{{$sell_product->sum('quantity')}}</td>
                <td>{{get_option('app_currency')}}{{$sell_product->sum('total_price')}}</td>
            </tr>
            @php
                $i ++;
                $total_quantity +=  $sell_product->sum('quantity');
                $grand_total_price +=  $sell_product->sum('total_price');
            @endphp
        @endforeach

        <tr>
            <td colspan="2" class="text-right"><b>{{__('pages.total')}} :</b></td>
            <td><strong>{{$total_quantity}}</strong></td>
            <td><strong>{{get_option('app_currency')}}{{number_format($grand_total_price, 2)}}</strong></td>
        </tr>
    </tbody>
</table>
