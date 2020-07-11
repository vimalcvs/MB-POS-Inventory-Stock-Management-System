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
            <h2 class="name"><?php echo e(__('pages.sells_report')); ?></h2>
            <div class="address">
                <?php echo e(__('pages.filter_by')); ?>:- <?php echo e(__('pages.branch')); ?>: <?php echo e($filter_by['branch_name']); ?>,
                <?php echo e(__('pages.product')); ?>: <?php echo e($filter_by['product_name']); ?> ,
                <?php echo e(__('pages.date_range')); ?>: <?php echo e($filter_by['start_date']); ?> to <?php echo e($filter_by['end_date']); ?>,
            </div>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
        <thead>
        <tr class="bg-secondary text-white">
            <th><?php echo e(__('pages.sl')); ?></th>
            <th><?php echo e(__('pages.product')); ?></th>
            <th><?php echo e(__('pages.sell_price')); ?></th>
            <th><?php echo e(__('pages.quantity')); ?></th>
            <th><?php echo e(__('pages.total_sell_price')); ?></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                $total_sell_price = 0;
                $total_quantity = 0;
                $grand_total_price = 0;
            ?>
            <?php $__currentLoopData = $sell_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sell_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i); ?></td>
                    <td>
                        <a href="<?php echo e(route('product.show', [$key])); ?>">
                            <?php echo e($sell_product[0]->product->title); ?>

                        </a>
                    </td>
                    <td><?php echo e(get_option('app_currency')); ?> <?php echo e($sell_product->sum('sell_price')); ?></td>
                    <td><?php echo e($sell_product->sum('quantity')); ?></td>
                    <td><?php echo e(get_option('app_currency')); ?> <?php echo e($sell_product->sum('total_price')); ?></td>
                </tr>
                <?php
                    $i ++;
                    $total_sell_price +=  $sell_product->sum('sell_price');
                    $total_quantity +=  $sell_product->sum('quantity');
                    $grand_total_price +=  $sell_product->sum('total_price');
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td colspan="2" class="text-right"><?php echo e(__('pages.total')); ?></td>
                <td><strong><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($total_sell_price, 2)); ?></strong></td>
                <td><strong><?php echo e($total_quantity); ?></strong></td>
                <td><strong><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($grand_total_price, 2)); ?></strong></td>
            </tr>
        </tbody>
    </table>


</main>
<?php echo $__env->make('backend.pdf.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/pdf/reports/sells/product-wise-sell-report.blade.php ENDPATH**/ ?>