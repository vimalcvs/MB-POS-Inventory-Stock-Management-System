<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sells Report</title>
    <?php echo $__env->make('backend.pdf.layouts.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body >
<?php echo $__env->make('backend.pdf.layouts.report-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<main>
    <div id="details" class="clearfix">
        <div id="client"class="mt-10">
            <h2 class="name">Sells Report</h2>
            <div class="address">
                <?php echo e(__('pages.filter_by')); ?>:- <?php echo e(__('pages.branch')); ?>: <?php echo e($filter_by['branch_name']); ?>,
                <?php echo e(__('pages.date_range')); ?>: <?php echo e($filter_by['start_date']); ?> to <?php echo e($filter_by['end_date']); ?>,
            </div>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
        <thead>
            <tr class="bg-secondary text-white">
                <th><?php echo e(__('pages.sl')); ?></th>
                <th><?php echo e(__('pages.invoice_id')); ?></th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                    <th><?php echo e(__('pages.branch')); ?></th>
                <?php endif; ?>
                <th width="10%"><?php echo e(__('pages.sell_date')); ?></th>
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
                    <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->sub_total, 2)); ?> </td>
                    <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->discount, 2)); ?> </td>
                    <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->grand_total_price, 2)); ?> </td>
                    <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->paid_amount, 2)); ?> </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                    <td colspan="4" class="text-right"><strong><?php echo e(__('pages.total')); ?></strong></td>
                <?php else: ?>
                    <td colspan="3" class="text-right"><strong><?php echo e(__('pages.total')); ?></strong></td>
                <?php endif; ?>
                <td> <strong><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sells->sum('sub_total'), 2)); ?></strong>  </td>
                <td> <strong><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->sum('discount'), 2)); ?></strong> </td>
                <td> <strong><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->sum('grand_total_price'), 2)); ?></strong> </td>
                <td> <strong><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->sum('paid_amount'), 2)); ?></strong> </td>
            </tr>
        </tbody>
    </table>


</main>
<?php echo $__env->make('backend.pdf.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/pdf/reports/sells/sells.blade.php ENDPATH**/ ?>