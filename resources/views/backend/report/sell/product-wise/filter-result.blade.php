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
							<form action="{{url('report/sell/product-wise-pdf')}}" method="get">
								@include('backend.report.sell.partial.hidden-filter-value-pdf')
								<input type="hidden" name="action_type" value="download">
								<button type="submit" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> {{__('pages.pdf')}} </button>
							</form>

							<form action="{{url('report/sell/product-wise-pdf')}}" method="get" target="_blank">
								@include('backend.report.sell.partial.hidden-filter-value-pdf')
								<input type="hidden" name="action_type" value="print">
								<button type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> {{__('pages.print')}} </button>
							</form>
						</div>
					</div>
					<!-- Card Body -->
					<div class="card-body p-0">
						<form action="{{url('report/sell/product-wise-filter')}}" method="get">
                            @include('backend.report.sell.product-wise.filter-from')
						</form>

						<div class="table-responsive margin-t-m5">
							@include('backend.report.sell.product-wise.table-data')
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

