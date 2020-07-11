@extends('backend.layouts.app')
@section('title') {{__('pages.sells')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.sell_details')}}</h6>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{route('sell.edit', [$sell->id])}}" class="btn btn-primary rounded-0"><i class="fa fa-pencil-alt"></i> {{__('pages.edit')}} </a>
                            <a href="{{url('export/sell/invoice/id='.encrypt($sell->id).'/type=1')}}" class="btn btn-secondary rounded-0"><i class="fa fa-download"></i> {{__('pages.pdf')}} </a>
                            <a href="{{url('export/sell/invoice/id='.encrypt($sell->id).'/type=2')}}" target="_blank" class="btn btn-warning rounded-0"><i class="fa fa-print"></i> {{__('pages.print_invoice')}} </a>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr class="bg-secondary text-white text-center">
                                        <th colspan="2">{{__('pages.customer')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{__('pages.full_name')}}</td>
                                        <td>{{$sell->customer->name}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('pages.phone_number')}}</td>
                                        <td>{{$sell->customer->phone}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('pages.email')}}</td>
                                        <td>{{$sell->customer->email}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('pages.address')}}</td>
                                        <td>{{$sell->customer->address}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr class="bg-primary text-white text-center">
                                        <th colspan="2">{{__('pages.sell_details')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr width="50px">
                                            <td>{{__('pages.invoice_id')}}</td>
                                            <td>{{$sell->invoice_id}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.branch')}}</td>
                                            <td>{{$sell->branch->title}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.sell_date')}}</td>
                                            <td>
                                                {{$sell->sell_date->format(get_option('app_date_format'))}} {{\Carbon\Carbon::parse($sell->created_at)->format('h:i:A')}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.sold_by')}}</td>
                                            <td>{{$sell->user->name}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr class="bg-secondary text-white text-center">
                                        <th colspan="2">{{__('pages.sell_summary')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr width="50px">


                                    <tr>
                                        <td>{{__('pages.sub_total')}}</td>
                                        <td>{{get_option('app_currency')}}{{number_format($sell->sub_total, 2)}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('pages.discount')}}</td>
                                        <td>{{get_option('app_currency')}}{{number_format($sell->discount, 2)}}</td>
                                    </tr>

                                    <tr>
                                        <td>{{__('pages.grand_total')}}</td>
                                        <td>{{get_option('app_currency')}}{{number_format($sell->grand_total_price, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('pages.paid_amount')}}</td>
                                        <td><strong>{{get_option('app_currency')}}{{number_format($sell->paid_amount, 2)}}</strong></td>
                                    </tr>

                                    <tr>
                                        <td>{{__('pages.due_amount')}}</td>
                                        <td class="text-danger">{{get_option('app_currency')}}{{number_format($sell->due_amount, 2)}}</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pages.sl')}}</th>
                                    <th>{{__('pages.product_title')}}</th>
                                    <th>{{__('pages.unit_price')}}</th>
                                    <th>{{__('pages.tax')}}</th>
                                    <th>{{__('pages.quantity')}}</th>
                                    <th>{{__('pages.total_trice')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sell->sellProducts as $key => $sell_product)
                                    <tr>
                                        <td width="3%">{{$key+1}}</td>
                                        <td>
                                            {{$sell_product->product->title}}
                                        </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell_product->sell_price, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell_product->tax_amount, 2)}} </td>
                                        <td> {{$sell_product->quantity}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell_product->total_price, 2)}} </td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan="5" class="text-right pr-3">
                                            {{__('pages.sub_total')}}:
                                        </td>
                                        <td>
                                            {{get_option('app_currency')}}{{number_format($sell->sub_total,2)}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5" class="text-right pr-3">
                                            {{__('pages.discount')}}:
                                        </td>
                                        <td>
                                            {{get_option('app_currency')}}{{number_format($sell->discount,2)}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5" class="text-right pr-3">
                                            {{__('pages.grand_total')}}:
                                        </td>
                                        <td>
                                            {{get_option('app_currency')}}{{number_format($sell->grand_total_price,2)}}
                                        </td>
                                    </tr>

                                <tr>
                                    <td colspan="5" class="text-right pr-3">
                                        <strong> {{__('pages.paid_amount')}}:</strong>
                                    </td>
                                    <td><strong>{{get_option('app_currency')}}{{number_format($sell->paid_amount, 2)}}</strong></td>
                                </tr>


                                <tr>
                                    <td colspan="5" class="text-right pr-3">
                                        {{__('pages.due_amount')}}:
                                    </td>
                                    <td class="text-danger">
                                        {{get_option('app_currency')}}{{number_format($sell->due_amount,2)}}
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

