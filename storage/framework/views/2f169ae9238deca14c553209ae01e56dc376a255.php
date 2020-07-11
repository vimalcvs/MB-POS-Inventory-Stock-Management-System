<?php $__env->startSection('title'); ?> <?php echo e(__('pages.product')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid profile">
        <div class="row">
            <div class="col-md-3 pr-0">
                <div class="left-panel text-center">
                    <div class="logo p-2 text-center bg-secondary">
                        <img src="<?php echo e(asset($product->thumbnail ? $product->thumbnail : 'backend/img/blank-thumbnail.jpg')); ?>" class="img-fluid">
                    </div>
                    <h5 class="text-center mt-4 company-name"><?php echo e($product->title); ?></h5>
                    <span class="since"><?php echo e(__('pages.created_at')); ?>: <?php echo e($product->created_at->diffForHumans()); ?></span>

                    <table class="table table-bordered text-left mt-3 table-sm">
                        <tr>
                            <td><?php echo e(__('pages.sku')); ?>:</td>
                            <td><?php echo e($product->sku); ?></td>
                        </tr>

                        <tr>
                            <td><?php echo e(__('pages.category')); ?>:</td>
                            <td><?php echo e($product->category ? $product->category->title : '--'); ?></td>
                        </tr>


                        <tr>
                            <td><?php echo e(__('pages.purchase_price')); ?>:</td>
                            <td><?php echo e(get_option('app_currency')); ?><?php echo e($product->purchase_price); ?></td>
                        </tr>


                        <tr>
                            <td><?php echo e(__('pages.sell_price')); ?>:</td>
                            <td><?php echo e(get_option('app_currency')); ?><?php echo e($product->sell_price); ?></td>
                        </tr>

                        <tr>
                            <td><?php echo e(__('pages.sell_price_type')); ?>:</td>
                            <td><?php echo e($product->price_type == 1 ? 'Fixed' : 'Negotiable'); ?></td>
                        </tr>

                        <tr>
                            <td><?php echo e(__('pages.tax')); ?>:</td>
                            <td><?php echo e($product->tax->title); ?></td>
                        </tr>

                        <tr >
                            <td colspan="2" class="p-2 text-center">
                                <?php echo e($product->short_description); ?>

                            </td>
                        </tr>



                        <tr >
                            <td colspan="2" class="p-0">
                                <?php if($product->status == 1): ?>
                                    <a href="javascript:void(0)" onclick="$(this).confirm('<?php echo e(url('change-product-status/'.$product->id)); ?>');" class="btn btn-success btn-block btn-sm">
                                        <?php echo e(__('pages.active')); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="javascript:void(0)" onclick="$(this).confirm('<?php echo e(url('change-product-status/'.$product->id)); ?>');" class="btn btn-danger btn-block btn-sm">
                                        <?php echo e(__('pages.not_active')); ?>

                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>

            <div class="col-md-9">
                <div class="right-panel">
                    <div class="row p-3">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo e(__('pages.purchase_quantity')); ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo e($product->purchaseProducts->where('branch_id', auth()->user()->employee->branch->id)->sum('quantity')); ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-th fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo e(__('pages.received_from_others_branches')); ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo e(productReceivedFromOthersBranch($product->id)); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('pages.sell_quantity')); ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo e($product->sellProducts->where('branch_id', auth()->user()->employee->branch->id)->sum('quantity')); ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-th fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('pages.send_to_others_branch')); ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo e(productSendToOthersBranch($product->id)); ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-th fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('pages.stock_quantity')); ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo e(productAvailableTransactionStockQty($product->id)); ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-th fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo e(__('pages.total_purchase_amount')); ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                                    <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($product->purchaseProducts->sum('total_price'),2)); ?>

                                                <?php else: ?>
                                                    <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($product->purchaseProducts->where('branch_id', auth()->user()->employee->branch->id)->sum('total_price'),2)); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('pages.total_sell_amount')); ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                                    <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($product->sellProducts->sum('total_price'),2)); ?>

                                                <?php else: ?>
                                                    <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($product->sellProducts->where('branch_id', auth()->user()->employee->branch->id)->sum('total_price'),2)); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo e(__('pages.current_stock_value')); ?> <sub>(Apx)</sub></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                                    <?php echo e(get_option('app_currency')); ?><?php echo e(number_format(($product->purchaseProducts->sum('quantity') - $product->sellProducts->sum('quantity')) * $product->sell_price,2)); ?>

                                                <?php else: ?>
                                                    <?php echo e(get_option('app_currency')); ?><?php echo e(productAvailableTransactionStockQty($product->id) * $product->sell_price); ?>

                                                <?php endif; ?>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row p-3">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center table-sm">
                                    <thead>
                                        <tr class="bg-secondary text-white">
                                            <th scope="col" width="4%"><?php echo e(__('pages.sl')); ?></th>
                                            <th scope="col"><?php echo e(__('pages.branch_name')); ?></th>
                                            <th scope="col"><?php echo e(__('pages.stock_quantity')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php

                                            ?>
                                        <?php $__currentLoopData = $branches_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $branch_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th scope="row"><?php echo e($key + 1); ?></th>
                                                <td><?php echo e($branch_product['branch_name']); ?></td>
                                                <td>
                                                    <?php echo e($branch_product['current_stock']); ?>


                                                    <?php

                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td colspan="2" class="text-right pr-2"><b><?php echo e(__('pages.total')); ?>:</b></td>
                                            <td>
                                                <b><?php echo e($product->purchaseProducts->sum('quantity') - $product->sellProducts->sum('quantity')); ?></b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row p-3">
                        <!-- Area Chart -->
                        <div class="col-xl-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.sales_summary_last_30_days')); ?></h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden"  id="productID" value="<?php echo e($product->id); ?>">
    <input type="hidden"  id="baseUrl" value="<?php echo e(url('/')); ?>">
    <!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('backend/vendor/chart.js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/demo/chart-area-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/demo/chart-pie-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend/js/partial/product.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/product/show.blade.php ENDPATH**/ ?>