@extends('backend.layouts.app')
@section('title') {{__('pages.product')}}  @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <form action="{{route('product.update', [$product->id])}}" method="post" enctype="multipart/form-data" data-parsley-validate>
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 rounded-0">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{__('pages.update_product')}}</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">{{__('pages.product_title')}} <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" value="{{$product->title}}" placeholder="{{__('pages.product_title')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('title'))
                                            <div class="error">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sku">{{__('pages.sku_or_product_code')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="sku" id="sku" value="{{$product->sku}}" maxlength="15" placeholder="{{__('pages.sku_or_product_code')}}" class="form-control" aria-describedby="emailHelp">
                                        @if ($errors->has('sku'))
                                            <div class="error">{{ $errors->first('sku') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category">{{__('pages.category')}} <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category" class="form-control select2">
                                            <option value="">{{__('pages.select_one')}} </option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('category_id'))
                                            <div class="error">{{ $errors->first('category_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="purchase_price">{{__('pages.purchase_price')}} <span class="text-danger">*</span></label>
                                        <input type="number" step=".1" min="1" value="{{$product->purchase_price}}" name="purchase_price" id="purchase_price" placeholder="{{__('pages.purchase_price')}}" class="form-control">
                                        @if ($errors->has('purchase_price'))
                                            <div class="error">{{ $errors->first('purchase_price') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sell_price">{{__('pages.sell_price')}} <span class="text-danger">*</span></label>
                                        <input type="number" step=".1" min="1" name="sell_price" value="{{$product->sell_price}}" id="sell_price" placeholder="{{__('pages.sell_price')}}" class="form-control">
                                        @if ($errors->has('sell_price'))
                                            <div class="error">{{ $errors->first('sell_price') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price_type">{{__('pages.sell_price_type')}} <span class="text-danger">*</span></label>
                                        <select name="price_type" id="price_type" class="form-control select2">
                                            <option value="1" {{$product->price_type == 1 ? 'selected' : ''}}>Fixed</option>
                                            <option value="2" {{$product->price_type == 2 ? 'selected' : ''}}>Negotiable</option>
                                        </select>

                                        @if ($errors->has('price_type'))
                                            <div class="error">{{ $errors->first('price_type') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tax_id">{{__('pages.tax')}} <span class="text-danger">*</span></label>
                                        <select name="tax_id" id="tax_id" class="form-control select2">
                                            <option value="">{{__('pages.select_one')}}</option>
                                            @foreach($taxes as $tax)
                                                <option value="{{$tax->id}}" {{$product->tax_id == $tax->id ? 'selected' : ''}}>{{$tax->title}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('tax_id'))
                                            <div class="error">{{ $errors->first('tax_id') }}</div>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_description">{{__('pages.short_description')}}</label>
                                        <textarea name="short_description" id="short_descriptionress" value="{{old('short_description')}}" class="form-control" placeholder="Short Description">{{$product->short_description}}</textarea>
                                        @if ($errors->has('short_description'))
                                            <div class="error">{{ $errors->first('short_description') }}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="upload-img-box">
                                            @if($product->thumbnail)
                                                <img src="{{asset($product->thumbnail)}}">
                                            @else
                                                <img src="">
                                            @endif
                                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" onchange="previewFile(this)">
                                            <div class="upload-img-box-icon">
                                                <i class="fa fa-camera"></i>
                                                <p class="m-0">Add Image</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 pull-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">{{__('pages.save_and_update')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection


@section('js')
    <script src="{{asset('/backend/js/custom.js')}}"></script>
@endsection

