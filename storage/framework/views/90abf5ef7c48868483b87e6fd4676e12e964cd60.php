<?php $__env->startSection('title'); ?> Sells Report <?php $__env->stopSection(); ?>
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
                            <a href="<?php echo e(url('report/sell/statistics/last/'.$days.'/days-pdf/download')); ?>" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> <?php echo e(__('pages.pdf')); ?> </a>
                            <a href="<?php echo e(url('report/sell/statistics/last/'.$days.'/days-pdf/print')); ?>" target="_blank" type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> <?php echo e(__('pages.print')); ?> </a>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="row pt-2 ml-0 mr-0 bg-primary h-55">
                            <?php echo $__env->make('backend.report.sell.statistics.filter-from', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="chart-area mt-4">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                        <?php echo $__env->make('backend.report.sell.statistics.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <input type="hidden" value="<?php echo e(url('/')); ?>" id="baseUrl">
    <input type="hidden" value="<?php echo e($days); ?>" id="days">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('backend/vendor/chart.js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/demo/chart-area-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend/js/partial/sale-report-dynamic-days.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/report/sell/statistics/dynamic-days.blade.php ENDPATH**/ ?>