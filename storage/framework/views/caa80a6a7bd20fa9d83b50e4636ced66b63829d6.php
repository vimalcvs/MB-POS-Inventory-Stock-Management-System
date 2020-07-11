<?php $__env->startSection('title'); ?> <?php echo e(__('pages.notice')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.manage')); ?> <?php echo e(__('pages.notice')); ?></h6>
                        <a href="<?php echo e(route('notice.create')); ?>" class="btn btn-secondary btn-sm rounded-0"> <i class="fa fa-plus"></i> <?php echo e(__('pages.create')); ?> <?php echo e(__('pages.notice')); ?></a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="3%"><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.title')); ?></th>
                                    <th width="15%"><?php echo e(__('pages.date_time')); ?></th>
                                    <th width="10%"><?php echo e(__('pages.notify_from')); ?></th>
                                    <th width="20%"><?php echo e(__('pages.notify_to')); ?></th>
                                    <th width="30%"><?php echo e(__('pages.description')); ?></th>
                                    <th width="8%"><?php echo e(__('pages.action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($notice->title); ?></td>
                                        <td><?php echo e($notice->notify_date->format(get_option('app_date_format'))); ?> <br> <?php echo e(\Carbon\Carbon::parse($notice->notify_time)->format('h:00 a')); ?></td>
                                        <td><?php echo e($notice->createdBy->name); ?></td>
                                        <td>
                                            <?php $__currentLoopData = $notice->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <img class="img-profile border w-30p rounded-circle"  title="<?php echo e($notification->messageTo->name); ?>" src="<?php echo e(asset($notification->messageTo->employee->profile_picture != '' ? $notification->messageTo->employee->profile_picture : 'backend/img/user-placeholder.png')); ?>">
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td><?php echo e(str_limit($notice->description, 180)); ?></td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="<?php echo e(route('notice.edit', [$notice->id])); ?>" class="mr-2"><i class="fa fa-edit"></i> </a>
                                                <a href="<?php echo e(route('notice.show', [$notice->id])); ?>" class="mr-2"><i class="fa fa-eye text-primary"></i> </a>
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="<?php echo e(route('notice.destroy',$notice->id)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
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

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/notice/index.blade.php ENDPATH**/ ?>