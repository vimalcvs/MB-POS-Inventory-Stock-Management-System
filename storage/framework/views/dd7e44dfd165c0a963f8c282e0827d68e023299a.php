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
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <form action="<?php echo e(url('report/sell/sells-filter-result')); ?>" method="get">
                            <?php echo $__env->make('backend.report.sell.sells.filter-from', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </form>

                        <div class="table-responsive margin-t-m5">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.invoice_id')); ?></th>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                        <th><?php echo e(__('pages.branch')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('pages.sell_date')); ?></th>
                                    <th><?php echo e(__('pages.sub_total')); ?></th>
                                    <th><?php echo e(__('pages.discount')); ?></th>
                                    <th><?php echo e(__('pages.grand_total')); ?></th>
                                    <th><?php echo e(__('pages.paid_amount')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $sells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('sell.show', [$sell->id])); ?>"><?php echo e($sell->invoice_id); ?></a>
                                        </td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                            <td><?php echo e($sell->branch->title); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e($sell->sell_date->format(get_option('app_date_format'))); ?></td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->sub_total, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->discount, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->grand_total_price, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->paid_amount, 2)); ?> </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                           <div class="text-center pl-2">
                               <?php echo e($sells->links()); ?>

                           </div>
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/report/sell/sells/sells.blade.php ENDPATH**/ ?>