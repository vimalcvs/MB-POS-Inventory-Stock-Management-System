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
                <td><?php echo e($sell_product->sum('quantity')); ?></td>
                <td><?php echo e(get_option('app_currency')); ?><?php echo e($sell_product->sum('total_price')); ?></td>
            </tr>
            <?php
                $i ++;
                $total_quantity +=  $sell_product->sum('quantity');
                $grand_total_price +=  $sell_product->sum('total_price');
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <tr>
            <td colspan="2" class="text-right"><b><?php echo e(__('pages.total')); ?> :</b></td>
            <td><strong><?php echo e($total_quantity); ?></strong></td>
            <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($grand_total_price, 2)); ?></strong></td>
        </tr>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/report/sell/product-wise/table-data.blade.php ENDPATH**/ ?>