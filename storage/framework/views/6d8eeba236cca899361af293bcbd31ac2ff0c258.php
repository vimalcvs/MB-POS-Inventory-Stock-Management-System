<header class="clearfix">
    <div class="header-company-info-sell-invoice">
        <h2 class="name"><?php echo e(get_option('app_name')); ?></h2>
        <div><?php echo e(get_option('address')); ?></div>
        <div><?php echo e(__('pages.vat_reg_number')); ?> :<?php echo e(get_option('vat_reg_no')); ?></div>
        <div><?php echo e(__('pages.phone')); ?>: <?php echo e(get_option('phone')); ?></div>
        <div><?php echo e(__('pages.outlet')); ?>: <?php echo e(auth()->user()->employee->branch->title); ?></div>
    </div>
</header>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/pdf/layouts/report-header.blade.php ENDPATH**/ ?>