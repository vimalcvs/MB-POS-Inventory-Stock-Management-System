<?php $__env->startSection('title'); ?> <?php echo e(__('pages.expense')); ?>  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.create_expense')); ?></h6>
                        <a href="<?php echo e(route('expense.index')); ?>" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-2"></i> <?php echo e(__('pages.expense_list')); ?></a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body min-height-550">
                        <form action="<?php echo e(route('expense.store')); ?>" method="post" data-parsley-validate>
                            <?php echo csrf_field(); ?>

                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="expense_date"><?php echo e(__('pages.expense_date')); ?> <span class="text-danger">*</span></label>
                                                <input name="expense_date" value="<?php echo e(old('expense_date') ? old('expense_date') : \Carbon\Carbon::now()->format('Y-m-d')); ?>" id="expense_date" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.expense_date')); ?>" required autocomplete="off">
                                                <?php if($errors->has('expense_date')): ?>
                                                    <div class="error"><?php echo e($errors->first('expense_date')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="expense_category_id"><?php echo e(__('pages.expense_category')); ?> <span class="text-danger">*</span></label>
                                                <select name="expense_category_id" id="expense_category_id" class="form-control select2">
                                                    <option value=""><?php echo e(__('pages.select_category')); ?></option>
                                                    <?php $__currentLoopData = $expense_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($expense_category->id); ?>" <?php echo e(old('expense_category_id') == $expense_category->id ? 'selected' : ''); ?>><?php echo e($expense_category->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                <?php if($errors->has('expense_category_id')): ?>
                                                    <div class="error mt-1"><?php echo e($errors->first('expense_category_id')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="amount"><?php echo e(__('pages.amount')); ?> <span class="text-danger">*</span></label>
                                                <input type="number" name="amount" step=".1" min="0" id="amount" value="<?php echo e(old('amount')); ?>" placeholder="<?php echo e(__('pages.amount')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                                <?php if($errors->has('amount')): ?>
                                                    <div class="error"><?php echo e($errors->first('amount')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="note"><?php echo e(__('pages.note')); ?></label>
                                                <textarea name="note" placeholder="Short Note" class="form-control"><?php echo e(old('note')); ?></textarea>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/expense/create.blade.php ENDPATH**/ ?>