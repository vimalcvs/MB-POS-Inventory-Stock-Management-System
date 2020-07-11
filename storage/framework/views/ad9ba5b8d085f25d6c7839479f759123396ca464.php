<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Stock Report</title>
    <?php echo $__env->make('backend.pdf.layouts.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body >
<?php echo $__env->make('backend.pdf.layouts.report-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<main>
    <div id="details" class="clearfix">
        <div id="client"class="mt-10">
            <h2 class="name"><?php echo e(__('pages.stock_report')); ?></h2>
            <div class="address">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                    <?php echo e(__('pages.branch')); ?>: <?php echo e(__('pages.all_branch')); ?>,
                <?php else: ?>
                    <?php echo e(__('pages.branch')); ?>: <?php echo e(auth()->user()->employee->branch->title); ?>,
                <?php endif; ?>
                    <?php echo e(__('pages.date')); ?>: <?php echo e(\Carbon\Carbon::now()->format(get_option('app_date_format'))); ?>

            </div>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
        <thead>
        <tr class="bg-secondary text-white">
            <th width="2%"><?php echo e(__('pages.sl')); ?></th>
            <th><?php echo e(__('pages.product_title')); ?></th>
            <th width="15%"><?php echo e(__('pages.purchase_qty')); ?></th>
            <th width="15%"><?php echo e(__('pages.sell_qty')); ?> </th>
            <th width="15%"><?php echo e(__('pages.current_stock_qty')); ?></th>
            <th width="18%"><?php echo e(__('pages.current_stock_amount')); ?> <sub>(Apx)</sub></th>
        </tr>
        </thead>
        <tbody>

        <?php
            $total_purchase_qty = 0;
            $total_sell_qty = 0;
            $total_current_stock_qty = 0;
            $total_current_stock_amount = 0;
        ?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($product->title); ?> | <?php echo e($product->sku); ?></td>
                <td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                        <?php echo e($product->purchaseProducts->sum('quantity')); ?>

                    <?php else: ?>
                        <?php echo e($product->purchaseProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity')); ?>

                    <?php endif; ?>
                </td>

                <td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                        <?php echo e($product->sellProducts->sum('quantity')); ?>

                    <?php else: ?>
                        <?php echo e($product->sellProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity')); ?>

                    <?php endif; ?>
                </td>

                <td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                        <?php
                            $current_stock_qty = $product->purchaseProducts->sum('quantity') - $product->sellProducts->sum('quantity');
                        ?>
                    <?php else: ?>
                        <?php
                            $current_stock_qty =  productAvailableTransactionStockQty($product->id)
                        ?>
                    <?php endif; ?>

                    <?php echo e($current_stock_qty); ?>

                </td>
                <td>
                    <?php
                        $product_tax = $product->sell_price * $product->tax->value / 100;
                        $current_stock_amount = $current_stock_qty * ($product->sell_price + $product_tax);
                    ?>

                    <?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($current_stock_amount,2)); ?>

                </td>
            </tr>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                <?php
                    $total_purchase_qty += $product->purchaseProducts->sum('quantity');
                    $total_sell_qty += $product->sellProducts->sum('quantity');
                ?>
            <?php else: ?>
                <?php
                    $total_purchase_qty += $product->purchaseProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity');
                    $total_sell_qty += $product->sellProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity');
                ?>
            <?php endif; ?>


            <?php
                $total_current_stock_qty += $current_stock_qty;
                $total_current_stock_amount += $current_stock_amount;
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td colspan="2" class="text-right pr-3"><b><?php echo e(__('pages.total')); ?>: </b></td>
            <td><b><?php echo e($total_purchase_qty); ?></b></td>
            <td><b><?php echo e($total_sell_qty); ?></b></td>
            <td><b><?php echo e($total_current_stock_qty); ?></b></td>
            <td><b><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($total_current_stock_amount,2)); ?></b></td>
        </tr>
        </tbody>
    </table>


</main>
<?php echo $__env->make('backend.pdf.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/pdf/reports/stock/all-branch.blade.php ENDPATH**/ ?>