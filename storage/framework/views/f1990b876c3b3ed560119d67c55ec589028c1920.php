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
                                            <option value="$" <?php echo e(get_option('app_currency') == '$' ? 'selected' : ''); ?>  > $ </option>
                                            <option value="€" <?php echo e(get_option('app_currency') == '€' ? 'selected' : ''); ?>  >€ (Euro)</option>
                                            <option value="BDT" <?php echo e(get_option('app_currency') == 'BDT' ? 'selected' : ''); ?>  >BDT</option>
                                            <option value="Rs." <?php echo e(get_option('app_currency') == 'Rs.' ? 'selected' : ''); ?>  >Rs (Indian Rupee)</option>
                                            <option value="£" <?php echo e(get_option('app_currency') == '£' ? 'selected' : ''); ?>  >£ (Pound)</option>
                                            <option value="Rp" <?php echo e(get_option('app_currency') == 'Rp' ? 'selected' : ''); ?>  >Rp (Indonesia Rupiah)</option>
                                            <option value="¥" <?php echo e(get_option('app_currency') == '¥' ? 'selected' : ''); ?>  >¥ (Japan Yen)</option>
                                            <option value="kr" <?php echo e(get_option('app_currency') == 'kr' ? 'selected' : ''); ?>  >kr (Sweden Krona)</option>
                                            <option value="CHF" <?php echo e(get_option('app_currency') == 'CHF' ? 'selected' : ''); ?>  >CHF (CHF)</option>
                                            <option value="TRY" <?php echo e(get_option('app_currency') == 'TRY' ? 'selected' : ''); ?>  >TRY (Turkish lira)</option>
                                            <option value="E£" <?php echo e(get_option('app_currency') == 'E£' ? 'selected' : ''); ?>  >E£ (Egyptian Pound)</option>
                                            <option value="RM" <?php echo e(get_option('app_currency') == 'RM' ? 'selected' : ''); ?>  >RM (Malaysian Ringgit)</option>
                                            <option value="KSh" <?php echo e(get_option('app_currency') == 'KSh' ? 'selected' : ''); ?>  >KSh (Kenyan Shilling)</option>
                                            <option value="KHR" <?php echo e(get_option('app_currency') == 'KHR' ? 'selected' : ''); ?>  >KHR (Cambodian Riel)</option>
                                            <option value="NGN" <?php echo e(get_option('app_currency') == 'NGN' ? 'selected' : ''); ?>  >NGN (Nigerian Naira)</option>
                                            <option value="AED" <?php echo e(get_option('app_currency') == 'AED' ? 'selected' : ''); ?>  >AED (United Arab Emirates dirham)</option>
                                            <option value="MAD" <?php echo e(get_option('app_currency') == 'MAD' ? 'selected' : ''); ?>  >MAD (Moroccan dirham)</option>
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/settings/currency.blade.php ENDPATH**/ ?>