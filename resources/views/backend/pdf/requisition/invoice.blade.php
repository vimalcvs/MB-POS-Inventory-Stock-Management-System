<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Requisition</title>
    @include('backend.pdf.layouts.css')
</head>
<body >
@include('backend.pdf.layouts.invoice-header')
<main>

    <div>
        <table class="table" width="100%" style="border: none">
            <tr>
                <td style="border: none">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="2">{{__('pages.requisition_form')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td  style="text-align: left">{{__('pages.branch')}}</td>
                            <td  style="text-align: left">{{$requisition->requisitionFrom->title}}</td>
                        </tr>

                        <tr>
                            <td style="text-align: left">{{__('pages.phone_number')}}</td>
                            <td style="text-align: left">{{$requisition->requisitionFrom->phone}}</td>
                        </tr>

                        <tr>
                            <td  style="text-align: left">{{__('pages.address')}}</td>
                            <td  style="text-align: left">{{$requisition->requisitionFrom->address}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td style="border: none">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="2">{{__('pages.requisition_to')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td  style="text-align: left">{{__('pages.branch')}}</td>
                            <td  style="text-align: left">{{$requisition->requisitionTo->title}}</td>
                        </tr>

                        <tr>
                            <td  style="text-align: left">{{__('pages.phone_number')}}</td>
                            <td  style="text-align: left">{{$requisition->requisitionTo->phone}}</td>
                        </tr>

                        <tr>
                            <td style="text-align: left">{{__('pages.address')}}</td>
                            <td style="text-align: left">{{$requisition->requisitionTo->address}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td style="border: none">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="2">{{__('pages.requisition_summary')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td  style="text-align: left">{{__('pages.requisition_id')}}</td>
                            <td  style="text-align: left">{{$requisition->requisition_id}}</td>
                        </tr>

                        @if($requisition->status == 2 )
                            <tr>
                                <td style="text-align: left">{{__('pages.transfer_date')}}</td>
                                <td style="text-align: left">{{$requisition->complete_date->format(get_option('app_date_format'))}}</td>
                            </tr>
                        @else
                            <tr>
                                <td style="text-align: left">{{__('pages.created_date')}}</td>
                                <td style="text-align: left">{{$requisition->requisition_date->format(get_option('app_date_format'))}}</td>
                            </tr>
                        @endif

                        <tr>
                            <td  style="text-align: left">{{__('pages.status')}}</td>
                            <td class="p-0" style="text-align: left">
                                @if($requisition->status == 0)
                                    <label class="btn btn-warning btn-sm btn-block m-0"><b>{{__('pages.pending')}}</b></label>
                                @elseif($requisition->status == 1)
                                    <label class="btn btn-info btn-sm btn-block m-0"><b>{{__('pages.delivered')}}</b></label>
                                @elseif($requisition->status == 2)
                                    <label class="btn btn-success btn-sm btn-block m-0"><b>{{__('pages.complete')}}</b></label>
                                @elseif($requisition->status == 3)
                                    <label class="btn btn-danger btn-sm btn-block m-0"><b>{{__('pages.rejected')}}</b></label>
                                @else
                                    <label class="btn btn-danger btn-sm btn-block m-0"><b>{{__('pages.canceled')}}</b></label>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

        </table>
    </div>


    <div class="table-responsive">
        <table class="table" width="100%" cellspacing="0">
            <thead>
                <tr class="bg-secondary text-white">
                    <th>{{__('pages.sl')}}</th>
                    <th>{{__('pages.product')}}</th>
                    <th>{{__('pages.quantity')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requisition->requisitionProducts as $key => $requisition_product)
                    <tr>
                        <td width="3%">{{$key+1}}</td>
                        <td>{{$requisition_product->product->title}}</td>
                        <td> {{$requisition_product->quantity}} </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="text-right pr-3">
                       <b> {{__('pages.total')}}:</b>
                    </td>
                    <td>
                      <b> {{$requisition->requisitionProducts->sum('quantity')}}</b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



</main>
@include('backend.pdf.layouts.footer')
</body>
</html>
