<?php $__env->startSection('title'); ?> <?php echo e(__('pages.settings')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        <?php echo $__env->make('backend.settings.partial.user-account-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="<?php echo e(route('update-profile')); ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" value="<?php echo e($employee->user->name); ?>" placeholder="<?php echo e(__('pages.name')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                        <?php if($errors->has('name')): ?>
                                            <div class="error"><?php echo e($errors->first('name')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender"><?php echo e(__('pages.gender')); ?> <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value=""><?php echo e(__('pages.select_gender')); ?></option>
                                            <option value="Male" <?php echo e($employee->gender == 'Male' ? 'selected' : ''); ?>>Male</option>
                                            <option value="Female" <?php echo e($employee->gender == 'Male' ? 'Female' : ''); ?>>Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth"><?php echo e(__('pages.date_of_birth')); ?> <span class="text-danger">*</span></label>
                                        <input name="date_of_birth" value="<?php echo e(\Carbon\Carbon::parse($employee->date_of_birth)->toDateString()); ?>" id="date_of_birth" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.date_of_birth')); ?>" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group"><?php echo e(__('pages.blood_group')); ?></label>
                                        <select name="blood_group" id="blood_group" class="form-control select2">
                                            <option value=""><?php echo e(__('pages.select_blood_group')); ?></option>
                                            <option value="A+" <?php echo e($employee->blood_group == 'A+' ? 'selected' : ''); ?>>A+</option>
                                            <option value="A-" <?php echo e($employee->blood_group == 'A-' ? 'selected' : ''); ?>>A-</option>
                                            <option value="B+" <?php echo e($employee->blood_group == 'B+' ? 'selected' : ''); ?>>B+</option>
                                            <option value="B-" <?php echo e($employee->blood_group == 'B-' ? 'selected' : ''); ?>>B-</option>
                                            <option value="AB+" <?php echo e($employee->blood_group == 'AB+' ? 'selected' : ''); ?>>AB+</option>
                                            <option value="AB-" <?php echo e($employee->blood_group == 'AB-' ? 'selected' : ''); ?>>AB-</option>
                                            <option value="O+" <?php echo e($employee->blood_group == 'O+' ? 'selected' : ''); ?>>O+</option>
                                            <option value="O-" <?php echo e($employee->blood_group == 'O+' ? 'selected' : ''); ?>>O-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number"><?php echo e(__('pages.phone_number')); ?></label>
                                        <input type="text" name="phone_number" id="phone_number"value="<?php echo e($employee->phone_number); ?>" placeholder="<?php echo e(__('pages.phone_number')); ?>" class="form-control" aria-describedby="emailHelp">
                                        <?php if($errors->has('phone_number')): ?>
                                            <div class="error"><?php echo e($errors->first('phone_number')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"><?php echo e(__('pages.address')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" name="address" id="address" value="<?php echo e($employee->address); ?>" placeholder="<?php echo e(__('pages.address')); ?>" required class="form-control" aria-describedby="emailHelp">
                                        <?php if($errors->has('address')): ?>
                                            <div class="error"><?php echo e($errors->first('address')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="educational_background"> <?php echo e(__('pages.educational_background')); ?></label>
                                        <input type="text" name="educational_background" class="form-control" placeholder="<?php echo e(__('pages.educational_background')); ?>">
                                    </div>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <div class="form-group">
                                        <label for="profile_picture"><?php echo e(__('pages.profile_picture')); ?> <span class="text-danger">*</span></label>

                                        <div class="upload-img-box">
                                            <?php if($employee->profile_picture): ?>
                                                <img src="<?php echo e(asset($employee->profile_picture)); ?>">
                                            <?php else: ?>
                                                <img src="">
                                            <?php endif; ?>
                                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewFile(this)">
                                            <div class="upload-img-box-icon">
                                                <i class="fa fa-camera"></i>
                                                <p class="m-0"><?php echo e(__('pages.profile_picture')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mt-2">
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
    <script src="<?php echo e(asset('/backend/js/custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/settings/profile.blade.php ENDPATH**/ ?>