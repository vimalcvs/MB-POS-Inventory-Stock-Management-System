@extends('backend.layouts.app')
@section('title') Purchase Report @endsection
@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid settings-page">
		<div class="row">
			<div class="col-12">
				<div class="card mb-4 rounded-0">
					<!-- Card Header - Dropdown -->
					<div class="card-header p-0">
						@include('backend.report.purchase.partial.nav')
                        <div class="btn-group btn-group-sm filter-pdf-btn" role="group">
                            <form action="{{url('report/purchase/statistics-pdf')}}" method="get">
                                @include('backend.report.purchase.partial.hidden-filter-value-pdf')
                                <input type="hidden" name="action_type" value="download">
                                <button type="submit" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> {{__('pages.pdf')}} </button>
                            </form>

                            <form action="{{url('report/purchase/statistics-pdf')}}" method="get" target="_blank">
                                @include('backend.report.purchase.partial.hidden-filter-value-pdf')
                                <input type="hidden" name="action_type" value="print">
                                <button type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> {{__('pages.print')}} </button>
                            </form>
                        </div>
					</div>
					<!-- Card Body -->
					<div class="card-body p-0">
						<div class="row pt-2 ml-0 mr-0 bg-primary h-55">
                            @include('backend.report.purchase.statistics.filter-form')
						</div>

						<div class="chart-area mt-4">
							<canvas id="myAreaChart"></canvas>
						</div>

                        @include('backend.report.purchase.statistics.table-data')
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
    <input type="hidden" value="{{url('/')}}" id="baseUrl">
    <input type="hidden" value="{{Request::get('month') ? Request::get('month') : 'a'}}" id="selected_month">
    <input type="hidden" value="{{Request::get('year') ? Request::get('year') : 'a'}}" id="selected_year">
    <input type="hidden" value="{{Request::get('branch_id') ? Request::get('branch_id') : 'a'}}" id="selected_branch">
    <input type="hidden" value="{{Request::get('search_type')}}" id="search_type">
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('/backend/js/partial/purchase-report-statistics-filter.js')}}"></script>
@endsection
