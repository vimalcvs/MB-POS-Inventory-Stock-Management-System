<div class="table-responsive">
    <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
        <thead>
        <tr class="bg-secondary text-white">
            <th><?php echo e(__('pages.sl')); ?></th>
            <th><?php echo e(__('pages.invoice_id')); ?></th>
            <th><?php echo e(__('pages.date')); ?></th>
            <?php if(Auth::user()->can('access_to_all_branch')): ?>
                <th><?php echo e(__('pages.branch')); ?></th>
            <?php endif; ?>
            <th><?php echo e(__('pages.supplier')); ?></th>
            <th><?php echo e(__('pages.total_amount')); ?></th>
            <th><?php echo e(__('pages.paid_amount')); ?></th>
            <th><?php echo e(__('pages.due_amount')); ?></th>
            <th width="8%"><?php echo e(__('pages.action')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($purchase->invoice_id); ?></td>
                <td><?php echo e($purchase->purchase_date->format(get_option('app_date_format'))); ?></td>
                <?php if(Auth::user()->can('access_to_all_branch')): ?>
                    <td>
                        <?php echo e($purchase->branch->title); ?>

                    </td>
                <?php endif; ?>
                <td><?php echo e($purchase->supplier->company_name); ?></td>
                <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->total_amount, 2)); ?> </td>
                <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->paid_amount, 2)); ?> </td>
                <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->due_amount, 2)); ?> </td>
                <td class="font-14">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a href="<?php echo e(route('purchase.edit', [$purchase->id])); ?>" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                        <a href="<?php echo e(route('purchase.show', [$purchase->id])); ?>" class="mr-2"><i class="fa fa-eye text-primary"></i> </a>
                        <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>')) " class=""><i class="fa fa-trash text-danger"></i></a>
                        <form action="<?php echo e(route('purchase.destroy',$purchase->id)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($purchases->links()); ?>

</div><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/purchase/purchases-data.blade.php ENDPATH**/ ?>