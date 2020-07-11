<?php $__env->startSection('title'); ?> <?php echo e(__('pages.notice')); ?>  <?php $__env->stopSection(); ?>

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
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.notice')); ?></h6>
                        <a href="<?php echo e(route('notice.index')); ?>" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-list mr-2"></i> <?php echo e(__('pages.all')); ?> <?php echo e(__('pages.notice')); ?></a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body pb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <b>Title:</b> <?php echo e($notice->title); ?>

                            </div>

                            <div class="col-md-12">
                                <b>From:</b> <?php echo e($notice->createdBy->name); ?>

                            </div>

                            <div class="col-md-12 mt-1">
                                <b>Date:</b> <?php echo e($notice->notify_date->format(get_option('app_date_format'))); ?> , <?php echo e(\Carbon\Carbon::parse($notice->notify_time)->format('h:m a')); ?>

                            </div>

                            <div class="col-md-12 mt-1">
                                <b>Description:</b> <?php echo e($notice->description); ?>

                            </div>
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/notice/show.blade.php ENDPATH**/ ?>