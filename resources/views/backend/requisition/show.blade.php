@extends('backend.layouts.app')
@section('title') {{__('pages.requisition')}}  @endsection
@section('content')

    @if($requisition->status == 0 && $requisition->requisition_from != auth()->user()->employee->branch_id)
        <div id="app">
            <show-requisition :requisition="{{ $requisition }}"></show-requisition>
        </div>
    @else
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 rounded-0">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{__('pages.requisition_details')}}</h6>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                @if($requisition->requisition_from == auth()->user()->employee->branch_id && $requisition->status == 0)
                                    <a href="{{route('requisition.edit', [$requisition->id])}}" class="btn btn-primary rounded-0"><i class="fa fa-pencil-alt"></i> Edit </a>
                                @endif
                                <a href="{{url('/export/requisition/print-invoice/id='.$requisition->id.'/type={print}')}}" target="_blank" class="btn btn-warning rounded-0"><i class="fa fa-print"></i> Print </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr class="bg-secondary text-white text-center">
                                                <th colspan="2">{{__('pages.requisition_form')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{__('pages.branch')}}</td>
                                            <td>{{$requisition->requisitionFrom->title}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.phone_number')}}</td>
                                            <td>{{$requisition->requisitionFrom->phone}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.address')}}</td>
                                            <td>{{$requisition->requisitionFrom->address}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                        <tr class="bg-secondary text-white text-center">
                                            <th colspan="2">{{__('pages.requisition_to')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{__('pages.branch')}}</td>
                                            <td>{{$requisition->requisitionTo->title}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.phone_number')}}</td>
                                            <td>{{$requisition->requisitionTo->phone}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{__('pages.address')}}</td>
                                            <td>{{$requisition->requisitionTo->address}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                        <tr class="bg-secondary text-white text-center">
                                            <th colspan="2">{{__('pages.requisition_summary')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{__('pages.requisition_id')}}</td>
                                            <td>{{$requisition->requisition_id}}</td>
                                        </tr>

                                        @if($requisition->status == 2 )
                                            <tr>
                                                <td>{{__('pages.transfer_date')}}</td>
                                                <td>{{$requisition->complete_date->format(get_option('app_date_format'))}}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{__('pages.created_date')}}</td>
                                                <td>{{$requisition->requisition_date->format(get_option('app_date_format'))}}</td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td>Status</td>
                                            <td class="p-0">
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
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
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
                                        <td colspan="2" class="text-right pr-5">
                                            <strong>{{__('pages.total')}}:</strong>
                                        </td>

                                        <td>
                                            <strong>{{$requisition->requisitionProducts->sum('quantity')}}</strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                @if($requisition->requisition_from == auth()->user()->employee->branch_id && $requisition->status == 1)
                                    <a href="{{route('requisition-received', [$requisition->id])}}" class="btn btn-primary rounded-0 btn-block" onclick="return confirm('Are you sure. you want to receive this requisition ? ')"> Received </a>
                                @endif

                                @if($requisition->requisition_from == auth()->user()->employee->branch_id && $requisition->status < 2)
                                    <a href="{{route('requisition-canceled', [$requisition->id])}}" class="btn btn-danger rounded-0 btn-block" onclick="return confirm('Are you sure. you want to cancel this requisition ?')"> Cancel </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


