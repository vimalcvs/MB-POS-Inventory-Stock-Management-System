<div class="col-md-5 pr-0">
    <form action="<?php echo e(url('report/sell/statistics-filter')); ?>" method="get">
        <div class="d-flex">
            <input type="hidden" name="search_type" value="month">
            <div class="float-left">
                <div class="form-group text-left">
                    <input type="text" name="month" data-date-format="yyyy-M"  value="<?php echo e(Request::get('month')); ?>"  placeholder="<?php echo e(__('pages.select_month')); ?>" id="datepicker" class="form-control" autocomplete="off">
                </div>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                <div class="float-left pl-2">
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



            <div class="form-group pl-2">
                <button class="btn btn-warning btn-block"><?php echo e(__('pages.search')); ?></button>
            </div>
        </div>
    </form>
</div>

<div class="col-md-5 pr-0">
    <form action="<?php echo e(url('report/sell/statistics-filter')); ?>" method="get">
        <div class="d-flex">
            <input type="hidden" name="search_type" value="year">
            <div class="float-left">
                <div class="form-group text-left">
                    <input type="text" name="year" data-date-format="yyyy"  value="<?php echo e(Request::get('year')); ?>"  placeholder="<?php echo e(__('pages.select_year')); ?>" id="yearPicker" class="form-control" autocomplete="off">
                </div>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                <div class="float-left pl-2">
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

            <div class="form-group pl-2">
                <button class="btn btn-warning btn-block"><?php echo e(__('pages.search')); ?></button>
            </div>
        </div>
    </form>
</div>

<div class="col-md-2 text-right">
    <?php echo $__env->make('backend.report.sell.statistics.more-filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/report/sell/statistics/filter-from.blade.php ENDPATH**/ ?>