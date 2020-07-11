<?php $__env->startSection('title'); ?> <?php echo e(__('pages.sell_target')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"> <?php echo e(__('pages.sell_targets')); ?> </h6>
                        <a href="<?php echo e(route('branch-sells-target.create')); ?>" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-plus"></i> <?php echo e(__('pages.create_sell_target')); ?></a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <?php $__currentLoopData = $sells_targets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sells_target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <table class="table table-sm table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th colspan="5">
                                            <?php echo e(\Carbon\Carbon::parse($key)->format('Y-F')); ?>

                                            <div class="float-right pr-2">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <a href="<?php echo e(route('branch-sells-target.edit', [$key])); ?>" class="btn btn-primary rounded-0"><i class="fa fa-pencil-alt"></i> </a>
                                                    <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>')) " class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    <form action="<?php echo e(route('branch-sells-target.destroy',$key)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr class="bg-secondary text-white">
                                        <th width="25%"><?php echo e(__('pages.branch_name')); ?></th>
                                        <th width="20%"><?php echo e(__('pages.target_amount')); ?></th>
                                        <th width="20%"><?php echo e(__('pages.sell')); ?></th>
                                        <th><?php echo e(__('pages.progress')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $sells_target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch_target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($branch_target->branch->title); ?></td>
                                            <td><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($branch_target->target_amount, 2)); ?></td>
                                            <td><?php echo e(get_option('app_currency')); ?><?php echo e(number_format(monthlySells($branch_target->branch_id, $key), 2)); ?></td>
                                            <td class="pl-2 pr-2">
                                                <?php
                                                    if(monthlySells($branch_target->branch_id, $key) > 0){
                                                        $result = monthlySells($branch_target->branch_id, $key) * 100 / $branch_target->target_amount;
                                                    }else{
                                                        $result = 0;
                                                    }
                                                ?>

                                                <div class="progress rounded-0">
                                                    <?php if($result > 20): ?>
                                                        <div class="progress-bar progress-bar-striped text-center dwp-<?php echo e(round($result)); ?>" role="progressbar" aria-valuenow="<?php echo e($result); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e(number_format($result,2)); ?>%</div>
                                                    <?php else: ?>
                                                        <div class="progress-bar w20p progress-bar-striped text-center bg-danger" role="progressbar" aria-valuenow="<?php echo e($result); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e(number_format($result,2)); ?>%</div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/sells-target/index.blade.php ENDPATH**/ ?>