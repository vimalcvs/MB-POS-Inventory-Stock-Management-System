<div class="dropdown show float-right">
    <a class="btn btn-secondary dropdown-toggle text-right btn-outline-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo e(__('pages.last')); ?> <?php if(isset($days)): ?> <?php echo e($days); ?> <?php else: ?> ** <?php endif; ?> <?php echo e(__('pages.days')); ?>

    </a>

    <div class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="<?php echo e(url('report/purchase/statistics/last/7/days')); ?>"><?php echo e(__('pages.last')); ?> 7 <?php echo e(__('pages.days')); ?></a>
        <a class="dropdown-item" href="<?php echo e(url('report/purchase/statistics/last/15/days')); ?>"><?php echo e(__('pages.last')); ?> 15 <?php echo e(__('pages.days')); ?></a>
        <a class="dropdown-item" href="<?php echo e(url('report/purchase/statistics/last/30/days')); ?>"><?php echo e(__('pages.last')); ?> 30 <?php echo e(__('pages.days')); ?></a>
        <a class="dropdown-item" href="<?php echo e(url('report/purchase/statistics/last/45/days')); ?>"><?php echo e(__('pages.last')); ?> 45 <?php echo e(__('pages.days')); ?></a>
        <a class="dropdown-item" href="<?php echo e(url('report/purchase/statistics/last/60/days')); ?>"><?php echo e(__('pages.last')); ?> 60 <?php echo e(__('pages.days')); ?></a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/report/purchase/statistics/more-filter.blade.php ENDPATH**/ ?>