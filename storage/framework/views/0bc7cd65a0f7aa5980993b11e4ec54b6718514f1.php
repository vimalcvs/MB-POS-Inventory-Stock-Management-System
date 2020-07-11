<?php $__env->startSection('title'); ?> <?php echo e(__('pages.language')); ?>  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.add_language')); ?></h6>
                        <a href="<?php echo e(route('language.index')); ?>" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-list mr-1"></i> <?php echo e(__('pages.all_language')); ?></a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="<?php echo e(route('language.update', $language->id)); ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.language')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e($language->language); ?>" placeholder="<?php echo e(__('pages.language')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                        <?php if($errors->has('language')): ?>
                                            <div class="error"><?php echo e($errors->first('language')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone"><?php echo e(__('pages.iso_code')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="iso_code" id="iso_code" value="<?php echo e($language->iso_code); ?>" placeholder="<?php echo e(__('pages.iso_code')); ?>" class="form-control" aria-describedby="emailHelp">
                                        <?php if($errors->has('iso_code')): ?>
                                            <div class="error"><?php echo e($errors->first('iso_code')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group pt-35">
                                        <a href="https://en.wikipedia.org/wiki/ISO_3166-1" target="_blank"><b> <i class="fa fa-list mr-1"></i> ISO Code List</b></a>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" name="flag" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose Flag</label>
                                            <?php if($errors->has('flag')): ?>
                                                <div class="error"><?php echo e($errors->first('flag')); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 mt-3">
                                    <div class="row justify-content-end">
                                        <div class="col-md-2 pull-right">
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/language/edit.blade.php ENDPATH**/ ?>