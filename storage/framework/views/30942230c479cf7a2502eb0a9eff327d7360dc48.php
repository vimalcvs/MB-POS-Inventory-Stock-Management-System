<?php $__env->startSection('title'); ?> <?php echo e(__('pages.dashboard')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('pages.sales_of_month')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell_of_this_month,2)); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo e(__('pages.total_sales_amount')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_sell,2)); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('pages.purchase_of_month')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase_of_this_month,2)); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck-moving fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo e(__('pages.total_purchase_amount')); ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_purchase,2)); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck-moving fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.sales_summary_last_30_days')); ?></h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 col-12 pr-1">
                <div class="card shadow mb-5 pb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.trending_products')); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center font-size-12" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.title')); ?></th>
                                    <th><?php echo e(__('pages.sku')); ?></th>
                                    <th><?php echo e(__('pages.amount')); ?></th>
                                    <th><?php echo e(__('pages.sell_qty')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $trending_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('product.show', $product->id)); ?>">
                                                <?php echo e(str_limit($product->title, 20)); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('product.show', $product->id)); ?>">
                                                <?php echo e($product->sku); ?>

                                            </a>
                                        </td>
                                        <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($product->sellProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('total_price'), 2)); ?> </td>
                                        <td><?php echo e($product->total_sell_qty); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12 pl-1">
                <div class="card shadow mb-5 pb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.low_stock_products')); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center font-size-12" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.title')); ?></th>
                                    <th><?php echo e(__('pages.sku')); ?></th>
                                    <th><?php echo e(__('pages.current_stock_qty')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $low_stock_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('product.show', $product->id)); ?>">
                                                <?php echo e(str_limit($product->title, 20)); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('product.show', $product->id)); ?>">
                                                <?php echo e($product->sku); ?>

                                            </a>
                                        </td>
                                        <td><?php echo e($product->current_stock_quantity); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12">

                <!-- Project Card Example -->
                <div class="card shadow mb-5 pb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.branches_target_this_month')); ?></h6>
                    </div>
                    <div class="card-body">

                        <?php $__currentLoopData = $sells_targets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sell_target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if(monthlySells($sell_target->branch_id, $sell_target->month) > 0){
                                    $result = monthlySells($sell_target->branch_id, $sell_target->month) * 100 / $sell_target->target_amount;
                                }else{
                                    $result = 0;
                                }
                            ?>

                            <h4 class="small font-weight-bold"><?php echo e($sell_target->branch->title); ?> <span class="float-right"><?php echo e(number_format($result,2)); ?>%</span></h4>
                            <div class="progress mb-4">
                                <?php if($result < 15): ?>
                                    <div class="progress-bar progress-bar-striped bg-danger w10p" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><?php echo e(number_format($result,2)); ?>% <?php echo e(__('pages.complete')); ?></div>
                                <?php elseif($result < 40): ?>
                                    <div class="progress-bar progress-bar-striped bg-warning dwp-<?php echo e(round($result)); ?>" role="progressbar" aria-valuenow="<?php echo e($result); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e(number_format($result,2)); ?>% <?php echo e(__('pages.complete')); ?></div>
                                <?php elseif($result < 60): ?>
                                    <div class="progress-bar progress-bar-striped bg-info dwp-<?php echo e(round($result)); ?>" role="progressbar" aria-valuenow="<?php echo e($result); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e(number_format($result,2)); ?>% <?php echo e(__('pages.complete')); ?></div>
                                <?php elseif($result < 80): ?>
                                    <div class="progress-bar progress-bar-striped bg-info dwp-<?php echo e(round($result)); ?>" role="progressbar" aria-valuenow="<?php echo e($result); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e(number_format($result,2)); ?>% <?php echo e(__('pages.complete')); ?></div>
                                <?php else: ?>
                                    <div class="progress-bar progress-bar-striped bg-info dwp-<?php echo e(round($result)); ?>" role="progressbar" aria-valuenow="<?php echo e($result); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e(number_format($result,2)); ?>% <?php echo e(__('pages.complete')); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('/backend/vendor/chart.js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend/js/demo/chart-area-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend/js/partial/dashboard.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>