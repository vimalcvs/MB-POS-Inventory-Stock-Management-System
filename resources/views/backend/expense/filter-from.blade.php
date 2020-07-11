<form action="{{route('expense-filter')}}" method="get">
    <div class="row p-0">
        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <input type="text" name="expense_id" value="{{Request::get('expense_id')}}" class="form-control" placeholder="{{__('pages.expense_id')}}">
            </div>
        </div>

        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <select name="expense_category_id" class="form-control select2">
                    <option value="">{{__('pages.all_category')}}</option>
                    @foreach($expense_categories as $expense_category)
                        <option value="{{$expense_category->id}}">{{$expense_category->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>

        @can('access_to_all_branch')
            <div class="col-md-2">
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
                <button class="btn btn-primary btn-block">{{__('pages.search')}}</button>
            </div>
        </div>
    </div>
</form>