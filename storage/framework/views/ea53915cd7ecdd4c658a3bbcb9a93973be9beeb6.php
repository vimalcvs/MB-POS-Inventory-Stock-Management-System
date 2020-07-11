<?php $__env->startSection('title'); ?> <?php echo e(__('pages.notice')); ?>  <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/jquery.timepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.edit')); ?> <?php echo e(__('pages.notice')); ?></h6>
                        <a href="<?php echo e(route('notice.index')); ?>" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-2"></i> <?php echo e(__('pages.manage')); ?> <?php echo e(__('pages.notice')); ?></a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body min-height-550">
                        <form action="<?php echo e(route('notice.update', $notice->id)); ?>" method="post" data-parsley-validate>
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title"><?php echo e(__('pages.title')); ?> <span class="text-danger">*</span></label>
                                                <input name="title" value="<?php echo e(old('title') ? old('title') : $notice->title); ?>" id="title" type="text" class="form-control" placeholder="<?php echo e(__('pages.title')); ?>" required autocomplete="off">
                                                <?php if($errors->has('title')): ?>
                                                    <div class="error"><?php echo e($errors->first('title')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="user_id"><?php echo e(__('pages.notify_to')); ?> <span class="text-danger">*</span></label>
                                                <select name="user_id[]" id="user_id" class="form-control select2" multiple="true">
                                                    <option value="all"><?php echo e(__('pages.all_employee')); ?></option>

                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($user->id); ?>" <?php if(in_array($user->id, $selectedUser)): ?> selected <?php endif; ?> ><?php echo e($user->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                <?php if($errors->has('user_id')): ?>
                                                    <div class="error mt-1"><?php echo e($errors->first('user_id')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="notify_date"><?php echo e(__('pages.notify_date')); ?> <span class="text-danger">*</span></label>
                                                <input name="notify_date" value="<?php echo e(old('notify_date') ? old('notify_date') : $notice->notify_date->format('Y-m-d')); ?>" id="notify_date" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.notify_date')); ?>" required autocomplete="off">
                                                <?php if($errors->has('notify_date')): ?>
                                                    <div class="error"><?php echo e($errors->first('notify_date')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="notify_time"><?php echo e(__('pages.notify_time')); ?> <span class="text-danger">*</span></label>
                                                <input type="text" name="notify_time" value="<?php echo e($notice->notify_time); ?>" id="notify_time" class="form-control timepicker" placeholder="<?php echo e(__('pages.notify_time')); ?>" autocomplete="off">
                                                <?php if($errors->has('notify_time')): ?>
                                                    <div class="error"><?php echo e($errors->first('notify_time')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="note"><?php echo e(__('pages.description')); ?></label>
                                                <textarea name="description" placeholder="<?php echo e(__('pages.description')); ?>" class="form-control" rows="5" required><?php echo e($notice->description); ?></textarea>
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
    <script src="<?php echo e(asset('backend/js/jquery.timepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/timepicker.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/notice/edit.blade.php ENDPATH**/ ?>