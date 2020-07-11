<form action="<?php echo e(route('payment-from-customer-filter')); ?>" method="get">
    <div class="row p-0">
        <div class="col-md-3 pr-0">
            <div class="form-group text-left">
                <select name="customer_id" class="form-control select2">
                    <option value=""><?php echo e(__('pages.all_customer')); ?></option>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->id); ?>" <?php echo e(Request::get('customer_id') == $customer->id ? 'selected' : ''); ?>><?php echo e($customer->name); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="col-md-3 pr-0">
            <div class="form-group text-left">
                <input type="text" name="start_date" value="<?php echo e(Request::get('start_date')); ?>" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.start_date')); ?>" autocomplete="off">
            </div>
        </div>

        <div class="col-md-3 pl-0">
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
</form><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/payment/customer/filter-from.blade.php ENDPATH**/ ?>