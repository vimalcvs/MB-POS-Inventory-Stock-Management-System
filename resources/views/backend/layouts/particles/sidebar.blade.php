<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-text mx-3">{{get_option('app_name')}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ active_if_full_match('home') }} ">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{__('pages.dashboard')}}</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    @canany(['manage_category', 'manage_tax', 'manage_product'])
        <div class="sidebar-heading"> {{__('pages.sells_marketing')}} </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="product">
                <i class="fas fa-boxes"></i>
                <span>{{__('pages.manage_product')}}</span>
            </a>
            <div id="product" class="collapse {{ active_if_match('product') }} {{ active_if_match('tax') }} {{ active_if_match('category') }}" aria-labelledby="product" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('manage_category')
                    <a class="collapse-item {{ active_if_full_match('category') }}" href="{{route('category.index')}}">{{__('pages.categories')}}</a>
                    @endcan
                    @can('manage_tax')
                    <a class="collapse-item {{ active_if_full_match('tax') }}" href="{{route('tax.index')}}">{{__('pages.taxes')}}</a>
                     @endcan
                    @can('manage_product')
                    <a class="collapse-item {{ active_if_full_match('product') }} {{ active_if_full_match('product/*/edit') }} {{ active_if_full_match('product/*') }} {{ active_if_full_match('product/create') }} " href="{{route('product.index')}}">{{__('pages.products')}}</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcanany

    @canany(['manage_sell_invoice'])
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#sells" aria-expanded="true" aria-controls="sells">
                <i class="fas fa-list"></i>
                <span>{{__('pages.manage_sell')}}</span>
            </a>
            <div id="sells" class="collapse {{ active_if_match('sell') }}" aria-labelledby="sells" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('create_sell_invoice')
                        <a class="collapse-item {{ active_if_full_match('sell/create') }}" href="{{route('sell.create')}}">{{__('pages.create_invoice')}}</a>
                    @endcan
                    @can('manage_sell_invoice')
                        <a class="collapse-item {{ active_if_full_match('sell') }} {{ active_if_full_match('sell/*/edit') }} {{ active_if_full_match('sell/*') }}" href="{{route('sell.index')}}">{{__('pages.sell_invoice')}}</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    @canany(['create_purchase_invoice', 'manage_purchase_invoice','manage_requisition'])
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#purchase" aria-expanded="true" aria-controls="purchase">
                <i class="fas fa-store"></i>
                <span>{{__('pages.manage_stock')}}</span>
            </a>
            <div id="purchase" class="collapse {{ active_if_match('purchase') }} {{ active_if_match('requisition') }} {{ active_if_match('pending-requisition') }} " aria-labelledby="purchase" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('create_purchase_invoice')
                        <a class="collapse-item {{ active_if_full_match('purchase/create') }}" href="{{route('purchase.create')}}">{{__('pages.create_purchase')}}</a>
                    @endcan

                    @can('manage_purchase_invoice')
                        <a class="collapse-item {{ active_if_full_match('purchase') }} {{ active_if_full_match('purchase/*/edit') }} {{ active_if_full_match('purchase/*') }}" href="{{route('purchase.index')}}">{{__('pages.purchase_invoices')}}</a>
                    @endcan

                    @can('manage_requisition')
                        <a class="collapse-item {{ active_if_full_match('requisition/create') }}" href="{{route('requisition.create')}}">{{__('pages.create_requisition')}}</a>
                        <a class="collapse-item {{ active_if_full_match('pending-requisition') }}" href="{{route('pending-requisition')}}">{{__('pages.pending_requisition')}} ({{pendingRequisition()}})</a>
                        <a class="collapse-item {{ active_if_full_match('requisition') }} {{ active_if_full_match('requisition/*/edit') }} {{ active_if_full_match('requisition/*') }} {{ active_if_full_match('requisition-filter') }} " href="{{route('requisition.index')}}">{{__('pages.manage_requisition')}}</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan


    @canany(['manage_expense', 'manage_expense_category'])
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#expense" aria-expanded="true" aria-controls="expense">
                <i class="fas fa-money-bill"></i>
                <span>{{__('pages.expense')}}</span>
            </a>
            <div id="expense" class="collapse {{ active_if_match('expense') }} {{ active_if_match('expense-category') }}" aria-labelledby="expense" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('manage_expense_category')
                        <a class="collapse-item {{ active_if_full_match('expense-category') }}" href="{{route('expense-category.index')}}">{{__('pages.expense_category')}}</a>
                    @endcan

                    @can('manage_expense')
                        <a class="collapse-item {{ active_if_full_match('expense/create') }}" href="{{route('expense.create')}}">{{__('pages.create_expense')}}</a>
                        <a class="collapse-item {{ active_if_full_match('expense') }} {{ active_if_full_match('expense/*/edit') }} {{ active_if_full_match('expense-filter*') }}" href="{{route('expense.index')}}">{{__('pages.expense_list')}}</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    @canany(['manage_supplier_payment', 'manage_customer_payment'])
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#payment" aria-expanded="true" aria-controls="payment">
                <i class="fas fa-money-bill"></i>
                <span>{{__('pages.payment')}}</span>
            </a>
            <div id="payment" class="collapse {{ active_if_match('payment') }}" aria-labelledby="payment" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('manage_supplier_payment')
                        <a class="collapse-item {{ active_if_full_match('payment-to-supplier-filter') }} {{ active_if_full_match('payment-to-supplier') }} {{ active_if_full_match('payment-to-supplier/create') }} {{ active_if_full_match('payment-to-supplier/*/edit') }}" href="{{route('payment-to-supplier.index')}}">{{__('pages.payment_to_supplier')}}</a>
                    @endcan

                    @can('manage_customer_payment')
                        <a class="collapse-item {{ active_if_full_match('payment-from-customer') }} {{ active_if_full_match('payment-from-customer/create') }} {{ active_if_full_match('payment-from-customer/*/edit') }} {{ active_if_full_match('payment-from-customer-filter') }}" href="{{route('payment-from-customer.index')}}">{{__('pages.received_from_customer')}}</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan


    @canany(['manage_customer', 'manage_supplier','manage_department', 'manage_designation','manage_employee','manage_branch', 'manage_sells_target'])
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading"> {{__('pages.hr_department')}} </div>
    @endcan


    @canany(['manage_department', 'manage_designation','manage_employee'])
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#employee" aria-expanded="true" aria-controls="user">
                <i class="fas fa-users"></i>
                <span>{{__('pages.manage_employees')}}</span>
            </a>
            <div id="employee" class="collapse {{ active_if_match('department') }} {{ active_if_match('employee') }} {{ active_if_match('designation') }}" aria-labelledby="user" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('manage_department')
                        <a class="collapse-item {{ active_if_full_match('department') }}" href="{{route('department.index')}}">{{__('pages.departments')}} </a>
                    @endcan

                    @can('manage_designation')
                        <a class="collapse-item {{ active_if_full_match('designation') }}" href="{{route('designation.index')}}">{{__('pages.designations')}}</a>
                    @endcan

                    @can('manage_employee')
                        <a class="collapse-item {{ active_if_full_match('employee') }} {{ active_if_full_match('employee/*/edit') }} {{ active_if_full_match('employee/*') }}" href="{{route('employee.index')}}">{{__('pages.employees')}}</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan


    @canany(['manage_branch', 'manage_sells_target'])
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#branch" aria-expanded="true" aria-controls="branch">
                <i class="fas fa-code-branch"></i>
                <span>{{__('pages.manage_branch')}}</span>
            </a>
            <div id="branch" class="collapse {{ active_if_match('branch') }} {{ active_if_match('branch-sells-target') }}" aria-labelledby="branch" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('manage_branch')
                        <a class="collapse-item {{ active_if_full_match('branch') }} {{ active_if_full_match('branch/*/edit') }} {{ active_if_full_match('branch/create') }}" href="{{route('branch.index')}}">{{__('pages.branches')}}</a>
                    @endcan

                    @can('manage_sells_target')
                        <a class="collapse-item {{ active_if_full_match('branch-sells-target') }} {{ active_if_full_match('branch-sells-target/create') }}  {{ active_if_full_match('branch-sells-target/*') }} {{ active_if_full_match('branch-sells-target/*/edit') }}" href="{{route('branch-sells-target.index')}}"> {{__('pages.manage_sells_target')}} </a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan


    @canany(['manage_customer', 'manage_supplier'])
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#crm" aria-expanded="true" aria-controls="crm">
                <i class="fas fa-user-secret"></i>
                <span>{{__('pages.crm')}}</span>
            </a>
            <div id="crm" class="collapse {{ active_if_match('customer') }} {{ active_if_match('supplier') }}" aria-labelledby="customer" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('manage_customer')
                        <a class="collapse-item {{ active_if_full_match('customer') }} {{ active_if_full_match('customer/create') }} {{ active_if_full_match('customer/*/edit') }} {{ active_if_full_match('customer/*') }}" href="{{route('customer.index')}}">{{__('pages.manage_customers')}}</a>
                    @endcan

                    @can('manage_supplier')
                        <a class="collapse-item {{ active_if_full_match('supplier') }} {{ active_if_full_match('supplier/create') }} {{ active_if_full_match('supplier/*/edit') }} {{ active_if_full_match('supplier/*') }}" href="{{route('supplier.index')}}">{{__('pages.manage_suppliers')}}</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    @canany(['view_sells_report', 'view_purchase_report', 'view_stock'])
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading"> {{__('pages.reports')}} </div>
    @endcan

    @can('view_sells_report')
        <li class="nav-item {{ active_if_full_match('report/sell/*') }}" >
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#salesReport" aria-expanded="true" aria-controls="salesReport">
                <i class="fas fa-user-secret"></i>
                <span>{{__('pages.sells_report')}}</span>
            </a>
            <div id="salesReport" class="collapse {{ active_if_match('report/sell/') }}" aria-labelledby="salesReport" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a href="{{url('report/sell/summary')}}" class="collapse-item {{ active_if_full_match('report/sell/summary') }} {{ active_if_full_match('report/sell/summary-filter') }}"> {{__('pages.sales_summary')}} </a>
                    <a href="{{url('report/sell/statistics')}}" class="collapse-item {{ active_if_full_match('report/sell/statistics') }} {{ active_if_full_match('report/sell/statistics-filter') }}  {{ active_if_full_match('report/sell/statistics/last/*/days') }}"> {{__('pages.sales_statistics')}}  </a>
                    <a href="{{url('report/sell/product-wise')}}" class="collapse-item {{ active_if_full_match('report/sell/product-wise') }} {{ active_if_full_match('report/sell/product-wise-filter') }}"> {{__('pages.product_wise_sales')}}  </a>
                    <a href="{{url('report/sell/sells')}}" class="collapse-item {{ active_if_full_match('report/sell/sells') }} {{ active_if_full_match('report/sell/sells-filter-result') }}">{{__('pages.all')}} {{__('pages.sells')}}</a>
                </div>
            </div>
        </li>
    @endcan

    @can('view_purchase_report')
        <li class="nav-item {{ active_if_full_match('report/purchase/*') }}" >
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#purchaseReport" aria-expanded="true" aria-controls="salesReport">
                <i class="fas fa-user-secret"></i>
                <span>{{__('pages.purchase_reports')}}</span>
            </a>
            <div id="purchaseReport" class="collapse {{ active_if_match('report/purchase/') }}" aria-labelledby="purchaseReport" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a href="{{url('report/purchase/summary')}}" class="collapse-item {{ active_if_full_match('report/purchase/summary') }} {{ active_if_full_match('report/purchase/summary-filter') }}"> {{__('pages.purchase_summary')}} </a>
                    <a href="{{url('report/purchase/statistics')}}" class="collapse-item {{ active_if_full_match('report/purchase/statistics') }} {{ active_if_full_match('report/purchase/statistics-filter') }}  {{ active_if_full_match('report/purchase/statistics/last/*/days') }}">{{__('pages.purchase_statistics')}}   </a>
                    <a href="{{url('report/purchase/product-wise')}}" class="collapse-item {{ active_if_full_match('report/purchase/product-wise') }} {{ active_if_full_match('report/purchase/product-wise-filter') }}">  {{__('pages.product_wise_purchase')}} </a>
                    <a href="{{url('report/purchase/purchases')}}" class="collapse-item {{ active_if_full_match('report/purchase/purchases') }} {{ active_if_full_match('report/purchase/purchases-filter-result') }}">{{__('pages.all')}} {{__('pages.purchase')}}</a>
                </div>
            </div>
        </li>
    @endcan


    @can('view_stock')
        <li class="nav-item {{ active_if_full_match('report/stock-report') }}">
            <a class="nav-link collapsed" href="{{url('report/stock-report')}}">
                <i class="fas fa-chart-line"></i>
                <span>{{__('pages.stock_report')}}</span>
            </a>
        </li>
    @endcan

    @canany(['application_setting', 'manage_user'])
    <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading"> {{__('pages.miscellaneous')}} </div>
    @endcan

    @can('manage_notice')
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#notice" aria-expanded="true" aria-controls="sells">
                <i class="fas fa-bell fa-fw"></i>
                <span>{{__('pages.notice')}} </span>
            </a>
            <div id="notice" class="collapse {{ active_if_match('notice') }}" aria-labelledby="role" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ active_if_full_match('notice/create') }}" href="{{route('notice.create')}}">{{__('pages.create')}} {{__('pages.notice')}}</a>

                    <a class="collapse-item {{ active_if_full_match('notice') }}" href="{{route('notice.index')}}"> {{__('pages.manage')}} {{__('pages.notice')}} </a>
                </div>
            </div>
        </li>
    @endcan

    @can('manage_todo')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('todo.index')}}">
                <i class="fas fa-list-ul"></i> <span>{{__('pages.todo')}}</span>
            </a>
        </li>
    @endcan


    @canany(['application_setting', 'manage_user'])
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading"> {{__('pages.administrative')}} </div>
    @endcan


    @can('manage_user')
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#role" aria-expanded="true" aria-controls="sells">
                <i class="fas fa-key"></i>
                <span>{{__('pages.role_and_permission')}} </span>
            </a>
            <div id="role" class="collapse {{ active_if_match('role') }} {{ active_if_match('settings/user/permission') }}" aria-labelledby="role" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ active_if_full_match('role') }}" href="{{route('role.index')}}">{{__('pages.roles')}}</a>

                    <a class="collapse-item {{ active_if_full_match('settings/user/permission') }}" href="{{route('userPermission')}}"> {{__('pages.permission')}} </a>
                </div>
            </div>
        </li>
    @endcan

    @can('application_setting')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('general-settings')}}">
                <i class="fas fa-cogs"></i> <span>{{__('pages.application_settings')}}</span>
            </a>
        </li>
    @endcan


    @can('application_setting')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('language.index')}}">
                <i class="fas fa-globe-europe"></i> <span>{{__('pages.language_settings')}}</span>
            </a>
        </li>
    @endcan

    @can('manage_trash')
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#trash" aria-expanded="true" aria-controls="sells">
                <i class="fas fa-trash-restore"></i>
                <span>{{__('pages.trash')}} </span>
            </a>
            <div id="trash" class="collapse {{ active_if_match('trash/category') }} {{ active_if_match('trash/tax') }} {{ active_if_match('trash/branch') }} {{ active_if_match('trash/designation') }}  {{ active_if_match('trash/department') }} {{ active_if_match('trash/expense-category') }}" aria-labelledby="trash" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('manage_category')
                        <a class="collapse-item {{ active_if_full_match('trash/category') }}" href="{{route('category-trash')}}">{{__('pages.categories')}}</a>
                    @endcan

                    @can('manage_tax')
                        <a class="collapse-item {{ active_if_full_match('trash/tax') }}" href="{{route('tax-trash')}}">{{__('pages.taxes')}}</a>
                    @endcan

                    @can('manage_expense_category')
                        <a class="collapse-item {{ active_if_full_match('trash/expense-category') }}" href="{{route('expense-category-trash')}}">{{__('pages.expense_category')}}</a>
                    @endcan

                    @can('manage_department')
                        <a class="collapse-item {{ active_if_full_match('trash/department-trash') }}" href="{{route('department-trash')}}">{{__('pages.departments')}} </a>
                    @endcan

                    @can('manage_designation')
                        <a class="collapse-item {{ active_if_full_match('trash/designation-trash') }}" href="{{route('designation-trash')}}">{{__('pages.designations')}}</a>
                    @endcan

                    @can('manage_branch')
                        <a class="collapse-item {{ active_if_full_match('trash/branch-trash') }}" href="{{route('branch-trash')}}">{{__('pages.branch')}}</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
