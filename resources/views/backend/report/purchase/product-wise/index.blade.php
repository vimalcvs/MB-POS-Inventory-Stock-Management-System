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
					</div>
					<!-- Card Body -->
					<div class="card-body p-0">
						<form action="{{url('report/purchase/product-wise-filter')}}" method="get">
							@include('backend.report.purchase.product-wise.filter-form')
						</form>

						<div class="table-responsive margin-t-m5">
							@include('backend.report.purchase.product-wise.table-data')
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

