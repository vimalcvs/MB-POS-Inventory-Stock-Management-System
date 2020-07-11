<?php $__env->startSection('title'); ?> <?php echo e(__('pages.expense_category')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="app">
        <expense-category :all_categories="<?php echo e($categories); ?>"></expense-category>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/expense-category/index.blade.php ENDPATH**/ ?>