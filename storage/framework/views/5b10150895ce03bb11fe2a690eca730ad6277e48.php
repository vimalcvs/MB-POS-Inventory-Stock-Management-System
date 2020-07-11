<table class="table table-bordered mb-5 mt-5 w-75 text-center m-0-auto-mb-pos">
    <thead>
        <tr class="bg-secondary text-white">
            <th scope="col"><?php echo e(__('pages.sl')); ?></th>
            <th scope="col"><?php echo e(__('pages.date')); ?></th>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                <th><?php echo e(__('pages.branch')); ?></th>
            <?php endif; ?>
            <th scope="col"><?php echo e(__('pages.total_amount')); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $grand_total_amount = 0;
        ?>
        <?php for($d=0; $d < count($purchase_info); $d++): ?>
            <tr>
                <th scope="row"><?php echo e($d + 1); ?></th>
                <td>
                    <?php if(Request::get('year')): ?><?php echo e(Request::get('year')); ?> ,<?php endif; ?>

                    <?php if(Request::get('search_type') != 'year'): ?>
                        <?php echo e(\Carbon\Carbon::parse($purchase_info[$d]['purchase_date'])->format(get_option('app_date_format'))); ?>

                    <?php else: ?>
                        <?php echo e($purchase_info[$d]['purchase_date']); ?>

                    <?php endif; ?>
                </td>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                <td>
                    <?php if(Request::get('branch_id')): ?>
                        <?php echo e(\App\Models\Branch::findOrFail(Request::get('branch_id'))->title); ?>

                    <?php else: ?>
                        All
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <td><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase_info[$d]['total_purchase_amount'], 2)); ?></td>
                <?php
                    $grand_total_amount += $purchase_info[$d]['total_purchase_amount'];
                ?>
            </tr>
        <?php endfor; ?>
        <tr>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                <td colspan="3" class="text-right pr-2"><strong><?php echo e(__('pages.grand_total')); ?></strong></td>
            <?php else: ?>
                <td colspan="2" class="text-right pr-2"><strong><?php echo e(__('pages.grand_total')); ?></strong></td>
            <?php endif; ?>
            <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($grand_total_amount, 2)); ?></strong></td>
        </tr>
    </tbody>
</table>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/report/purchase/statistics/table-data.blade.php ENDPATH**/ ?>