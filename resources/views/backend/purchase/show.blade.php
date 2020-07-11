@extends('backend.layouts.app')
@section('title') {{__('pages.purchase')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.purchase_details')}}</h6>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a href="{{route('purchase.edit', [$purchase->id])}}" class="btn btn-primary rounded-0"><i class="fa fa-pencil-alt"></i> {{__('pages.edit')}} </a>
                            <a href="{{url('export/purchase/print-invoice/id='.$purchase->id.'/type=pdf')}}" class="btn btn-secondary rounded-0"><i class="fa fa-file mr-2"></i> {{__('pages.pdf')}} </a>
                            <a href="{{url('export/purchase/print-invoice/id='.$purchase->id.'/type=print')}}" target="_blank" class="btn btn-warning rounded-0"><i class="fa fa-print mr-2"></i> {{__('pages.print')}} </a>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr class="bg-primary text-white text-center">
                                            <th colspan="2">{{__('pages.summary')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{__('pages.invoice_id')}}</td>
                                            <td>{{$purchase->invoice_id}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.branch')}}</td>
                                            <td>{{$purchase->branch->title}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.total_amount')}}</td>
                                            <td> {{get_option('app_currency')}}{{number_format($purchase->total_amount, 2)}} </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.paid_amount')}}</td>
                                            <td> {{get_option('app_currency')}}{{number_format($purchase->paid_amount, 2)}} </td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.due_amount')}}</td>
                                            <td> {{get_option('app_currency')}}{{number_format($purchase->due_amount, 2)}} </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr class="bg-warning text-white text-center">
                                        <th colspan="2">{{__('pages.supplier')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{__('pages.company_name')}}</td>
                                            <td>{{$purchase->supplier->company_name}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.contact_person')}}</td>
                                            <td>{{$purchase->supplier->contact_person}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.phone_number')}}</td>
                                            <td>{{$purchase->supplier->phone}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.email')}}</td>
                                            <td>{{$purchase->supplier->email}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.address')}}</td>
                                            <td>{{$purchase->supplier->address}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr>
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
                                            <td> {{get_option('app_currency')}}{{number_format($purchase_product->purchase_price, 2)}} </td>
                                            <td> {{$purchase_product->quantity}} </td>
                                            <td> {{get_option('app_currency')}}{{number_format($purchase_product->total_price, 2)}} </td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td colspan="4" class="text-right pr-5">
                                                <strong>{{__('pages.total_amount')}}: </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    {{get_option('app_currency')}}{{number_format($purchase->total_amount, 2)}}
                                                </strong>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" class="text-right pr-5">
                                                <strong>{{__('pages.paid_amount')}}: </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    {{get_option('app_currency')}}{{number_format($purchase->paid_amount, 2)}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

