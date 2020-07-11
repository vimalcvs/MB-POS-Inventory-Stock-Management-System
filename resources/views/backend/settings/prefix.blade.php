@extends('backend.layouts.app')
@section('title') Settings @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        @include('backend.settings.partial.nav')
                    </div>
                    <!-- Card Body -->
                    <div class="card-body pt-5">
                        <form action="{{route('save-application-setting')}}" method="post" class="form-horizontal" enctype="multipart/form-data"  data-parsley-validate>
                            @csrf

                            <div class="row justify-content-center pt-5">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="product_sku_prefix">{{__('pages.product')}}</label>
                                        <input name="product_sku_prefix" value="{{get_option('product_sku_prefix')}}" type="text" class="form-control" placeholder="Product SKU Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="product_sku_prefix">{{__('pages.purchase_invoice')}}</label>
                                        <input name="purchase_invoice_prefix" value="{{get_option('purchase_invoice_prefix')}}" type="text" class="form-control" placeholder="Purchase Invoice Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="product_sku_prefix">{{__('pages.sell_invoice')}}</label>
                                        <input name="sell_invoice_prefix" value="{{get_option('sell_invoice_prefix')}}" type="text" class="form-control" placeholder="Sell Invoice Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="requisition_id_prefix">{{__('pages.requisition_id')}}</label>
                                        <input name="requisition_id_prefix" value="{{get_option('requisition_id_prefix')}}" type="text" class="form-control" placeholder="Requisition ID Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="expense_id_prefix">{{__('pages.expense_id')}}</label>
                                        <input name="expense_id_prefix" value="{{get_option('expense_id_prefix')}}" type="text" class="form-control" placeholder="Expense ID Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="invoice_length">Invoice Min Length</label>
                                        <input name="invoice_length" value="{{get_option('invoice_length')}}" type="number" step="1" min="1" max="9" class="form-control" placeholder="Ex. 6" required>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Save & Update</button>
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

