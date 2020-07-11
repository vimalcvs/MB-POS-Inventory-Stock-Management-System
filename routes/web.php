<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/local/{ln}', function ($ln) {
    session(['local' => $ln]);
    \Illuminate\Support\Facades\App::setLocale(session()->get('local'));
    return redirect()->back();
});

Route::get('/', function () {
    if ($_ENV['DB_DATABASE'] != ''){
        return redirect('login');
    }else{
        return redirect('install/requirements');
    }
});

Route::get('check-db-connection/{database_hostname}/{database_name}/{database_username}/{database_password}', 'DBCheckController@index');
Route::post('/store-admin-user', 'Auth\RegisterController@storeAdminUser')->name('store-admin-user');

Auth::routes();

Route::middleware('auth', 'active', 'local')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('sells', 'Backend\SellController');
    Route::resource('branch-sells-target', 'Backend\SellsTargetController');
    Route::resource('purchase', 'Backend\PurchaseController');
    Route::get('purchase-filter', 'Backend\PurchaseController@filter')->name('purchase-filter');
    Route::resource('requisition', 'Backend\RequisitionController');
    Route::get('pending-requisition', 'Backend\RequisitionController@pendingRequisition')->name('pending-requisition');
    Route::get('requisition-received/{id}', 'Backend\RequisitionController@statuaChgangeToReceived')->name('requisition-received');
    Route::get('requisition-canceled/{id}', 'Backend\RequisitionController@statuaChgangeToCanceled')->name('requisition-canceled');
    Route::get('requisition-filter', 'Backend\RequisitionController@filter')->name('requisition-filter');
    Route::resource('expense-category', 'Backend\ExpenseCategoryController');
    Route::resource('expense', 'Backend\ExpenseController');
    Route::get('expense-filter', 'Backend\ExpenseController@filter')->name('expense-filter');

    Route::resource('payment-to-supplier', 'Backend\PaymentToSupplierController');
    Route::get('payment-to-supplier-filter', 'Backend\PaymentToSupplierController@filter')->name('payment-to-supplier-filter');
    Route::resource('payment-from-customer', 'Backend\PaymentFromCustomerController');
    Route::get('payment-from-customer-filter', 'Backend\PaymentFromCustomerController@filter')->name('payment-from-customer-filter');


    Route::get('product-barcode/{id}', 'Backend\ProductController@downloadBarcode')->name('downloadProductBarcode');
    Route::resource('product', 'Backend\ProductController');
    Route::get('product-filter', 'Backend\ProductController@filter')->name('product-filter');
    Route::get('change-product-status/{id}', 'Backend\ProductController@changeStatus')->name('change-product-status');
    Route::resource('tax', 'Backend\TaxController');

    Route::resource('sell', 'Backend\SellController');
    Route::get('sell-filter', 'Backend\SellController@filter')->name('sell-filter');

    Route::resource('category', 'Backend\CategoryController');
    Route::resource('user', 'Backend\UserController');
    Route::resource('branch', 'Backend\BranchController');
    Route::resource('supplier', 'Backend\SupplierController');
    Route::get('change-supplier-status/{id}', 'Backend\SupplierController@changeStatus')->name('change-supplier-status');
    Route::resource('customer', 'Backend\CustomerController');
    Route::resource('department', 'Backend\DepartmentController');
    Route::resource('designation', 'Backend\DesignationController');
    Route::resource('employee', 'Backend\EmployeeController');
    Route::get('change-user-status/{user_id}', 'Backend\EmployeeController@changeStatus');
    Route::resource('role', 'Backend\RoleController');
    Route::resource('notice', 'Backend\NoticeController');
    Route::resource('todo', 'Backend\TodoController');

    Route::get('notification/{id}', 'Backend\NotificationController@getNotification')->name('notification');


    Route::prefix('trash')->group(function () {
        Route::get('category', 'Backend\TrashController@categories')->name('category-trash');
        Route::post('category-restore-ok', 'Backend\TrashController@categoryRestore')->name('category-restore-ok');

        Route::get('tax', 'Backend\TrashController@taxes')->name('tax-trash');
        Route::post('tax-restore-ok', 'Backend\TrashController@taxRestore')->name('tax-restore-ok');

        Route::get('expense-category', 'Backend\TrashController@expenseCategories')->name('expense-category-trash');
        Route::post('expense-category-restore-ok', 'Backend\TrashController@expenseCategoryRestore')->name('expense-category-restore-ok');

        Route::get('department-trash', 'Backend\TrashController@department')->name('department-trash');
        Route::post('department-restore-ok', 'Backend\TrashController@departmentRestore')->name('department-restore-ok');

        Route::get('designation-trash', 'Backend\TrashController@designation')->name('designation-trash');
        Route::post('designation-restore-ok', 'Backend\TrashController@designationRestore')->name('designation-restore-ok');

        Route::get('branch-trash', 'Backend\TrashController@branches')->name('branch-trash');
        Route::post('branch-restore-ok', 'Backend\TrashController@branchRestore')->name('branch-restore-ok');
    });

    Route::prefix('report')->group(function () {
        Route::prefix('sell')->group(function () {
            Route::get('summary', 'Backend\SellReportController@sellsSummary');
            Route::get('summary-filter', 'Backend\SellReportController@sellsSummaryFilter');
            Route::get('summary-pdf', 'Backend\SellReportController@sellsSummaryFilterPDF');

            Route::get('statistics', 'Backend\SellReportController@sellsStatistics');
            Route::get('statistics-filter', 'Backend\SellReportController@sellsStatisticsFilter');
            Route::get('statistics-pdf', 'Backend\SellReportController@sellsStatisticsFilterPDF');
            Route::get('statistics/last/{number_of_days}/days', 'Backend\SellReportController@lastDynamicDaysSellsStatistics');
            Route::get('statistics/last/{number_of_days}/days-pdf/{action_type}', 'Backend\SellReportController@lastDynamicDaysSellsStatisticsPDF');

            Route::get('product-wise', 'Backend\SellReportController@productWise');
            Route::get('product-wise-filter', 'Backend\SellReportController@productWiseFilter');
            Route::get('product-wise-pdf', 'Backend\SellReportController@productWiseFilterPDF');

            Route::get('sells', 'Backend\SellReportController@sells');
            Route::get('sells-filter-result', 'Backend\SellReportController@sellsFilter');
            Route::get('sells-pdf', 'Backend\SellReportController@sellsFilterPDF');
        });

        Route::prefix('purchase')->group(function () {
            Route::get('summary', 'Backend\PurchaseReportController@summary');
            Route::get('summary-filter', 'Backend\PurchaseReportController@summaryFilter');
            Route::get('summary-pdf', 'Backend\PurchaseReportController@summaryFilterPDF');

            Route::get('statistics', 'Backend\PurchaseReportController@statistics');
            Route::get('statistics-filter', 'Backend\PurchaseReportController@statisticsFilter');
            Route::get('statistics-pdf', 'Backend\PurchaseReportController@statisticsFilterPDF');
            Route::get('statistics/last/{number_of_days}/days', 'Backend\PurchaseReportController@lastDynamicDaysStatistics');
            Route::get('statistics/last/{number_of_days}/days-pdf/{action_type}', 'Backend\PurchaseReportController@lastDynamicDaysStatisticsPDF');

            Route::get('product-wise', 'Backend\PurchaseReportController@productWise');
            Route::get('product-wise-filter', 'Backend\PurchaseReportController@productWiseFilter');
            Route::get('product-wise-pdf', 'Backend\PurchaseReportController@productWiseFilterPDF');

            Route::get('purchases', 'Backend\PurchaseReportController@purchases');
            Route::get('purchases-filter-result', 'Backend\PurchaseReportController@purchasesFilter');
            Route::get('purchase-pdf', 'Backend\PurchaseReportController@purchasesFilterPDF');
        });

        Route::get('stock-report', 'Backend\StockReportController@index');
        Route::get('stock-report/filter', 'Backend\StockReportController@filter');
        Route::get('stock-report-pdf', 'Backend\StockReportController@stockReportPdf');
        Route::get('payment/supplier', 'Backend\PaymentToSupplierController@pdf');
        Route::get('payment/customer', 'Backend\PaymentFromCustomerController@pdf');

    });

    Route::prefix('export')->group(function () {
        Route::get('sell/invoice/id={sell_id}/type={action_type}', 'Backend\SellController@pdf');
        Route::get('sell/print-invoice/id={sell_id}', 'Backend\SellController@printInvoice');
        Route::get('purchase/print-invoice/id={purchase_id}/type={action_type}', 'Backend\PurchaseController@pdf');
        Route::get('requisition/print-invoice/id={requisition_id}/type={action_type}', 'Backend\RequisitionController@pdf');
        Route::get('stock-report/filter', 'Backend\StockReportController@filter');
        Route::get('stock-report-pdf', 'Backend\StockReportController@stockReportPdf');
    });

    Route::prefix('settings')->group(function () {
        Route::get('profile', 'Backend\SettingsController@profile')->name('profile');
        Route::post('update-profile', 'Backend\SettingsController@updateProfile')->name('update-profile');
        Route::get('password', 'Backend\SettingsController@password')->name('password');
        Route::post('update-password}', 'Backend\SettingsController@updatePassword')->name('update-password');

        Route::get('change-email', 'Backend\SettingsController@changeEmail')->name('change-email');
        Route::post('update-user-email', 'Backend\SettingsController@updateEmail')->name('update-user-email');

        Route::get('general', 'Backend\SettingsController@generalSetting')->name('general-settings');
        Route::post('save-application-setting', 'Backend\SettingsController@saveApplicationSetting')->name('save-application-setting');

        Route::get('prefix', 'Backend\SettingsController@prefixSetting')->name('prefix-settings');
        Route::post('update-prefix', 'Backend\SettingsController@generalSetting')->name('update-prefix');

        Route::get('email', 'Backend\SettingsController@emailSetting')->name('email-settings');
        Route::post('update-email', 'Backend\SettingsController@generalSetting')->name('update-email-settings');

        Route::get('currency', 'Backend\SettingsController@currencySettings')->name('currency-settings');
        Route::post('update-currency', 'Backend\SettingsController@currencySettings')->name('update-currency');

        Route::resource('todo', 'Backend\TodoController');
        Route::resource('language', 'Backend\LanguageController');
        Route::get('translate/{id}', 'Backend\LanguageController@editContent')->name('translate');
        Route::post('update-translate', 'Backend\LanguageController@updateContent')->name('update-translate');


        Route::prefix('user')->group(function (){
            Route::get('permission', 'Backend\SettingsController@permission')->name('userPermission');
            Route::post('save-permission', 'Backend\SettingsController@savePermission')->name('savePermission');
        });
    });

    Route::prefix('vue/api')->group(function (){
        Route::get('get-local-lang','Backend\VeuApiController@getAppLang');
        Route::get('get-app-configs','Backend\VeuApiController@getAppConfigs');
        Route::get('my-branch','Backend\VeuApiController@myBranch');
        Route::get('products','Backend\VeuApiController@products');
        Route::get('products-with-paginate','Backend\VeuApiController@productsWithPaginate');
        Route::get('product-available-stock-qty/{product_id}','Backend\VeuApiController@productAvailableStockQty');
        Route::get('suppliers','Backend\VeuApiController@suppliers');
        Route::get('get-supplier-due/{id}','Backend\VeuApiController@supplierDue');
        Route::get('categories','Backend\VeuApiController@categories');
        Route::get('brands','Backend\VeuApiController@brands');
        Route::get('customers','Backend\VeuApiController@customers');
        Route::get('branches','Backend\VeuApiController@branches');
        Route::get('branches-without-me','Backend\VeuApiController@branchesWithoutMe');
        Route::post('store-customer','Backend\VeuApiController@storeCustomer');
        Route::post('store-sell','Backend\SellController@store');
        Route::post('store-draft','Backend\DraftController@store');
        Route::get('drafts','Backend\DraftController@drafts');
        Route::get('delete-drafts/{id}','Backend\DraftController@destroy');

        Route::post('store-requisition','Backend\RequisitionController@store');
        Route::get('requisition-details/{requisition_id}','Backend\RequisitionController@getRequisitionDetails');
        Route::post('update-requisition-to-confirm','Backend\RequisitionController@updateRequisitionToConfirm');
        Route::get('reject-requisition/{requisition_id}','Backend\RequisitionController@updateRequisitionToReject');
        Route::post('update-requisition','Backend\RequisitionController@updateRequisition');

        Route::get('purchase-details/{purchase_id}','Backend\PurchaseController@getPurchaseDetails');
        Route::get('sell-details/{sell_id}','Backend\SellController@getSellDetails');
        /** ======= get departments ========== */
        Route::get('departments','Backend\DepartmentController@departments');
        /** ====== get designations ========= */
        Route::get('designations', 'Backend\DesignationController@designations');
        Route::get('taxes','Backend\TaxController@taxes');
        Route::get('pending-todos','Backend\TodoController@getPendingTodos');
        Route::get('change-task-status-to-complete/{id}','Backend\TodoController@changeStatusToCompleted');
        Route::get('delete-todo-task/{id}','Backend\TodoController@deleteTask');
    });

    Route::prefix('chart/api')->group(function (){
        Route::get('get-dashboard-data','Backend\ChartApiController@dashboard');
        Route::get('sale-report-statistic-data','Backend\ChartApiController@saleReportStatisticData');
        Route::get('sale-report-statistic-by-day/{days}','Backend\ChartApiController@saleReportStatisticByDay');
        Route::get('sale-report-statistics-filter/{selected_month}/{selected_year}/{selected_branch}/{search_type}','Backend\ChartApiController@saleReportStatisticsFilter');
        Route::get('purchase-report-statistic-data', 'Backend\ChartApiController@purchaseReportStatisticData');
        Route::get('purchase-report-statistic-by-day/{days}','Backend\ChartApiController@purchaseReportStatisticByDay');
        Route::get('purchase-report-statistics-filter/{selected_month}/{selected_year}/{selected_branch}/{search_type}','Backend\ChartApiController@purchaseReportStatisticsFilter');


        Route::get('get-product-data/{id}','Backend\ChartApiController@product');
    });
});

