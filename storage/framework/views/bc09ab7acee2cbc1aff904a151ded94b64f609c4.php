<?php $__env->startSection('title'); ?> <?php echo e(__('pages.payment')); ?>  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary ml-1"><?php echo e(__('pages.new_payment')); ?></h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body min-height-550">
                        <form action="<?php echo e(route('payment-to-supplier.store')); ?>" method="post" data-parsley-validate>
                            <?php echo csrf_field(); ?>

                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="payment_date"><?php echo e(__('pages.payment_date')); ?> <span class="text-danger">*</span></label>
                                                <input name="payment_date" value="<?php echo e(old('payment_date') ? old('payment_date') : \Carbon\Carbon::now()->format('Y-m-d')); ?>" id="payment_date" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.date')); ?>" required autocomplete="off">
                                                <?php if($errors->has('payment_date')): ?>
                                                    <div class="error"><?php echo e($errors->first('payment_date')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="supplier_id"><?php echo e(__('pages.supplier')); ?> <span class="text-danger">*</span></label>
                                                <select name="supplier_id" id="supplier_id" class="form-control select2">
                                                    <option value=""><?php echo e(__('pages.select_supplier')); ?></option>
                                                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($supplier->id); ?>" <?php echo e(old('supplier_id') == $supplier->id ? 'selected' : ''); ?>><?php echo e($supplier->company_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span id="supplierTotalDue" class="mt-3 text-danger"></span>

                                                <?php if($errors->has('supplier_id')): ?>
                                                    <div class="error mt-1"><?php echo e($errors->first('supplier_id')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="amount"><?php echo e(__('pages.amount')); ?> <span class="text-danger">*</span></label>
                                                <input type="number" id="amount" name="amount"  min="0" step=".1" id="amount" value="<?php echo e(old('amount')); ?>" placeholder="<?php echo e(__('pages.amount')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                                <?php if($errors->has('amount')): ?>
                                                    <div class="error"><?php echo e($errors->first('amount')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="note"><?php echo e(__('pages.note')); ?></label>
                                                <textarea name="note" class="form-control"><?php echo e(old('note')); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mt-2">
                                                <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('pages.save')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <input type="hidden" value="<?php echo e(url('/')); ?>" id="banseURL">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('/backend/js/partial/create-payment-to-supplier.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/payment/supplier/create.blade.php ENDPATH**/ ?>