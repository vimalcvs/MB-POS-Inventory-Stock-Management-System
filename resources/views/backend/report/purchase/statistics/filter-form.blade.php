<div class="col-md-5 pr-0">
    <form action="{{url('report/purchase/statistics-filter')}}" method="get">
        <div class="d-flex">
            <input type="hidden" name="search_type" value="month">
            <div class="float-left">
                <div class="form-group text-left">
                    <input type="text" name="month" data-date-format="yyyy-M"  value="{{Request::get('month')}}"  placeholder="{{__('pages.select_month')}}" id="datepicker" class="form-control" autocomplete="off">
                </div>
            </div>

            @can('access_to_all_branch')
                <div class="float-left pl-2">
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


            <div class="form-group pl-2">
                <button class="btn btn-warning btn-block">{{__('pages.search')}}</button>
            </div>
        </div>
    </form>
</div>

<div class="col-md-5 pr-0">
    <form action="{{url('report/purchase/statistics-filter')}}" method="get">
        <div class="d-flex">
            <input type="hidden" name="search_type" value="year">
            <div class="float-left">
                <div class="form-group text-left">
                    <input type="text" name="year" data-date-format="yyyy"  value="{{Request::get('year')}}"  placeholder="{{__('pages.select_year')}}" id="yearPicker" class="form-control" autocomplete="off">
                </div>
            </div>

            @can('access_to_all_branch')
                <div class="float-left pl-2">
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

            <div class="form-group pl-2">
                <button class="btn btn-warning btn-block">{{__('pages.search')}}</button>
            </div>
        </div>
    </form>
</div>

<div class="col-md-2 text-right">
    @include('backend.report.purchase.statistics.more-filter')
</div>
