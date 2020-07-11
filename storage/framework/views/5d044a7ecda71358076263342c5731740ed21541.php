<?php $__env->startSection('title'); ?> <?php echo e(__('pages.category')); ?>  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="app">
        <category :all_categories="<?php echo e($categories); ?>"></category>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/category/index.blade.php ENDPATH**/ ?>