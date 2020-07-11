@extends('backend.layouts.app')
@section('title') {{__('pages.sell_report')}} @endsection
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

