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
            $total_purchase_price = 0;
            $total_quantity = 0;
            $grand_total_price = 0;
        @endphp
        @foreach($purchase_products as $key => $purchase_product)
            <tr>
                <td>{{$i}}</td>
                <td>
                    <a href="{{route('product.show', [$key])}}">
                        {{$purchase_product[0]->product->title}}
                    </a>
                </td>
                <td>{{$purchase_product->sum('quantity')}}</td>
                <td>{{get_option('app_currency')}} {{number_format($purchase_product->sum('total_price'),2)}}</td>
            </tr>
            @php
                $i ++;
                $total_purchase_price +=  $purchase_product->sum('purchase_price');
                $total_quantity +=  $purchase_product->sum('quantity');
                $grand_total_price +=  $purchase_product->sum('total_price');
            @endphp
        @endforeach

        <tr>
            <td colspan="2" class="text-right"><strong>{{__('pages.total')}}</strong></td>
            <td><strong>{{$total_quantity}}</strong></td>
            <td><strong>{{get_option('app_currency')}}{{number_format($grand_total_price, 2)}}</strong></td>
        </tr>
    </tbody>
</table>
