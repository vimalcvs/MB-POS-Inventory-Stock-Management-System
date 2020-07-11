<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('home')); ?>">
        <div class="sidebar-brand-text mx-3"><?php echo e(get_option('app_name')); ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo e(active_if_full_match('home')); ?> ">
        <a class="nav-link" href="<?php echo e(route('home')); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><?php echo e(__('sidebar.dashboard')); ?></span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['manage_category', 'manage_tax', 'manage_product'])): ?>
        <div class="sidebar-heading"> <?php echo e(__('sidebar.sells_marketing')); ?> </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="product">
                <i class="fas fa-boxes"></i>
                <span><?php echo e(__('sidebar.manage_product')); ?></span>
            </a>
            <div id="product" class="collapse <?php echo e(active_if_match('product')); ?> <?php echo e(active_if_match('tax')); ?> <?php echo e(active_if_match('category')); ?>" aria-labelledby="product" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_category')): ?>
                    <a class="collapse-item <?php echo e(active_if_full_match('category')); ?>" href="<?php echo e(route('category.index')); ?>"><?php echo e(__('sidebar.categories')); ?></a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_tax')): ?>
                    <a class="collapse-item <?php echo e(active_if_full_match('tax')); ?>" href="<?php echo e(route('tax.index')); ?>"><?php echo e(__('sidebar.taxes')); ?></a>
                     <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_product')): ?>
                    <a class="collapse-item <?php echo e(active_if_full_match('product')); ?> <?php echo e(active_if_full_match('product/*/edit')); ?> <?php echo e(active_if_full_match('product/*')); ?> <?php echo e(active_if_full_match('product/create')); ?> " href="<?php echo e(route('product.index')); ?>"><?php echo e(__('sidebar.products')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['manage_sell_invoice'])): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#sells" aria-expanded="true" aria-controls="sells">
                <i class="fas fa-list"></i>
                <span><?php echo e(__('sidebar.manage_sell')); ?></span>
            </a>
            <div id="sells" class="collapse <?php echo e(active_if_match('sell')); ?>" aria-labelledby="sells" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_sell_invoice')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('sell/create')); ?>" href="<?php echo e(route('sell.create')); ?>"><?php echo e(__('sidebar.create_invoice')); ?></a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_sell_invoice')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('sell')); ?> <?php echo e(active_if_full_match('sell/*/edit')); ?> <?php echo e(active_if_full_match('sell/*')); ?>" href="<?php echo e(route('sell.index')); ?>"><?php echo e(__('sidebar.sell_invoice')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['create_purchase_invoice', 'manage_purchase_invoice','manage_requisition'])): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="purchase">
                <i class="fas fa-store"></i>
                <span><?php echo e(__('sidebar.manage_stock')); ?></span>
            </a>
            <div id="purchase" class="collapse <?php echo e(active_if_match('purchase')); ?> <?php echo e(active_if_match('requisition')); ?> <?php echo e(active_if_match('pending-requisition')); ?> " aria-labelledby="purchase" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_purchase_invoice')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('purchase/create')); ?>" href="<?php echo e(route('purchase.create')); ?>"><?php echo e(__('sidebar.create_purchase')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_purchase_invoice')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('purchase')); ?> <?php echo e(active_if_full_match('purchase/*/edit')); ?> <?php echo e(active_if_full_match('purchase/*')); ?>" href="<?php echo e(route('purchase.index')); ?>"><?php echo e(__('sidebar.purchase_invoices')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_requisition')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('requisition/create')); ?>" href="<?php echo e(route('requisition.create')); ?>"><?php echo e(__('sidebar.create_requisition')); ?></a>
                        <a class="collapse-item <?php echo e(active_if_full_match('pending-requisition')); ?>" href="<?php echo e(route('pending-requisition')); ?>"><?php echo e(__('sidebar.pending_requisition')); ?> (<?php echo e(pendingRequisition()); ?>)</a>
                        <a class="collapse-item <?php echo e(active_if_full_match('requisition')); ?> <?php echo e(active_if_full_match('requisition/*/edit')); ?> <?php echo e(active_if_full_match('requisition/*')); ?> <?php echo e(active_if_full_match('requisition-filter')); ?> " href="<?php echo e(route('requisition.index')); ?>"><?php echo e(__('sidebar.manage_requisition')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['manage_expense', 'manage_expense_category'])): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#expense" aria-expanded="true" aria-controls="expense">
                <i class="fas fa-money-bill"></i>
                <span><?php echo e(__('sidebar.expense')); ?></span>
            </a>
            <div id="expense" class="collapse <?php echo e(active_if_match('expense')); ?> <?php echo e(active_if_match('expense-category')); ?>" aria-labelledby="expense" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_expense_category')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('expense-category')); ?>" href="<?php echo e(route('expense-category.index')); ?>"><?php echo e(__('sidebar.expense_category')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_expense')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('expense/create')); ?>" href="<?php echo e(route('expense.create')); ?>"><?php echo e(__('sidebar.create_expense')); ?></a>
                        <a class="collapse-item <?php echo e(active_if_full_match('expense')); ?> <?php echo e(active_if_full_match('expense/*/edit')); ?> <?php echo e(active_if_full_match('expense-filter*')); ?>" href="<?php echo e(route('expense.index')); ?>"><?php echo e(__('sidebar.expense_list')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['manage_supplier_payment', 'manage_customer_payment'])): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#payment" aria-expanded="true" aria-controls="payment">
                <i class="fas fa-money-bill"></i>
                <span><?php echo e(__('sidebar.payment')); ?></span>
            </a>
            <div id="payment" class="collapse <?php echo e(active_if_match('payment')); ?>" aria-labelledby="payment" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_supplier_payment')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('payment-to-supplier-filter')); ?> <?php echo e(active_if_full_match('payment-to-supplier')); ?> <?php echo e(active_if_full_match('payment-to-supplier/create')); ?> <?php echo e(active_if_full_match('payment-to-supplier/*/edit')); ?>" href="<?php echo e(route('payment-to-supplier.index')); ?>"><?php echo e(__('sidebar.payment_to_supplier')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_customer_payment')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('payment-from-customer')); ?> <?php echo e(active_if_full_match('payment-from-customer/create')); ?> <?php echo e(active_if_full_match('payment-from-customer/*/edit')); ?> <?php echo e(active_if_full_match('payment-from-customer-filter')); ?>" href="<?php echo e(route('payment-from-customer.index')); ?>"><?php echo e(__('sidebar.received_from_customer')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>




    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['manage_customer', 'manage_supplier','manage_department', 'manage_designation','manage_employee','manage_branch', 'manage_sells_target'])): ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading"> <?php echo e(__('sidebar.hr_department')); ?> </div>
    <?php endif; ?>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['manage_department', 'manage_designation','manage_employee'])): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#employee" aria-expanded="true" aria-controls="user">
                <i class="fas fa-users"></i>
                <span><?php echo e(__('sidebar.manage_employee')); ?></span>
            </a>
            <div id="employee" class="collapse <?php echo e(active_if_match('department')); ?> <?php echo e(active_if_match('employee')); ?> <?php echo e(active_if_match('designation')); ?>" aria-labelledby="user" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_department')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('department')); ?>" href="<?php echo e(route('department.index')); ?>"><?php echo e(__('sidebar.departments')); ?> </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_designation')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('designation')); ?>" href="<?php echo e(route('designation.index')); ?>"><?php echo e(__('sidebar.designations')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_employee')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('employee')); ?> <?php echo e(active_if_full_match('employee/*/edit')); ?> <?php echo e(active_if_full_match('employee/*')); ?>" href="<?php echo e(route('employee.index')); ?>"><?php echo e(__('sidebar.employees')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['manage_branch', 'manage_sells_target'])): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#branch" aria-expanded="true" aria-controls="branch">
                <i class="fas fa-code-branch"></i>
                <span><?php echo e(__('sidebar.manage_branch')); ?></span>
            </a>
            <div id="branch" class="collapse <?php echo e(active_if_match('branch')); ?> <?php echo e(active_if_match('branch-sells-target')); ?>" aria-labelledby="branch" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_branch')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('branch')); ?> <?php echo e(active_if_full_match('branch/*/edit')); ?> <?php echo e(active_if_full_match('branch/create')); ?>" href="<?php echo e(route('branch.index')); ?>"><?php echo e(__('sidebar.branches')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_sells_target')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('branch-sells-target')); ?> <?php echo e(active_if_full_match('branch-sells-target/create')); ?>  <?php echo e(active_if_full_match('branch-sells-target/*')); ?> <?php echo e(active_if_full_match('branch-sells-target/*/edit')); ?>" href="<?php echo e(route('branch-sells-target.index')); ?>"> <?php echo e(__('sidebar.manage_sells_target')); ?> </a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['manage_customer', 'manage_supplier'])): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#crm" aria-expanded="true" aria-controls="crm">
                <i class="fas fa-user-secret"></i>
                <span><?php echo e(__('sidebar.crm')); ?></span>
            </a>
            <div id="crm" class="collapse <?php echo e(active_if_match('customer')); ?> <?php echo e(active_if_match('supplier')); ?>" aria-labelledby="customer" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_customer')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('customer')); ?> <?php echo e(active_if_full_match('customer/create')); ?> <?php echo e(active_if_full_match('customer/*/edit')); ?> <?php echo e(active_if_full_match('customer/*')); ?>" href="<?php echo e(route('customer.index')); ?>"><?php echo e(__('sidebar.manage_customers')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_supplier')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('supplier')); ?> <?php echo e(active_if_full_match('supplier/create')); ?> <?php echo e(active_if_full_match('supplier/*/edit')); ?> <?php echo e(active_if_full_match('supplier/*')); ?>" href="<?php echo e(route('supplier.index')); ?>"><?php echo e(__('sidebar.manage_suppliers')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['view_sells_report', 'view_purchase_report', 'view_stock'])): ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading"> <?php echo e(__('sidebar.reports')); ?> </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_sells_report')): ?>
        <li class="nav-item <?php echo e(active_if_full_match('report/sell/*')); ?>" >
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#salesReport" aria-expanded="true" aria-controls="salesReport">
                <i class="fas fa-user-secret"></i>
                <span><?php echo e(__('sidebar.sells_report')); ?></span>
            </a>
            <div id="salesReport" class="collapse <?php echo e(active_if_match('report/sell/')); ?>" aria-labelledby="salesReport" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a href="<?php echo e(url('report/sell/summary')); ?>" class="collapse-item <?php echo e(active_if_full_match('report/sell/summary')); ?> <?php echo e(active_if_full_match('report/sell/summary-filter')); ?>"> <?php echo e(__('pages.sales_summary')); ?> </a>
                    <a href="<?php echo e(url('report/sell/statistics')); ?>" class="collapse-item <?php echo e(active_if_full_match('report/sell/statistics')); ?> <?php echo e(active_if_full_match('report/sell/statistics-filter')); ?>  <?php echo e(active_if_full_match('report/sell/statistics/last/*/days')); ?>"> <?php echo e(__('pages.sales_statistics')); ?>  </a>
                    <a href="<?php echo e(url('report/sell/product-wise')); ?>" class="collapse-item <?php echo e(active_if_full_match('report/sell/product-wise')); ?> <?php echo e(active_if_full_match('report/sell/product-wise-filter')); ?>"> <?php echo e(__('pages.product_wise_sales')); ?>  </a>
                    <a href="<?php echo e(url('report/sell/sells')); ?>" class="collapse-item <?php echo e(active_if_full_match('report/sell/sells')); ?> <?php echo e(active_if_full_match('report/sell/sells-filter-result')); ?>"><?php echo e(__('pages.all')); ?> <?php echo e(__('pages.sells')); ?></a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_purchase_report')): ?>
        <li class="nav-item <?php echo e(active_if_full_match('report/purchase/*')); ?>" >
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#purchaseReport" aria-expanded="true" aria-controls="salesReport">
                <i class="fas fa-user-secret"></i>
                <span><?php echo e(__('sidebar.purchase_reports')); ?></span>
            </a>
            <div id="purchaseReport" class="collapse <?php echo e(active_if_match('report/purchase/')); ?>" aria-labelledby="purchaseReport" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a href="<?php echo e(url('report/purchase/summary')); ?>" class="collapse-item <?php echo e(active_if_full_match('report/purchase/summary')); ?> <?php echo e(active_if_full_match('report/purchase/summary-filter')); ?>"> <?php echo e(__('pages.purchase_summary')); ?> </a>
                    <a href="<?php echo e(url('report/purchase/statistics')); ?>" class="collapse-item <?php echo e(active_if_full_match('report/purchase/statistics')); ?> <?php echo e(active_if_full_match('report/purchase/statistics-filter')); ?>  <?php echo e(active_if_full_match('report/purchase/statistics/last/*/days')); ?>"><?php echo e(__('pages.purchase_statistics')); ?>   </a>
                    <a href="<?php echo e(url('report/purchase/product-wise')); ?>" class="collapse-item <?php echo e(active_if_full_match('report/purchase/product-wise')); ?> <?php echo e(active_if_full_match('report/purchase/product-wise-filter')); ?>">  <?php echo e(__('pages.product_wise_purchase')); ?> </a>
                    <a href="<?php echo e(url('report/purchase/purchases')); ?>" class="collapse-item <?php echo e(active_if_full_match('report/purchase/purchases')); ?> <?php echo e(active_if_full_match('report/purchase/purchases-filter-result')); ?>"><?php echo e(__('pages.all')); ?> <?php echo e(__('pages.purchase')); ?></a>
                </div>
            </div>
        </li>
    <?php endif; ?>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_stock')): ?>
        <li class="nav-item <?php echo e(active_if_full_match('report/stock-report')); ?>">
            <a class="nav-link collapsed" href="<?php echo e(url('report/stock-report')); ?>">
                <i class="fas fa-chart-line"></i>
                <span><?php echo e(__('sidebar.stock_report')); ?></span>
            </a>
        </li>
    <?php endif; ?>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['application_setting', 'manage_user'])): ?>
    <!-- Heading -->
    <div class="sidebar-heading"> <?php echo e(__('sidebar.administrative')); ?> </div>
    <?php endif; ?>


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_user')): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#role" aria-expanded="true" aria-controls="sells">
                <i class="fas fa-key"></i>
                <span><?php echo e(__('sidebar.role_and_permission')); ?> </span>
            </a>
            <div id="role" class="collapse <?php echo e(active_if_match('role')); ?> <?php echo e(active_if_match('settings/user/permission')); ?>" aria-labelledby="role" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?php echo e(active_if_full_match('role')); ?>" href="<?php echo e(route('role.index')); ?>"><?php echo e(__('sidebar.roles')); ?></a>

                    <a class="collapse-item <?php echo e(active_if_full_match('settings/user/permission')); ?>" href="<?php echo e(route('userPermission')); ?>"> <?php echo e(__('sidebar.permission')); ?> </a>
                </div>
            </div>
        </li>
    <?php endif; ?>




    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('application_setting')): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo e(route('general-settings')); ?>">
                <i class="fas fa-cogs"></i> <span><?php echo e(__('sidebar.application_settings')); ?></span>
            </a>
        </li>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_trash')): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#trash" aria-expanded="true" aria-controls="sells">
                <i class="fas fa-trash-restore"></i>
                <span><?php echo e(__('sidebar.trash')); ?> </span>
            </a>
            <div id="trash" class="collapse <?php echo e(active_if_match('trash/category')); ?> <?php echo e(active_if_match('trash/tax')); ?> <?php echo e(active_if_match('trash/branch')); ?> <?php echo e(active_if_match('trash/designation')); ?>  <?php echo e(active_if_match('trash/department')); ?> <?php echo e(active_if_match('trash/expense-category')); ?>" aria-labelledby="trash" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_category')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('trash/category')); ?>" href="<?php echo e(route('category-trash')); ?>"><?php echo e(__('sidebar.categories')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_tax')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('trash/tax')); ?>" href="<?php echo e(route('tax-trash')); ?>"><?php echo e(__('sidebar.taxes')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_expense_category')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('trash/expense-category')); ?>" href="<?php echo e(route('expense-category-trash')); ?>"><?php echo e(__('sidebar.expense_category')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_department')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('trash/department-trash')); ?>" href="<?php echo e(route('department-trash')); ?>"><?php echo e(__('sidebar.departments')); ?> </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_designation')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('trash/designation-trash')); ?>" href="<?php echo e(route('designation-trash')); ?>"><?php echo e(__('sidebar.designations')); ?></a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_branch')): ?>
                        <a class="collapse-item <?php echo e(active_if_full_match('trash/branch-trash')); ?>" href="<?php echo e(route('branch-trash')); ?>"><?php echo e(__('sidebar.branch')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
<?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/layouts/particles/sidebar.blade.php ENDPATH**/ ?>