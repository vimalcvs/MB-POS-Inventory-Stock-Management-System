<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar <?php if(active_if_full_match('admin/purchase/create') == 'active' || active_if_full_match('admin/purchase/*/edit') == 'active' || active_if_full_match('admin/sell/create') == 'active' || active_if_full_match('admin/sell/*/edit') == 'active' || active_if_full_match('admin/requisition/create') == 'active' || active_if_full_match('admin/requisition/*/edit') == 'active'): ?> mb-2 <?php else: ?> mb-4 <?php endif; ?>  static-top border-bottom-primary-slim">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav">
        <?php if(active_if_full_match('purchase/create') == 'active'
        || active_if_full_match('purchase/*/edit') == 'active'
        ||  active_if_full_match('sell/create') == 'active'
        || active_if_full_match('sell/*/edit') == 'active'
        || active_if_full_match('requisition/create') == 'active'
        || active_if_full_match('requisition/*/edit') == 'active'
         ): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('home')); ?>">
                    <i class="fas fa-fw fa-tachometer-alt mr-2"></i> <span class="text-dark"><?php echo e(__('sidebar.dashboard')); ?></span>
                </a>
            </li>
        <?php endif; ?>


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_purchase_invoice')): ?>
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="<?php echo e(route('purchase.index')); ?>">
                    <i class="fa fa-list mr-2"></i>  <span class="text-dark"> <?php echo e(__('sidebar.purchase_invoices')); ?> </span>
                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_purchase_invoice')): ?>
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="<?php echo e(route('purchase.create')); ?>">
                    <i class="fa fa-plus mr-2"></i>  <span class="text-dark"> <?php echo e(__('sidebar.create_purchase')); ?> </span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_sell_invoice')): ?>
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="<?php echo e(route('sell.index')); ?>">
                    <i class="fa fa-list mr-2"></i> <span class="text-dark"> <?php echo e(__('sidebar.sell_invoice')); ?> </span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_sell_invoice')): ?>
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="<?php echo e(route('sell.create')); ?>">
                    <i class="fa fa-plus mr-2"></i> <span class="text-dark"> <?php echo e(__('sidebar.create_invoice')); ?> </span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_requisition')): ?>
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="<?php echo e(route('requisition.index')); ?>">
                    <i class="fa fa-list mr-2"></i> <span class="text-dark"> <?php echo e(__('sidebar.manage_requisition')); ?> </span>
                </a>
            </li>
        <?php endif; ?>

    </ul>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"> <?php echo e(notifications()->count()); ?></span>
            </a>
            <!-- Dropdown - Alerts -->
            <?php if(notifications()->count() > 0): ?>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in scroll-bar notification-mb-pos" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Notifications
                    </h6>

                    <?php $__currentLoopData = notifications(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('notification', $notification->id)); ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-store text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php echo e($notification->created_at->diffForHumans()); ?></div>
                                <span class="font-weight-bold"><?php echo $notification->message; ?></span>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if(config('app.locale') == 'en'): ?>
                    <img class="img-profile h-25" src="<?php echo e(asset('backend/img/flag/en.png')); ?>">
                <?php elseif(config('app.locale') == 'hi'): ?>
                    <img class="img-profile h-25" src="<?php echo e(asset('backend/img/flag/hi.png')); ?>">
                <?php else: ?>
                    <img class="img-profile h-25" src="<?php echo e(asset('backend/img/flag/bn.jpg')); ?>">
                <?php endif; ?>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo e(url('/local/en')); ?>">
                    <img src="<?php echo e(asset('backend/img/flag/en.png')); ?>" height="15" class="mr-2">
                     EN ( English )
                </a>
                <div class="dropdown-divider"></div>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(url('/local/hi')); ?>">
                    <img src="<?php echo e(asset('backend/img/flag/hi.png')); ?>" height="15" class="mr-2">
                    HI ( हिंदी- Hindi )
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(url('/local/bn')); ?>">
                    <img src="<?php echo e(asset('backend/img/flag/bn.jpg')); ?>" height="15" class="mr-2">
                    BN ( বাংলা- Bangla )
                </a>

            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e(auth()->user()->name); ?></span>
                <img class="img-profile rounded-circle" src="<?php echo e(asset(auth()->user()->employee->profile_picture != '' ? auth()->user()->employee->profile_picture : 'backend/img/user-placeholder.png')); ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="text-center pt-2 pb-3">

                    <b><?php echo e(auth()->user()->name); ?></b> <br>
                    Since in <?php echo e(auth()->user()->created_at->diffForHumans()); ?>

                </div>
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="<?php echo e(route('profile')); ?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                   <?php echo e(__('pages.account_settings')); ?>

                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('password')); ?>">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>

                    <?php echo e(__('pages.change_password')); ?>

                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> <?php echo e(__('Logout')); ?>

                </a>

                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
<?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/layouts/particles/header.blade.php ENDPATH**/ ?>