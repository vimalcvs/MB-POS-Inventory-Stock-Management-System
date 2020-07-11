<div class="btn-group btn-group-justified nav-buttons" role="group" aria-label="Basic example">
    <a href="<?php echo e(route('profile')); ?>" class="btn btn-outline-primary <?php echo e(active_if_full_match('settings/profile')); ?>"><i class="fas fa-user"></i> <?php echo e(__('pages.profile_settings')); ?></a>
    <a href="<?php echo e(route('password')); ?>" class="btn btn-outline-primary <?php echo e(active_if_full_match('settings/password')); ?>"><i class="fas fa-key"></i><?php echo e(__('pages.change_password')); ?> </a>
    <a href="<?php echo e(route('change-email')); ?>" class="btn btn-outline-primary <?php echo e(active_if_full_match('settings/change-email')); ?>"><i class="fa fa-envelope"></i> <?php echo e(__('pages.change_login_email')); ?> </a>
</div>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/settings/partial/user-account-nav.blade.php ENDPATH**/ ?>