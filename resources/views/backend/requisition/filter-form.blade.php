<form action="{{route('requisition-filter')}}" method="get">
    <div class="row p-0">
        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <input type="text" name="invoice" class="form-control" placeholder="{{__('pages.requisition_id')}}">
            </div>
        </div>

        @if (Auth::user()->can('access_to_all_branch'))
            <div class="col-md-2 pr-0">
                <div class="form-group text-left">
                        <select name="requisition_from" class="form-control select2">
                            <option value="">{{__('pages.requisition_form')}}</option>
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}" {{Request::get('requisition_from') == $branch->id ? 'selected' : ''}}>{{$branch->title}} </option>
                            @endforeach
                        </select>
                </div>
            </div>
        @else
            <input type="hidden" name="requisition_from" value="{{auth()->user()->employee->branch_id}}">
        @endif

        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <select name="requisition_to" class="form-control select2">
                    <option value="">{{__('pages.requisition_to')}}</option>
                    @foreach($branches as $branch)
                        <option value="{{$branch->id}}" {{Request::get('requisition_to') == $branch->id ? 'selected' : ''}}>{{$branch->title}} </option>
                    @endforeach
                </select>
            </div>
        </div>

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

        <div class="col-md-2 pl-0">
            <div class="form-group text-left">
                <select name="status" class="form-control select2">
                    <option value="">{{__('pages.select_one')}}</option>
                    <option value="0" {{Request::get('status') ? Request::get('status') == 0 ? 'selected' : '' : ''}}>{{__('pages.pending')}} </option>
                    <option value="1" {{Request::get('status') == 1 ? 'selected' : ''}}>{{__('pages.delivered')}} </option>
                    <option value="2" {{Request::get('status') == 2 ? 'selected' : ''}}>{{__('pages.complete')}} </option>
                    <option value="3" {{Request::get('status') == 3 ? 'selected' : ''}}>{{__('pages.rejected')}} </option>
                    <option value="4" {{Request::get('status') == 4 ? 'selected' : ''}}>{{__('pages.canceled')}} </option>
                </select>
            </div>
        </div>

        @if (Auth::user()->can('access_to_all_branch'))
            <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-secondary btn-block">{{__('pages.search')}}</button>
                </div>
            </div>
        @else
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-secondary btn-block">{{__('pages.search')}}</button>
                </div>
            </div>
        @endif

    </div>
</form>