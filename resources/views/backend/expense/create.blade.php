@extends('backend.layouts.app')
@section('title') {{__('pages.expense')}}  @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{__('pages.create_expense')}}</h6>
                        <a href="{{route('expense.index')}}" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-2"></i> {{__('pages.expense_list')}}</a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body min-height-550">
                        <form action="{{route('expense.store')}}" method="post" data-parsley-validate>
                            @csrf

                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="expense_date">{{__('pages.expense_date')}} <span class="text-danger">*</span></label>
                                                <input name="expense_date" value="{{old('expense_date') ? old('expense_date') : \Carbon\Carbon::now()->format('Y-m-d')}}" id="expense_date" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="{{__('pages.expense_date')}}" required autocomplete="off">
                                                @if ($errors->has('expense_date'))
                                                    <div class="error">{{ $errors->first('expense_date') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="expense_category_id">{{__('pages.expense_category')}} <span class="text-danger">*</span></label>
                                                <select name="expense_category_id" id="expense_category_id" class="form-control select2">
                                                    <option value="">{{__('pages.select_category')}}</option>
                                                    @foreach($expense_categories as $expense_category)
                                                        <option value="{{$expense_category->id}}" {{old('expense_category_id') == $expense_category->id ? 'selected' : ''}}>{{$expense_category->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('expense_category_id'))
                                                    <div class="error mt-1">{{ $errors->first('expense_category_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="amount">{{__('pages.amount')}} <span class="text-danger">*</span></label>
                                                <input type="number" name="amount" step=".1" min="0" id="amount" value="{{old('amount')}}" placeholder="{{__('pages.amount')}}" class="form-control" aria-describedby="emailHelp" required>
                                                @if ($errors->has('amount'))
                                                    <div class="error">{{ $errors->first('amount') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="note">{{__('pages.note')}}</label>
                                                <textarea name="note" placeholder="Short Note" class="form-control">{{old('note')}}</textarea>
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
@endsection

@section('js')

@endsection

