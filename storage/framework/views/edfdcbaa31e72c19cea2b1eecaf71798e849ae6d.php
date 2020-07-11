<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Purchase Invoice</title>
    <?php echo $__env->make('backend.pdf.layouts.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body >
<?php echo $__env->make('backend.pdf.layouts.invoice-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<main>
    <div id="details" class="clearfix" style="border-bottom: 1px solid #AAAAAA">
        <div style="width: 50%;float: left">
            <p style="line-height: 1px;margin-bottom: 5px"><?php echo e(__('pages.supplier_name')); ?>: <?php echo e($purchase->supplier->company_name); ?></p>
            <p style="margin-top: 0px"><?php echo e(__('pages.phone_number')); ?>: <?php echo e($purchase->supplier->phone); ?></p>
        </div>

        <div style="width: 50%;float: left;text-align: right">
            <p style="line-height: 1px;margin-bottom: 5px"><?php echo e(__('pages.invoice_id')); ?>: <?php echo e($purchase->invoice_id); ?></p>
            <p style="margin-top: 0px"><?php echo e(__('pages.date')); ?>: <?php echo e(\Carbon\Carbon::parse($purchase->purchase_date)->format(get_option('app_date_format'))); ?> <?php echo e(\Carbon\Carbon::parse($purchase->created_at)->format('h:i A')); ?></p>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table" width="100%" cellspacing="0">
            <thead>
            <tr class="bg-secondary text-white">
                <th><?php echo e(__('pages.sl')); ?></th>
                <th><?php echo e(__('pages.product')); ?></th>
                <th><?php echo e(__('pages.unit_price')); ?></th>
                <th><?php echo e(__('pages.quantity')); ?></th>
                <th><?php echo e(__('pages.total_price')); ?></th>
            </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $purchase->purchaseProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $purchase_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td width="3%"><?php echo e($key+1); ?></td>
                        <td><?php echo e($purchase_product->product->title); ?></td>
                        <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($purchase_product->purchase_price, 2)); ?> </td>
                        <td> <?php echo e($purchase_product->quantity); ?> </td>
                        <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($purchase_product->total_price, 2)); ?> </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="4" class="text-right pr-5">
                        <strong><?php echo e(__('pages.total_amount')); ?>: </strong>
                    </td>
                    <td>
                        <strong>
                            <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($purchase->total_amount, 2)); ?>

                        </strong>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" class="text-right pr-5">
                        <strong><?php echo e(__('pages.paid_amount')); ?>: </strong>
                    </td>
                    <td>
                        <strong>
                            <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($purchase->paid_amount, 2)); ?>

                        </strong>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" class="text-right pr-5">
                        <strong><?php echo e(__('pages.due_amount')); ?>: </strong>
                    </td>
                    <td>
                        <strong>
                            <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->due_amount, 2)); ?>

                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
<?php echo $__env->make('backend.pdf.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/pdf/purchase/invoice.blade.php ENDPATH**/ ?>