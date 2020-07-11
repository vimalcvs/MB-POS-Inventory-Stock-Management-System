<div class="row pt-2 ml-0 mr-0 bg-primary">

    <div class="col-md-3 pr-0">
        <div class="form-group text-left">
            <select name="product_id" class="form-control select2">
                <option value="">{{__('pages.all_product')}}</option>
                @foreach($products as $product)
                    <option value="{{$product->id}}" {{Request::get('product_id') == $product->id ? 'selected': ''}}>{{$product->title}} </option>
                @endforeach
            </select>
        </div>
    </div>

    @can('access_to_all_branch')
        <div class="col-md-3 pr-0">
            <div class="form-group text-left">
                <select name="branch_id" class="form-control select2">
                    <option value="">{{__('pages.all_branch')}}</option>
                    @foreach($branches as $branch)
                        <option value="{{$branch->id}}" {{Request::get('branch_id') == $branch->id ? 'selected': ''}}>{{$branch->title}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    @else
        <input type="hidden" name="branch_id" value="{{auth()->user()->employee->branch_id}}">
    @endcan

    <div class="col-md-2 pr-0">
        <div class="form-group text-left">
            <input type="text" name="start_date" data-date-format="yyyy-mm-dd" value="{{Request::get('start_date')}}" class="datepicker form-control" placeholder="{{__('pages.start_date')}}" autocomplete="off">
        </div>
    </div>

    <div class="col-md-2 pl-0">
        <div class="form-group text-left">
            <input type="text" name="end_date" data-date-format="yyyy-mm-dd" value="{{Request::get('end_date')}}" class="datepicker form-control" placeholder="{{__('pages.end_date')}}" autocomplete="off">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <button class="btn btn-warning btn-block">{{__('pages.search')}}</button>
        </div>
    </div>
</div>
