<form action="<?php echo e(route('payment-to-supplier-filter')); ?>" method="get">
    <div class="row p-0">
        <div class="col-md-3 pr-0">
            <div class="form-group text-left">
                <select name="supplier_id" class="form-control select2">
                    <option value=""><?php echo e(__('pages.all_supplier')); ?></option>
                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($supplier->id); ?>" <?php echo e(Request::get('supplier_id') == $supplier->id ? 'selected' : ''); ?>><?php echo e($supplier->company_name); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
            <div class="col-md-3">
                <div class="form-group text-left">
                    <select name="branch_id" class="form-control select2">
                        <option value=""><?php echo e(__('pages.all_branch')); ?></option>
                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($branch->id); ?>" <?php echo e(Request::get('branch_id') == $branch->id ? 'selected' : ''); ?>><?php echo e($branch->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        <?php else: ?>
            <input type="hidden" name="branch_id" value="<?php echo e(auth()->user()->employee->branch_id); ?>">
        <?php endif; ?>

        <div class="col-md-2 pr-0">
            <div class="form-group text-left">
                <input type="text" name="start_date" value="<?php echo e(Request::get('start_date')); ?>" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.start_date')); ?>" autocomplete="off">
            </div>
        </div>

        <div class="col-md-2 pl-0">
            <div class="form-group text-left">
                <input type="text" name="end_date" value="<?php echo e(Request::get('end_date')); ?>" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.end_date')); ?>" autocomplete="off">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <button class="btn btn-secondary btn-block"><?php echo e(__('pages.search')); ?></button>
            </div>
        </div>
    </div>
</form><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/payment/supplier/filter-from.blade.php ENDPATH**/ ?>