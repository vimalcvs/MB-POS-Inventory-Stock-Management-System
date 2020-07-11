@extends('backend.layouts.app')
@section('title') {{__('pages.sell_target')}} @endsection

@section('css')
   
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> {{__('pages.sell_targets')}} </h6>
                        <a href="{{route('branch-sells-target.create')}}" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-plus"></i> {{__('pages.create_sell_target')}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @foreach($sells_targets as $key => $sells_target)
                                <table class="table table-sm table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th colspan="5">
                                            {{\Carbon\Carbon::parse($key)->format('Y-F')}}
                                            <div class="float-right pr-2">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <a href="{{route('branch-sells-target.edit', [$key])}}" class="btn btn-primary rounded-0"><i class="fa fa-pencil-alt"></i> </a>
                                                    <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-{{$key}}')) " class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    <form action="{{ route('branch-sells-target.destroy',$key) }}" method="post" id="delete-{{$key}}"> @csrf @method('delete') </form>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr class="bg-secondary text-white">
                                        <th width="25%">{{__('pages.branch_name')}}</th>
                                        <th width="20%">{{__('pages.target_amount')}}</th>
                                        <th width="20%">{{__('pages.sell')}}</th>
                                        <th>{{__('pages.progress')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sells_target as $branch_target)
                                        <tr>
                                            <td>{{$branch_target->branch->title}}</td>
                                            <td>{{get_option('app_currency')}}{{number_format($branch_target->target_amount, 2)}}</td>
                                            <td>{{get_option('app_currency')}}{{number_format(monthlySells($branch_target->branch_id, $key), 2)}}</td>
                                            <td class="pl-2 pr-2">
                                                @php
                                                    if(monthlySells($branch_target->branch_id, $key) > 0){
                                                        $result = monthlySells($branch_target->branch_id, $key) * 100 / $branch_target->target_amount;
                                                    }else{
                                                        $result = 0;
                                                    }
                                                @endphp

                                                <div class="progress rounded-0">
                                                    @if($result > 20)
                                                        <div class="progress-bar progress-bar-striped text-center dwp-{{round($result)}}" role="progressbar" aria-valuenow="{{$result}}" aria-valuemin="0" aria-valuemax="100">{{number_format($result,2)}}%</div>
                                                    @else
                                                        <div class="progress-bar w20p progress-bar-striped text-center bg-danger" role="progressbar" aria-valuenow="{{$result}}" aria-valuemin="0" aria-valuemax="100">{{number_format($result,2)}}%</div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

