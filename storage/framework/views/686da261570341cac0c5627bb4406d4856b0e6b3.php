<?php $__env->startSection('title'); ?> Currency Settings <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        <?php echo $__env->make('backend.settings.partial.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-5">
                        <form action="<?php echo e(route('save-application-setting')); ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
                            <?php echo csrf_field(); ?>
                            <div class="row p-5 justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="app_currency" class="form-control select2">
                                            <option value="$" <?php echo e(get_option('app_currency') == '$' ? 'selected' : ''); ?>  > $ USD</option>
                                            <option value="€" <?php echo e(get_option('app_currency') == '€' ? 'selected' : ''); ?>  >€ (Euro)</option>
                                            <option value="BDT" <?php echo e(get_option('app_currency') == 'BDT' ? 'selected' : ''); ?>  >BDT</option>
                                            <option value="Rs." <?php echo e(get_option('app_currency') == 'Rs.' ? 'selected' : ''); ?>  >Rs (Indian Rupee)</option>
                                            <option value="£" <?php echo e(get_option('app_currency') == '£' ? 'selected' : ''); ?>  >£ (Pound)</option>
                                        </select>

                                        <?php if($errors->has('currency')): ?>
                                            <div class="error"><?php echo e($errors->first('currency')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Save & Update</button>
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/settings/currency.blade.php ENDPATH**/ ?>