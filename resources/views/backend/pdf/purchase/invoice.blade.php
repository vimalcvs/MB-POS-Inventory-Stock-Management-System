<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Purchase Invoice</title>
    @include('backend.pdf.layouts.css')
</head>
<body >
@include('backend.pdf.layouts.invoice-header')
<main>
    <div id="details" class="clearfix" style="border-bottom: 1px solid #AAAAAA">
        <div style="width: 50%;float: left">
            <p style="line-height: 1px;margin-bottom: 5px">{{__('pages.supplier_name')}}: {{$purchase->supplier->company_name}}</p>
            <p style="margin-top: 0px">{{__('pages.phone_number')}}: {{$purchase->supplier->phone}}</p>
        </div>

        <div style="width: 50%;float: left;text-align: right">
            <p style="line-height: 1px;margin-bottom: 5px">{{__('pages.invoice_id')}}: {{$purchase->invoice_id}}</p>
            <p style="margin-top: 0px">{{__('pages.date')}}: {{\Carbon\Carbon::parse($purchase->purchase_date)->format(get_option('app_date_format'))}} {{\Carbon\Carbon::parse($purchase->created_at)->format('h:i A')}}</p>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table" width="100%" cellspacing="0">
            <thead>
            <tr class="bg-secondary text-white">
                <th>{{__('pages.sl')}}</th>
                <th>{{__('pages.product')}}</th>
                <th>{{__('pages.unit_price')}}</th>
                <th>{{__('pages.quantity')}}</th>
                <th>{{__('pages.total_price')}}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($purchase->purchaseProducts as $key => $purchase_product)
                    <tr>
                        <td width="3%">{{$key+1}}</td>
                        <td>{{$purchase_product->product->title}}</td>
                        <td> {{get_option('app_currency')}} {{number_format($purchase_product->purchase_price, 2)}} </td>
                        <td> {{$purchase_product->quantity}} </td>
                        <td> {{get_option('app_currency')}} {{number_format($purchase_product->total_price, 2)}} </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right pr-5">
                        <strong>{{__('pages.total_amount')}}: </strong>
                    </td>
                    <td>
                        <strong>
                            {{get_option('app_currency')}} {{number_format($purchase->total_amount, 2)}}
                        </strong>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" class="text-right pr-5">
                        <strong>{{__('pages.paid_amount')}}: </strong>
                    </td>
                    <td>
                        <strong>
                            {{get_option('app_currency')}} {{number_format($purchase->paid_amount, 2)}}
                        </strong>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" class="text-right pr-5">
                        <strong>{{__('pages.due_amount')}}: </strong>
                    </td>
                    <td>
                        <strong>
                            {{get_option('app_currency')}}{{number_format($purchase->due_amount, 2)}}
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
@include('backend.pdf.layouts.footer')
</body>
</html>
