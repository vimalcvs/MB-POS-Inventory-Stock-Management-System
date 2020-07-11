@extends('backend.layouts.app')
@section('title') Sells Report @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        @include('backend.report.sell.partial.nav')

                        <div class="btn-group btn-group-sm filter-pdf-btn" role="group">
                            <a href="{{url('report/sell/statistics/last/'.$days.'/days-pdf/download')}}" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> {{__('pages.pdf')}} </a>
                            <a href="{{url('report/sell/statistics/last/'.$days.'/days-pdf/print')}}" target="_blank" type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> {{__('pages.print')}} </a>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="row pt-2 ml-0 mr-0 bg-primary h-55">
                            @include('backend.report.sell.statistics.filter-from')
                        </div>
                        <div class="chart-area mt-4">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                        @include('backend.report.sell.statistics.table-data')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <input type="hidden" value="{{url('/')}}" id="baseUrl">
    <input type="hidden" value="{{$days}}" id="days">
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('/backend/js/partial/sale-report-dynamic-days.js')}}"></script>
@endsection

