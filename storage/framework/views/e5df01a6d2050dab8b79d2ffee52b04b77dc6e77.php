<div class="row pt-2 ml-0 mr-0 bg-primary">
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

    <div class="col-md-2 pr-0">
        <div class="form-group text-left">
            <select name="supplier_id" class="form-control select2">
                <option value=""><?php echo e(__('pages.all_supplier')); ?></option>
                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($supplier->id); ?>" <?php echo e(Request::get('supplier_id') == $supplier->id ? 'selected': ''); ?>> <?php echo e($supplier->company_name); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <select name="branch_id" class="form-control select2">
                    <option value=""><?php echo e(__('pages.all_branch')); ?></option>
                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($branch->id); ?>" <?php echo e(Request::get('branch_id') == $branch->id ? 'selected': ''); ?>><?php echo e($branch->title); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    <?php else: ?>
        <input type="hidden" name="branch_id" value="<?php echo e(auth()->user()->employee->branch_id); ?>">
    <?php endif; ?>


    <div class="col-md-2 pr-0">
        <div class="form-group text-left">
            <select name="by_duration" class="form-control select2">
                <option value="Y-m-d" <?php echo e(Request::get('by_duration') == 'Y-m-d' ? 'selected': ''); ?>><?php echo e(__('pages.daily')); ?></option>
                <option value="Y-W" <?php echo e(Request::get('by_duration') == 'Y-W' ? 'selected': ''); ?>><?php echo e(__('pages.weekly')); ?></option>
                <option value="Y-M" <?php echo e(Request::get('by_duration') == 'Y-M' ? 'selected': ''); ?>><?php echo e(__('pages.monthly')); ?></option>
                <option value="Y" <?php echo e(Request::get('by_duration') == 'Y' ? 'selected': ''); ?>><?php echo e(__('pages.yearly')); ?></option>
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <button class="btn btn-warning btn-block"><?php echo e(__('pages.search')); ?></button>
        </div>
    </div>
</div>
<?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/report/purchase/summary/filter-from.blade.php ENDPATH**/ ?>