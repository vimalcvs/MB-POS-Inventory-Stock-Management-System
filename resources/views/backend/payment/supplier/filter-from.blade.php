<form action="{{route('payment-to-supplier-filter')}}" method="get">
    <div class="row p-0">
        <div class="col-md-3 pr-0">
            <div class="form-group text-left">
                <select name="supplier_id" class="form-control select2">
                    <option value="">{{__('pages.all_supplier')}}</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{$supplier->id}}" {{ Request::get('supplier_id') == $supplier->id ? 'selected' : ''}}>{{$supplier->company_name}} </option>
                    @endforeach
                </select>
            </div>
        </div>

        @can('access_to_all_branch')
            <div class="col-md-3">
                <div class="form-group text-left">
                    <select name="branch_id" class="form-control select2">
                        <option value="">{{__('pages.all_branch')}}</option>
                        @foreach($branches as $branch)
                            <option value="{{$branch->id}}" {{ Request::get('branch_id') == $branch->id ? 'selected' : ''}}>{{$branch->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @else
            <input type="hidden" name="branch_id" value="{{auth()->user()->employee->branch_id}}">
        @endcan

        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <input type="text" name="start_date" value="{{Request::get('start_date')}}" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.start_date')}}" autocomplete="off">
            </div>
        </div>

        <div class="col-md-2 pl-0">
            <div class="form-group text-left">
                <input type="text" name="end_date" value="{{Request::get('end_date')}}" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.end_date')}}" autocomplete="off">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <button class="btn btn-secondary btn-block">{{__('pages.search')}}</button>
            </div>
        </div>
    </div>
</form>