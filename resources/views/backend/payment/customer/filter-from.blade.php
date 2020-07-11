<form action="{{route('payment-from-customer-filter')}}" method="get">
    <div class="row p-0">
        <div class="col-md-3 pr-0">
            <div class="form-group text-left">
                <select name="customer_id" class="form-control select2">
                    <option value="">{{__('pages.all_customer')}}</option>
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}" {{ Request::get('customer_id') == $customer->id ? 'selected' : ''}}>{{$customer->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3 pr-0">
            <div class="form-group text-left">
                <input type="text" name="start_date" value="{{Request::get('start_date')}}" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.start_date')}}" autocomplete="off">
            </div>
        </div>

        <div class="col-md-3 pl-0">
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