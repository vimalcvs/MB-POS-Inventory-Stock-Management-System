<?php $__env->startSection('title'); ?>
   <?php echo e(__('pages.update_employees')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center">
                         <h6 class="m-0 font-weight-bold text-primary ml-1"><?php echo e(__('pages.update_employees')); ?></h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="<?php echo e(route('employee.update', [$employee->id])); ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>

                            <div class="bg-secondary text-white pl-2 pt-1 pb-1 mb-2"><?php echo e(__('pages.personal_information')); ?></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(__('pages.name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" value="<?php echo e($employee->user->name); ?>" placeholder="<?php echo e(__('pages.name')); ?>" class="form-control" aria-describedby="emailHelp">
                                        <?php if($errors->has('name')): ?>
                                            <div class="error"><?php echo e($errors->first('name')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender"><?php echo e(__('pages.gender')); ?> <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender" class="form-control select2">
                                            <option value=""><?php echo e(__('pages.select_gender')); ?></option>
                                            <option value="Male" <?php echo e($employee->gender == 'Male' ? 'selected' : ''); ?>>Male</option>
                                            <option value="Female" <?php echo e($employee->gender == 'Male' ? 'Female' : ''); ?>>Female</option>
                                        </select>

                                        <?php if($errors->has('gender')): ?>
                                            <div class="error"><?php echo e($errors->first('gender')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth"><?php echo e(__('pages.date_of_birth')); ?> <span class="text-danger">*</span></label>
                                        <input name="date_of_birth" value="<?php echo e($employee->date_of_birth); ?>" id="date_of_birth" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.date_of_birth')); ?>" autocomplete="off">
                                        <?php if($errors->has('date_of_birth')): ?>
                                            <div class="error"><?php echo e($errors->first('date_of_birth')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group"><?php echo e(__('pages.blood_group')); ?> <span class="text-danger">*</span></label>
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
                                        <?php if($errors->has('blood_group')): ?>
                                            <div class="error"><?php echo e($errors->first('blood_group')); ?></div>
                                        <?php endif; ?>

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
                                        <input type="text" name="address" id="address" value="<?php echo e($employee->address); ?>" placeholder="<?php echo e(__('pages.address')); ?>" class="form-control" aria-describedby="emailHelp">
                                        <?php if($errors->has('address')): ?>
                                            <div class="error"><?php echo e($errors->first('address')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="educational_background"> <?php echo e(__('pages.educational_background')); ?></label>
                                        <input type="text" value="<?php echo e($employee->educational_background); ?>" name="educational_background" class="form-control" placeholder="<?php echo e(__('pages.educational_background')); ?>">
                                        <?php if($errors->has('educational_background')): ?>
                                            <div class="error"><?php echo e($errors->first('educational_background')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-md-3 mt-3">
                                    <div class="form-group">

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

                            <div class="bg-secondary text-white pl-2 pt-1 pb-1 mb-2"><?php echo e(__('pages.employment_info')); ?></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department_id"><?php echo e(__('pages.department')); ?> <span class="text-danger">*</span></label>
                                        <select name="department_id" id="department_id" class="form-control select2">
                                            <option value=""><?php echo e(__('pages.select_department')); ?></option>
                                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($department->id); ?>" <?php echo e($employee->department_id == $department->id ? 'selected' : ''); ?>><?php echo e($department->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                        <?php if($errors->has('department_id')): ?>
                                            <div class="error"><?php echo e($errors->first('department_id')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation_id"><?php echo e(__('pages.designation')); ?> <span class="text-danger">*</span></label>
                                        <select name="designation_id" id="designation_id" class="form-control select2" >
                                            <option value=""><?php echo e(__('pages.select_designation')); ?> </option>
                                            <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($designation->id); ?>" <?php echo e($employee->designation_id == $designation->id ? 'selected' : ''); ?>><?php echo e($designation->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                        <?php if($errors->has('designation_id')): ?>
                                            <div class="error"><?php echo e($errors->first('designation_id')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_id"><?php echo e(__('pages.branch')); ?> <span class="text-danger">*</span></label>
                                        <select name="branch_id" id="branch_id" class="form-control select2">
                                            <option value=""><?php echo e(__('pages.select_branch')); ?></option>
                                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($branch->id); ?>" <?php echo e($employee->branch_id == $branch->id ? 'selected' : ''); ?>><?php echo e($branch->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role"><?php echo e(__('pages.role')); ?> <span class="text-danger">*</span></label>
                                        <select name="role" id="role" class="form-control select2">
                                            <option value=""><?php echo e(__('pages.select_role')); ?></option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($role->name); ?>" <?php if($role->id == $selected_role_id): ?> selected <?php endif; ?> ><?php echo $role->name; ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_number"> <?php echo e(__('pages.employee_id')); ?> </label>
                                        <input type="text" name="id_number" value="<?php echo e($employee->id_number); ?>" class="form-control" placeholder="<?php echo e(__('pages.employee_id')); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="joining_date"> <?php echo e(__('pages.joining_date')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" value="<?php echo e($employee->joining_date); ?>" name="joining_date"  data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.joining_date')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-secondary text-white pl-2 pt-1 pb-1 mb-2"><?php echo e(__('pages.login_info')); ?></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"><?php echo e(__('pages.email')); ?> <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" value="<?php echo e($employee->user->email); ?>" class="form-control" placeholder="<?php echo e(__('pages.email')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password"><?php echo e(__('pages.password')); ?> <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo e(__('pages.password')); ?>">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="c_password"><?php echo e(__('pages.re_type_password')); ?> <span class="text-danger">*</span></label>
                                        <input type="password" name="c_password" data-parsley-equalto="#password"  class="form-control" placeholder="<?php echo e(__('pages.re_type_password')); ?>">
                                    </div>
                                </div>

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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/employee/edit.blade.php ENDPATH**/ ?>