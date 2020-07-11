<div class="row pt-2 ml-0 mr-0 bg-primary">

    <div class="col-md-3 pr-0">
        <div class="form-group text-left">
            <select name="product_id" class="form-control select2">
                <option value=""><?php echo e(__('pages.all_product')); ?></option>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>" <?php echo e(Request::get('product_id') == $product->id ? 'selected': ''); ?>><?php echo e($product->title); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
        <div class="col-md-2">
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
            <input type="text" name="start_date" data-date-format="yyyy-mm-dd" value="<?php echo e(Request::get('start_date')); ?>" class="datepicker form-control" placeholder="<?php echo e(__('pages.start_date')); ?>" autocomplete="off">
        </div>
    </div>

    <div class="col-md-2 pl-0">
        <div class="form-group text-left">
            <input type="text" name="end_date" data-date-format="yyyy-mm-dd" value="<?php echo e(Request::get('end_date')); ?>" class="datepicker form-control" placeholder="<?php echo e(__('pages.end_date')); ?>" autocomplete="off">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <button class="btn btn-warning btn-block"><?php echo e(__('pages.search')); ?></button>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/report/sell/product-wise/filter-from.blade.php ENDPATH**/ ?>