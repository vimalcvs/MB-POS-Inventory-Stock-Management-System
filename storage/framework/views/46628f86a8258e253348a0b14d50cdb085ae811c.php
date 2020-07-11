<?php $__env->startSection('title'); ?> <?php echo e(__('pages.branch')); ?>  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.create_branch')); ?></h6>
                        <a href="<?php echo e(route('branch.index')); ?>" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-2"></i> <?php echo e(__('pages.all_branch')); ?></a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="<?php echo e(route('branch.store')); ?>" method="post" data-parsley-validate>
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title"><?php echo e(__('pages.branch_name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>" placeholder="<?php echo e(__('pages.branch_name')); ?>" class="form-control"  required>
                                        <?php if($errors->has('title')): ?>
                                            <div class="error"><?php echo e($errors->first('title')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person"><?php echo e(__('pages.contact_person')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="contact_person" id="contact_person" value="<?php echo e(old('contact_person')); ?>" placeholder="<?php echo e(__('pages.contact_person')); ?>" class="form-control"  required>
                                        <?php if($errors->has('contact_person')): ?>
                                            <div class="error"><?php echo e($errors->first('contact_person')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone"><?php echo e(__('pages.phone_number')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(__('pages.phone_number')); ?>" class="form-control"  required>
                                        <?php if($errors->has('phone')): ?>
                                            <div class="error"><?php echo e($errors->first('phone')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"><?php echo e(__('pages.address')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="address" value="<?php echo e(old('address')); ?>" placeholder="<?php echo e(__('pages.address')); ?>" class="form-control"  required>
                                        <?php if($errors->has('address')): ?>
                                            <div class="error"><?php echo e($errors->first('address')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_description"><?php echo e(__('pages.short_description')); ?></label>
                                        <textarea name="short_description" id="short_description" placeholder="<?php echo e(__('pages.short_description')); ?>" class="form-control"><?php echo e(old('short_description')); ?></textarea>
                                        <?php if($errors->has('short_description')): ?>
                                            <div class="error"><?php echo e($errors->first('short_description')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row justify-content-end">
                                        <div class="col-md-2 offset-10">
                                            <div class="form-group">
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/branch/create.blade.php ENDPATH**/ ?>