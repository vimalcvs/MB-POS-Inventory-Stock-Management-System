<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="icon" href="<?php echo e(asset(get_option('app_fav_icon'))); ?>" type="image/gif" sizes="16x16">
    <?php echo $__env->make('backend.layouts.assets.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('css'); ?>
</head>

<body id="page-top">


<!-- Page Wrapper -->
<div id="wrapper">
    <?php if(active_if_full_match('purchase/create') != 'active'
     && active_if_full_match('purchase/*/edit') != 'active'
     &&  active_if_full_match('sell/create') != 'active'
     &&  active_if_full_match('sell/*/edit') != 'active'
     &&  active_if_full_match('requisition/create') != 'active'
     &&  active_if_full_match('requisition/*/edit') != 'active'
     ): ?>
        <?php echo $__env->make('backend.layouts.particles.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="app">
            <div id="content">
                <?php echo $__env->make('backend.layouts.particles.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>

        <!-- End of Main Content -->
        <?php echo $__env->make('backend.layouts.particles.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php echo $__env->make('backend.layouts.assets.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo Toastr::message(); ?>


<?php if(Session::has('message')): ?>
    <input type="hidden" value="<?php echo e(Session::get('type')); ?>" id="toastrType">
    <input type="hidden" value="<?php echo e(Session::get('message')); ?>" id="toastrMessage">
    <script src="<?php echo e(asset('/backend/js/custom-toastr.js')); ?>"></script>
<?php endif; ?>

<?php echo $__env->yieldContent('js'); ?>
</body>

</html>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/layouts/app.blade.php ENDPATH**/ ?>