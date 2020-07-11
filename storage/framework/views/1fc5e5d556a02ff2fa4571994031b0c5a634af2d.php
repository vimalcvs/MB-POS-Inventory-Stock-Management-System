<?php $__env->startSection('title'); ?> <?php echo e(__('pages.customer')); ?>  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.create_customer')); ?></h6>
                        <a href="<?php echo e(route('customer.index')); ?>" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-list mr-1"></i> <?php echo e(__('pages.all_customer')); ?></a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="<?php echo e(route('customer.store')); ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(__('pages.customer_name')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                        <?php if($errors->has('name')): ?>
                                            <div class="error"><?php echo e($errors->first('name')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone"><?php echo e(__('pages.phone_number')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(__('pages.phone_number')); ?>" class="form-control" aria-describedby="emailHelp">
                                        <?php if($errors->has('phone')): ?>
                                            <div class="error"><?php echo e($errors->first('phone')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"><?php echo e(__('pages.email')); ?></label>
                                        <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('pages.email')); ?>" class="form-control" aria-describedby="emailHelp">
                                        <?php if($errors->has('email')): ?>
                                            <div class="error"><?php echo e($errors->first('email')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"><?php echo e(__('pages.address')); ?></label>
                                        <input type="text" name="address" id="address" value="<?php echo e(old('address')); ?>" placeholder="<?php echo e(__('pages.address')); ?>" class="form-control" aria-describedby="emailHelp">
                                        <?php if($errors->has('address')): ?>
                                            <div class="error"><?php echo e($errors->first('address')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_description"><?php echo e(__('pages.photo')); ?></label>
                                        <input type="file" name="photo" class="form-control" accept="image/*">
                                    </div>
                                </div>


                                <div class="col-md-2 pull-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('pages.save')); ?></button>
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/customer/create.blade.php ENDPATH**/ ?>