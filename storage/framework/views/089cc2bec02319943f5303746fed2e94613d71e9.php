<?php $__env->startSection('title'); ?> <?php echo e(__('pages.sell_report')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<!-- Begin Page Content -->
	<div class="container-fluid settings-page">
		<div class="row">
			<div class="col-12">
				<div class="card mb-4 rounded-0">
					<!-- Card Header - Dropdown -->
					<div class="card-header p-0">
						<?php echo $__env->make('backend.report.sell.partial.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="btn-group btn-group-sm filter-pdf-btn" role="group">
                            <form action="<?php echo e(url('report/sell/summary-pdf')); ?>" method="get">
                               	<?php echo $__env->make('backend.report.sell.partial.hidden-filter-value-pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <input type="hidden" name="action_type" value="download">
                                <button type="submit" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> <?php echo e(__('pages.pdf')); ?> </button>
                            </form>

                            <form action="<?php echo e(url('report/sell/summary-pdf')); ?>" method="get" target="_blank">
								<?php echo $__env->make('backend.report.sell.partial.hidden-filter-value-pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <input type="hidden" name="action_type" value="print">
                                <button type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> <?php echo e(__('pages.print')); ?> </button>
                            </form>
                        </div>
					</div>
					<!-- Card Body -->
					<div class="card-body p-0">
						<form action="<?php echo e(url('report/sell/summary-filter')); ?>" method="get">
                            <?php echo $__env->make('backend.report.sell.summary.filter-from', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</form>

						<div class="table-responsive">
							<?php echo $__env->make('backend.report.sell.summary.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/report/sell/summary/filter-result.blade.php ENDPATH**/ ?>