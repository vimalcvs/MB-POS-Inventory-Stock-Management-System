@extends('backend.layouts.app')
@section('title') {{__('pages.payment')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header">
                        <div class="row margin-b-m15">
                            <div class="col-md-8 text-right">
                                @include('backend.payment.customer.filter-from')
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th>{{__('pages.sl')}}</th>
                                        <th>{{__('pages.invoice_id')}}</th>
                                        <th>{{__('pages.customer')}}</th>
                                        <th>{{__('pages.sell_date')}}</th>
                                        <th>{{__('pages.sub_total')}}</th>
                                        <th>{{__('pages.discount')}}</th>
                                        <th>{{__('pages.grand_total')}}</th>
                                        <th>{{__('pages.paid_amount')}}</th>
                                        <th>{{__('pages.due_amount')}}</th>
                                        <th width="8%">{{__('pages.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($due_sells as $key => $sell)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$sell->invoice_id}}</td>
                                        <td>{{$sell->customer->name}}</td>
                                        <td>{{$sell->sell_date->format(get_option('app_date_format'))}}</td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->sub_total, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->discount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->grand_total_price, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->paid_amount, 2)}} </td>
                                        <td> {{get_option('app_currency')}}{{number_format($sell->due_amount, 2)}} </td>

                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm mr-2 show-payment-details-for-customer" data-sell-id="{{$sell->id}}" data-due-amount="{{$sell->due_amount}}">Pay Now </a>
                                            </div>
                                        </td>
                                    </tr>


                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$due_sells->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


    <div class="drawer d-none shadow right payment-details-drawer w-500"id="paymentDrawer">
        <button class="btn btn-primary btn-close drawer-close-btn-for-customer" >x</button>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{__('pages.payment')}}</h6>
            </div>
            <div class="card-body pt-4">
                <form action="{{route('payment-from-customer.store')}}" method="post" data-parsley-validate>
                    @csrf

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="row">
                               <input type="hidden" name="sell_id" id="sell_id">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="payment_date">{{__('pages.payment_date')}} <span class="text-danger">*</span></label>
                                        <input name="payment_date" value="{{old('payment_date') ? old('payment_date') : \Carbon\Carbon::now()->format('Y-m-d')}}" id="payment_date" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.date')}}" required autocomplete="off">
                                        @if ($errors->has('payment_date'))
                                            <div class="error">{{ $errors->first('payment_date') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="amount">{{__('pages.amount')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="amount" id="amount" step=".1" min="0"  placeholder="{{__('pages.amount')}}" class="form-control" aria-describedby="emailHelp" required>
                                        @if ($errors->has('amount'))
                                            <div class="error">{{ $errors->first('amount') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note">{{__('pages.note')}}</label>
                                        <textarea name="note" class="form-control">{{old('note')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary btn-block">{{__('pages.save')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('/backend/js/custom.js')}}"></script>
@endsection

