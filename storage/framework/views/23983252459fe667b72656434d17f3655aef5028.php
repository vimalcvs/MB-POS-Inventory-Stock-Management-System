<?php $__env->startSection('title'); ?> Edit Sell  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="app">
        <edit-sell :sell="<?php echo e($sell); ?>" :all_categories="<?php echo e($categories); ?>"></edit-sell>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/sell/edit.blade.php ENDPATH**/ ?>