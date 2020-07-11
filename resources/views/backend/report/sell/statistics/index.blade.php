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
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('/backend/js/partial/sale-report-statistic.js')}}"></script>

@endsection

