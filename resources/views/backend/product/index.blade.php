@extends('backend.layouts.app')
@section('title') {{__('pages.product')}} @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 align-items-center justify-content-between">
                        <div class="row">
                            <div class="col-md-10 col-12">
                                <form action="{{route('product-filter')}}" method="get">
                                    <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="text" name="search_key" value="{{Request::get('search_key')}}"  class="form-control" placeholder="{{__('pages.product_search_kye')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <select name="category_id" class="form-control select2">
                                                <option value=""> {{__('pages.all_category')}}</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{Request::get('category_id') ==  $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                           <button type="submit" class="btn btn-primary btn-block">{{__('pages.search')}}</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="col-md-2 cl-12">
                                <div class="float-right">
                                    <a href="{{route('product.create')}}" class="btn btn-secondary btn-block rounded-0"><i class="fa fa-plus"></i> {{__('pages.create_product')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body mt-3">

                        <div class="row products pt-5" >
                            @forelse($products as $key => $product)
                                <div class="col-md-3 p-2">
                                    <div class="card">
                                        <div class="box">
                                            <div class="img">
                                                <a href="{{route('product.show', [$product->id])}}">
                                                    <img src="{{asset($product->thumbnail ? $product->thumbnail : 'backend/img/blank-thumbnail.jpg')}}">
                                                </a>
                                            </div>
                                            <h2>
                                                {{$product->title}}<br>
                                                <span>{{__('pages.sku')}}: {{$product->sku}}</span>
                                            </h2>
                                            <p>
                                                <span class="text-primary"> {{__('pages.purchase')}} : {{get_option('app_currency')}}{{$product->purchase_price}},</span>
                                                <span class="text-warning"> {{__('pages.sell')}}: {{get_option('app_currency')}}{{$product->sell_price}}</span>
                                                <br>
                                                <span class="text-success">
                                                    {{__('pages.stock_quantity')}}: {{productAvailableTransactionStockQty($product->id)}}
                                                </span>
                                            </p>
                                            <span>
                                        <ul>
                                            <li><a href="{{route('product.edit', [$product->id])}}"><i class="fa fa-edit text-primary" aria-hidden="true"></i></a></li>
                                            <li><a href="{{route('product.show', [$product->id])}}"><i class="fa fa-eye text-secondary" aria-hidden="true"></i></a></li>
                                            <li><a href="javascript:void(0)" class="download-bar-code" data-id="{{$product->id}}"><i class="fa fa-barcode text-secondary" aria-hidden="true"></i></a></li>
                                            <li><a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}'))"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></li>
                                            <form action="{{ route('product.destroy',$product->id) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                                        </ul>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12 py-5 text-center">
                                    <h1 class="text-warning py-5">No product found</h1>
                                </div>
                            @endforelse
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                {{$products->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->



    <!-- Modal -->
    <div class="modal fade mt-5" id="barCodeQty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Barcode Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="productBarCode" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="number" name="quantity" value="1" min="1" max="500" class="form-control" placeholder="Input Barcode Quantity" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Download</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="baseURL" value="{{url('/')}}">
@endsection

@section('js')
    <script src="{{asset('/backend/js/custom.js')}}"></script>
@endsection

