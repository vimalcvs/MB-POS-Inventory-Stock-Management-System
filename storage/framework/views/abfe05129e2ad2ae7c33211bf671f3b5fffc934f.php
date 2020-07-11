<?php $__env->startSection('title'); ?> <?php echo e(__('pages.language')); ?>  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.translate_your_language')); ?> (English to <?php echo e($language->language); ?> )</h6>
                        <a href="<?php echo e(route('language.index')); ?>" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-list mr-1"></i> <?php echo e(__('pages.all_language')); ?></a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="<?php echo e(route('language.store')); ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="language" id="language" value="<?php echo e(old('language')); ?>" placeholder="<?php echo e(__('pages.title')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                    </div>
                                </div>



                                <div class="col-md-12 mt-3">
                                    <div class="row justify-content-end">
                                        <div class="col-md-2 pull-right">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('pages.update')); ?></button>
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/language/edit-content.blade.php ENDPATH**/ ?>