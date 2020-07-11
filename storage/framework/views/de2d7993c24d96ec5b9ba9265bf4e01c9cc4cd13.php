<?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <table class="table table-bordered text-center" width="100%" cellspacing="0">
        <thead>
            <tr class="bg-secondary text-white">
                <th colspan="9"><?php echo e($key); ?></th>
            </tr>
            <tr class="bg-secondary text-white">
                <th><?php echo e(__('pages.sl')); ?></th>
                <th><?php echo e(__('pages.invoice_id')); ?></th>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                    <th><?php echo e(__('pages.branch')); ?></th>
                <?php endif; ?>
                <th><?php echo e(__('pages.supplier')); ?></th>
                <th><?php echo e(__('pages.purchase_date')); ?></th>
                <th><?php echo e(__('pages.total_amount')); ?></th>
                <th><?php echo e(__('pages.paid_amount')); ?></th>
                <th><?php echo e(__('pages.due_amount')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $total_grand_total_amount = 0;
                $total_paid_amount = 0;
                $total_due_amount = 0;
            ?>
            <?php $__currentLoopData = $purchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $single_purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td>
                        <a href="<?php echo e(route('purchase.show', [$single_purchase->id])); ?>" target="_blank"><?php echo e($single_purchase->invoice_id); ?></a>
                    </td>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                        <td><?php echo e($single_purchase->branch->title); ?></td>
                    <?php endif; ?>
                    <td><?php echo e($single_purchase->supplier->company_name); ?></td>
                    <td><?php echo e($single_purchase->purchase_date->format(get_option('app_date_format'))); ?></td>
                    <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($single_purchase->total_amount, 2)); ?> </td>
                    <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($single_purchase->paid_amount, 2)); ?> </td>
                    <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($single_purchase->due_amount, 2)); ?> </td>
                </tr>

                <?php
                    $total_grand_total_amount += $single_purchase->total_amount;
                    $total_paid_amount += $single_purchase->paid_amount;
                    $total_due_amount += $single_purchase->due_amount;
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            <tr>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                    <td colspan="5" class="text-right pr-3"><strong><?php echo e(__('pages.total')); ?></strong></td>
                <?php else: ?>
                    <td colspan="4" class="text-right pr-3"><strong><?php echo e(__('pages.total')); ?></strong></td>
                <?php endif; ?>
                <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_grand_total_amount, 2)); ?></strong></td>
                <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_paid_amount, 2)); ?></strong></td>
                <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_due_amount, 2)); ?></strong></td>
            </tr>
        </tbody>
    </table>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/report/purchase/summary/table-data.blade.php ENDPATH**/ ?>