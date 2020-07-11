<table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
    <thead>
    <tr class="bg-secondary text-white">
        <th><?php echo e(__('pages.sl')); ?></th>
        <th><?php echo e(__('pages.requisition_id')); ?></th>
        <th> <?php echo e(__('pages.from')); ?></th>
        <th> <?php echo e(__('pages.to')); ?></th>
        <th><?php echo e(__('pages.created_date')); ?></th>
        <th width="10%"><?php echo e(__('pages.status')); ?></th>
        <th width="8%"><?php echo e(__('pages.action')); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $requisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($key+1); ?></td>
            <td><?php echo e($requisition->requisition_id); ?></td>
            <td><?php echo e($requisition->requisitionFrom->title); ?></td>
            <td><?php echo e($requisition->requisitionTo->title); ?></td>
            <td>
                <?php echo e($requisition->requisition_date->format(get_option('app_date_format'))); ?>

            </td>
            <td>
                <?php if($requisition->status == 0): ?>
                    <label class="btn btn-warning btn-sm btn-block"><b>Pending</b></label>
                <?php elseif($requisition->status == 1): ?>
                    <label class="btn btn-info btn-sm btn-block"><b>Delivered</b></label>
                <?php elseif($requisition->status == 2): ?>
                    <label class="btn btn-success btn-sm btn-block"><b>Complete</b></label>
                <?php elseif($requisition->status == 3): ?>
                    <label class="btn btn-danger btn-sm btn-block"><b>Rejected</b></label>
                <?php else: ?>
                    <label class="btn btn-danger btn-sm btn-block"><b>Canceled</b></label>
                <?php endif; ?>
            </td>
            <td>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a href="<?php echo e(route('requisition.show', [$requisition->id])); ?>" class="btn btn-secondary rounded-0"><i class="fa fa-eye"></i> </a>
                    <?php if($requisition->requisition_from == auth()->user()->employee->branch_id && $requisition->status == 0): ?>
                        <a href="<?php echo e(route('requisition.edit', [$requisition->id])); ?>" class="btn btn-primary rounded-0"><i class="fa fa-edit"></i> <?php echo e($requisition->sttaus); ?> </a>
                        <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>')) " class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        <form action="<?php echo e(route('requisition.destroy',$requisition->id)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/requisition/data.blade.php ENDPATH**/ ?>