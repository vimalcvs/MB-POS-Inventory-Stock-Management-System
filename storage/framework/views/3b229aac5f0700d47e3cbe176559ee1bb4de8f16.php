<?php $__env->startSection('title'); ?> <?php echo e(__('pages.sell_target')); ?>  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.update_sell_target')); ?></h6>
                        <a href="<?php echo e(route('branch-sells-target.index')); ?>" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-2"></i> <?php echo e(__('pages.sell_targets')); ?></a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="<?php echo e(route('branch-sells-target.update', [\Carbon\Carbon::parse($sell_targets[0]->month)->format('Y-m')])); ?>" method="post" data-parsley-validate>
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="month"><?php echo e(__('pages.select_month')); ?><span class="text-danger">*</span></label>
                                        <input type="text" name="month" data-date-format="yyyy-M" value="<?php echo e(\Carbon\Carbon::parse($sell_targets[0]->month)->format('Y-F')); ?>"  placeholder="<?php echo e(__('pages.select_month')); ?>" id="monthpicker" class="form-control" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <?php $__currentLoopData = $sell_targets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="branch_id[]" value="<?php echo e($sell_target->branch_id); ?>" class="form-control" required>
                                            <input type="text" value="<?php echo e($sell_target->branch->title); ?>" class="form-control" required readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" name="target_amount[]" placeholder="Target Amount" step="1" min="1" value="<?php echo e($sell_target->target_amount); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            <div class="row">
                                <div class="col-md-2 offset-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('pages.update')); ?></button>
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
    <script src="<?php echo e(asset('/backend/js/custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/sells-target/edit.blade.php ENDPATH**/ ?>