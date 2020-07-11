<?php $__currentLoopData = $sells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <table class="table table-bordered text-center" width="100%" cellspacing="0">
        <thead>
        <tr class="bg-secondary text-white">
            <th colspan="9">
                <?php if(Request::get('by_duration') == 'Y-m-d' or Request::get('by_duration') == ''): ?>
                    <?php echo e(\Carbon\Carbon::parse($key)->format(get_option('app_date_format'))); ?>

                <?php else: ?>
                    <?php echo e($key); ?>

                <?php endif; ?>
            </th>
        </tr>
        <tr class="bg-secondary text-white">
            <th><?php echo e(__('pages.sl')); ?></th>
            <th><?php echo e(__('pages.invoice_id')); ?></th>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                <th><?php echo e(__('pages.branch')); ?></th>
            <?php endif; ?>

            <?php if(Request::get('by_duration') != 'Y-m-d'): ?>
            <th><?php echo e(__('pages.sell_date')); ?></th>
            <?php endif; ?>

            <th><?php echo e(__('pages.sub_total')); ?></th>
            <th><?php echo e(__('pages.discount')); ?></th>
            <th><?php echo e(__('pages.grand_total')); ?></th>
            <th><?php echo e(__('pages.paid_amount')); ?></th>
            <th><?php echo e(__('pages.due_amount')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
            $total_sub_total = 0;
            $total_discount = 0;
            $total_grand_total_price = 0;
            $total_paid_amount = 0;
            $total_due_amount = 0;
        ?>
        <?php $__currentLoopData = $sell; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $single_sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($key + 1); ?></td>
                <td>
                    <a href="<?php echo e(route('sell.show', [$single_sell->id])); ?>" target="_blank"><?php echo e($single_sell->invoice_id); ?></a>
                </td>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                    <td><?php echo e($single_sell->branch->title); ?></td>
                <?php endif; ?>

                <?php if(Request::get('by_duration') != 'Y-m-d'): ?>
                <td><?php echo e($single_sell->sell_date->format(get_option('app_date_format'))); ?></td>
                <?php endif; ?>

                <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($single_sell->sub_total, 2)); ?> </td>
                <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($single_sell->discount, 2)); ?> </td>
                <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($single_sell->grand_total_price, 2)); ?> </td>
                <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($single_sell->paid_amount, 2)); ?> </td>
                <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($single_sell->due_amount, 2)); ?> </td>
            </tr>

            <?php
                $total_sub_total += $single_sell->sub_total;
                $total_discount += $single_sell->discount;
                $total_grand_total_price += $single_sell->grand_total_price;
                $total_paid_amount += $single_sell->paid_amount;
                $total_due_amount += $single_sell->due_amount;
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <tr>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                <td colspan="<?php echo e(Request::get('by_duration') == 'Y-m-d' ? 3 : 4); ?>" class="text-right pr-3"><strong>Total</strong></td>
            <?php else: ?>
                <td colspan="<?php echo e(Request::get('by_duration') == 'Y-m-d' ? 2 : 3); ?>" class="text-right pr-3"><strong>Total</strong></td>
            <?php endif; ?>
            <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_sub_total, 2)); ?></strong></td>
            <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_discount, 2)); ?></strong></td>
            <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_grand_total_price, 2)); ?></strong></td>
            <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_paid_amount, 2)); ?></strong></td>
            <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_due_amount, 2)); ?></strong></td>
        </tr>
        </tbody>
    </table>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/report/sell/summary/table-data.blade.php ENDPATH**/ ?>