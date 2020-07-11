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
                        <h6 class="m-0 font-weight-bold text-primary ml-1">{{__('pages.new_payment')}}</h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body min-height-550">
                        <form action="{{route('payment-to-supplier.store')}}" method="post" data-parsley-validate>
                            @csrf

                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="row">
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
                                                <label for="supplier_id">{{__('pages.supplier')}} <span class="text-danger">*</span></label>
                                                <select name="supplier_id" id="supplier_id" class="form-control select2">
                                                    <option value="">{{__('pages.select_supplier')}}</option>
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{$supplier->id}}" {{old('supplier_id') == $supplier->id ? 'selected' : ''}}>{{$supplier->company_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span id="supplierTotalDue" class="mt-3 text-danger"></span>

                                                @if ($errors->has('supplier_id'))
                                                    <div class="error mt-1">{{ $errors->first('supplier_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="amount">{{__('pages.amount')}} <span class="text-danger">*</span></label>
                                                <input type="number" id="amount" name="amount"  min="0" step=".1" id="amount" value="{{old('amount')}}" placeholder="{{__('pages.amount')}}" class="form-control" aria-describedby="emailHelp" required>
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
        </div>
    </div>
    <!-- /.container-fluid -->
    <input type="hidden" value="{{url('/')}}" id="banseURL">
@endsection

@section('js')
    <script src="{{asset('/backend/js/partial/create-payment-to-supplier.js')}}"></script>
@endsection

