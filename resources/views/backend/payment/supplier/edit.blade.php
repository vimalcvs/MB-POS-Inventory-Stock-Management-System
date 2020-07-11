@extends('backend.layouts.app')
@section('title') {{__('pages.payment')}}  @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center">
                        <div class="col-md-10">
                            <h6 class="m-0 font-weight-bold text-primary ml-1">{{__('pages.update_payment')}}</h6>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group float-right">
                                <a href="{{route('payment-to-supplier.index')}}" class="btn btn-primary "><i class="fa fa-list pr-2"></i> {{__('pages.all_payment')}}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body min-height-550">
                        <form action="{{route('payment-to-supplier.update', [$payment->id])}}" method="post" data-parsley-validate>
                            @csrf
                            @method('patch')

                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="payment_date">{{__('pages.payment_date')}} <span class="text-danger">*</span></label>
                                                <input name="payment_date" value="{{$payment->payment_date->toDateString()}}" id="payment_date" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.date')}}" required autocomplete="off">
                                                @if ($errors->has('payment_date'))
                                                    <div class="error">{{ $errors->first('payment_date') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="supplier_id">{{__('pages.supplier')}} <span class="text-danger">*</span></label>
                                                <select name="supplier_id" id="supplier_id" class="form-control select2">
                                                    <option value="">{{__('pages.select_supplier')}}</option>
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{$supplier->id}}" {{$payment->supplier_id == $supplier->id ? 'selected' : ''}}>{{$supplier->company_name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('supplier_id'))
                                                    <div class="error mt-1">{{ $errors->first('supplier_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="amount">{{__('pages.amount')}} <span class="text-danger">*</span></label>
                                                <input type="number" name="amount" step=".1" min="0" id="amount" value="{{$payment->amount}}" placeholder="{{__('pages.amount')}}" class="form-control" aria-describedby="emailHelp" required>
                                                @if ($errors->has('amount'))
                                                    <div class="error">{{ $errors->first('amount') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="note">{{__('pages.note')}}</label>
                                                <textarea name="note" class="form-control">{{$payment->note}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mt-2">
                                                <button type="submit" class="btn btn-primary btn-block">{{__('pages.update')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

