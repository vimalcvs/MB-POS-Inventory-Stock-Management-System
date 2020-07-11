<table class="table table-bordered text-center" width="100%" cellspacing="0">
    <thead>
    <tr class="bg-secondary text-white">
        <th><?php echo e(__('pages.sl')); ?></th>
        <th><?php echo e(__('pages.product')); ?></th>
        <th><?php echo e(__('pages.quantity')); ?></th>
        <th><?php echo e(__('pages.total_price')); ?></th>
    </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            $total_purchase_price = 0;
            $total_quantity = 0;
            $grand_total_price = 0;
        ?>
        <?php $__currentLoopData = $purchase_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $purchase_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i); ?></td>
                <td>
                    <a href="<?php echo e(route('product.show', [$key])); ?>">
                        <?php echo e($purchase_product[0]->product->title); ?>

                    </a>
                </td>
                <td><?php echo e($purchase_product->sum('quantity')); ?></td>
                <td><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($purchase_product->sum('total_price'),2)); ?></td>
            </tr>
            <?php
                $i ++;
                $total_purchase_price +=  $purchase_product->sum('purchase_price');
                $total_quantity +=  $purchase_product->sum('quantity');
                $grand_total_price +=  $purchase_product->sum('total_price');
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <tr>
            <td colspan="2" class="text-right"><strong><?php echo e(__('pages.total')); ?></strong></td>
            <td><strong><?php echo e($total_quantity); ?></strong></td>
            <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($grand_total_price, 2)); ?></strong></td>
        </tr>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/report/purchase/product-wise/table-data.blade.php ENDPATH**/ ?>