<form action="<?php echo e(route('requisition-filter')); ?>" method="get">
    <div class="row p-0">
        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <input type="text" name="invoice" class="form-control" placeholder="<?php echo e(__('pages.requisition_id')); ?>">
            </div>
        </div>

        <?php if(Auth::user()->can('access_to_all_branch')): ?>
            <div class="col-md-2 pr-0">
                <div class="form-group text-left">
                        <select name="requisition_from" class="form-control select2">
                            <option value=""><?php echo e(__('pages.requisition_form')); ?></option>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($branch->id); ?>" <?php echo e(Request::get('requisition_from') == $branch->id ? 'selected' : ''); ?>><?php echo e($branch->title); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                </div>
            </div>
        <?php else: ?>
            <input type="hidden" name="requisition_from" value="<?php echo e(auth()->user()->employee->branch_id); ?>">
        <?php endif; ?>

        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <select name="requisition_to" class="form-control select2">
                    <option value=""><?php echo e(__('pages.requisition_to')); ?></option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->id); ?>" <?php echo e(Request::get('requisition_to') == $branch->id ? 'selected' : ''); ?>><?php echo e($branch->title); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <input type="text" name="start_date" data-date-format="yyyy-mm-dd" value="<?php echo e(Request::get('start_date')); ?>" class="datepicker form-control" placeholder="<?php echo e(__('pages.start_date')); ?>" autocomplete="off">
            </div>
        </div>

        <div class="col-md-2 pl-0">
            <div class="form-group text-left">
                <input type="text" name="end_date" data-date-format="yyyy-mm-dd" value="<?php echo e(Request::get('end_date')); ?>" class="datepicker form-control" placeholder="<?php echo e(__('pages.end_date')); ?>" autocomplete="off">
            </div>
        </div>

        <div class="col-md-2 pl-0">
            <div class="form-group text-left">
                <select name="status" class="form-control select2">
                    <option value=""><?php echo e(__('pages.select_one')); ?></option>
                    <option value="0" <?php echo e(Request::get('status') ? Request::get('status') == 0 ? 'selected' : '' : ''); ?>><?php echo e(__('pages.pending')); ?> </option>
                    <option value="1" <?php echo e(Request::get('status') == 1 ? 'selected' : ''); ?>><?php echo e(__('pages.delivered')); ?> </option>
                    <option value="2" <?php echo e(Request::get('status') == 2 ? 'selected' : ''); ?>><?php echo e(__('pages.complete')); ?> </option>
                    <option value="3" <?php echo e(Request::get('status') == 3 ? 'selected' : ''); ?>><?php echo e(__('pages.rejected')); ?> </option>
                    <option value="4" <?php echo e(Request::get('status') == 4 ? 'selected' : ''); ?>><?php echo e(__('pages.canceled')); ?> </option>
                </select>
            </div>
        </div>

        <?php if(Auth::user()->can('access_to_all_branch')): ?>
            <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-secondary btn-block"><?php echo e(__('pages.search')); ?></button>
                </div>
            </div>
        <?php else: ?>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-secondary btn-block"><?php echo e(__('pages.search')); ?></button>
                </div>
            </div>
        <?php endif; ?>

    </div>
</form><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/requisition/filter-form.blade.php ENDPATH**/ ?>