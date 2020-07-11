<?php $__env->startSection('title'); ?> Set Permission <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="<?php echo e(route('savePermission')); ?>" method="post" role="form">
                                <?php echo csrf_field(); ?>
                            <table class="table table-bordered table-hover font-14">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th class="pl-4">Permission</th>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th class="text-center"><?php echo ucwords(str_replace("_", " ", $role->name)); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="pl-4"><?php echo ucwords(str_replace("_", " ", $permission->name)); ?></td>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td class="text-center">
                                                <input id="checkbox" type="checkbox"
                                                       name="permission[<?php echo $role->id; ?>][<?php echo $permission->id; ?>]"
                                                       value='1' <?php echo (in_array($role->id.'-'.$permission->id, $permissionRole)) ? 'checked' : ''; ?> >
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                                <button type="submit" class="btn btn-primary btn-block">Save Permission</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/settings/user-permission.blade.php ENDPATH**/ ?>