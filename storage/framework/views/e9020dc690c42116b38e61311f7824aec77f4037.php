<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sell Invoice</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php echo $__env->make('backend.pdf.layouts.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body >
<?php echo $__env->make('backend.pdf.layouts.invoice-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<main>
    <div id="details" class="clearfix" style="border-bottom: 1px solid #AAAAAA">
        <div style="width: 50%;float: left">
            <p style="line-height: 1px;margin-bottom: 5px"><?php echo e(__('pages.customer_name')); ?> : <?php echo e($sell->customer->name); ?></p>
            <p style="margin-top: 0px"><?php echo e(__('pages.customer_phone')); ?>: <?php echo e($sell->customer->phone); ?></p>
        </div>

        <div style="width: 50%;float: left;text-align: right">
            <p style="line-height: 1px;margin-bottom: 5px"><?php echo e(__('pages.invoice_id')); ?>: <?php echo e($sell->invoice_id); ?></p>
            <p style="margin-top: 0px"><?php echo e(__('pages.date')); ?>: <?php echo e(\Carbon\Carbon::parse($sell->created_at)->format(get_option('app_date_format'))); ?> <?php echo e(\Carbon\Carbon::parse($sell->created_at)->format('h:i:A')); ?></p>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table" width="100%" cellspacing="0">
            <thead>
            <tr class="bg-secondary text-white">
                <th><?php echo e(__('pages.sl')); ?></th>
                <th><?php echo e(__('pages.product_title')); ?></th>
                <th><?php echo e(__('pages.unit_price')); ?></th>
                <th><?php echo e(__('pages.tax')); ?></th>
                <th><?php echo e(__('pages.quantity')); ?></th>
                <th><?php echo e(__('pages.total_price')); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $sell->sellProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sell_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td width="3%"><?php echo e($key+1); ?></td>
                    <td>
                        <?php echo e($sell_product->product->title); ?>

                    </td>
                    <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell_product->sell_price, 2)); ?> </td>
                    <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell_product->tax_amount, 2)); ?> </td>
                    <td> <?php echo e($sell_product->quantity); ?> </td>
                    <td> <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell_product->total_price, 2)); ?> </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="5" class="text-right pr-3">
                    <?php echo e(__('pages.sub_total')); ?>:
                </td>
                <td>
                    <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->sub_total,2)); ?>

                </td>
            </tr>

            <tr>
                <td colspan="5" class="text-right pr-3">
                    <?php echo e(__('pages.discount')); ?>:
                </td>
                <td>
                    <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->discount,2)); ?>

                </td>
            </tr>

            <tr>
                <td colspan="5" class="text-right pr-3">
                    <?php echo e(__('pages.grand_total')); ?>:
                </td>
                <td>
                    <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->grand_total_price,2)); ?>

                </td>
            </tr>

            <tr>
                <td colspan="5" class="text-right pr-3">
                    <strong> <?php echo e(__('pages.paid_amount')); ?>:</strong>
                </td>
                <td><strong><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->paid_amount, 2)); ?></strong></td>
            </tr>


            <tr>
                <td colspan="5" class="text-right pr-3">
                    <?php echo e(__('pages.due_amount')); ?>:
                </td>
                <td class="text-danger">
                    <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell->due_amount,2)); ?>

                </td>
            </tr>
            </tbody>
        </table>
    </div>
</main>
<?php echo $__env->make('backend.pdf.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/pdf/sell/invoice.blade.php ENDPATH**/ ?>