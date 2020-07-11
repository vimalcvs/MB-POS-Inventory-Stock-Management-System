<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Payment To Supplier</title>
    <?php echo $__env->make('backend.pdf.layouts.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body >
<?php echo $__env->make('backend.pdf.layouts.report-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<main>
    <div id="details" class="clearfix">
        <div id="client"class="mt-10">
            <h2 class="name"><?php echo e(__('pages.payment_to_supplier')); ?></h2>
            <div class="address">
                <?php echo e(__('pages.filter_by')); ?>:- Branch: <?php echo e($filter_by['branch_name']); ?>,
                <?php echo e(__('pages.supplier')); ?>: <?php echo e($filter_by['supplier_name']); ?>,
                <?php echo e(__('pages.date_range')); ?>: <?php echo e($filter_by['start_date']); ?> to <?php echo e($filter_by['end_date']); ?>

            </div>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
        <thead>
            <tr class="bg-secondary text-white">
                <th width="3%"><?php echo e(__('pages.sl')); ?></th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                    <th width="20%"><?php echo e(__('pages.branch')); ?></th>
                <?php endif; ?>
                <th width="20%"><?php echo e(__('pages.supplier')); ?></th>
                <th ><?php echo e(__('pages.date')); ?></th>
                <th><?php echo e(__('pages.amount')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key+1); ?></td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                        <td> <?php echo e($payment->branch->title); ?></td>
                    <?php endif; ?>
                    <td><?php echo e($payment->supplier ? $payment->supplier->company_name : '--'); ?> </td>
                    <td><?php echo e($payment->payment_date->format(get_option('app_date_format'))); ?></td>
                    <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($payment->amount, 2)); ?> </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                    <td colspan="4" class="text-right pr-3"><b><?php echo e(__('pages.total_amount')); ?></b></td>
                <?php else: ?>
                    <td colspan="3" class="text-right pr-3"><b><?php echo e(__('pages.total_amount')); ?></b></td>
                <?php endif; ?>
                <td><b><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($payments->sum('amount'), 2)); ?></b></td>
            </tr>
        </tbody>
    </table>


</main>
<?php echo $__env->make('backend.pdf.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/pdf/payment/supplier.blade.php ENDPATH**/ ?>