<?php $__env->startSection('title'); ?> Stock Report <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid settings-page">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 rounded-0">
                <!-- Card Header - Dropdown -->
                <div class="card-header p-0">
                    <div class="btn-group btn-group-justified nav-buttons" role="group" aria-label="Basic example">
                        <a href="<?php echo e(url('report/stock-report')); ?>" class="btn btn-outline-primary <?php echo e(active_if_full_match('report/stock-report')); ?>"><i class="fas fa-money-check"></i> Stock Summary </a>
                    </div>

                    <div class="btn-group btn-group-sm filter-pdf-btn" role="group">
                        <form action="<?php echo e(url('report/stock-report-pdf')); ?>" method="get">
                            <input type="hidden" name="action_type" value="download">
                            <button type="submit" class="btn btn-secondary rounded-0 btn-sm pl-2 pr-2"><i class="fas fa-file-download mr-2"></i> <?php echo e(__('pages.pdf')); ?> </button>
                        </form>

                        <form action="<?php echo e(url('report/stock-report-pdf')); ?>" method="get" target="_blank">
                            <input type="hidden" name="action_type" value="print">
                            <button type="submit" class="btn btn-warning btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-print mr-2"></i> <?php echo e(__('pages.print')); ?> </button>
                        </form>

                        <form action="<?php echo e(url('report/stock-report-pdf')); ?>" method="get">
                            <input type="hidden" name="action_type" value="csv">
                            <button type="submit" class="btn btn-secondary btn-sm rounded-0 pl-2 pr-2"><i class="fa fa-file-csv mr-2"></i> <?php echo e(__('pages.csv')); ?> </button>
                        </form>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body p-0">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                    <form action="<?php echo e(url('report/stock-report/filter')); ?>" method="get">
                        <div class="row pt-2 ml-0 mr-0 bg-primary">
                            <div class="col-md-4 pr-0">
                                <div class="form-group text-left">
                                    <select name="branch_id" class="form-control select2">
                                        <option value=""><?php echo e(__('pages.all_branch')); ?></option>
                                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->title); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-warning btn-block"><?php echo e(__('pages.search')); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>

                    <div class="table-responsive margin-t-m5" <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?> <?php endif; ?>>
                        <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="2%"><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.product')); ?></th>
                                    <th width="15%"><?php echo e(__('pages.purchase')); ?> <?php echo e(__('pages.quantity')); ?></th>
                                    <th width="15%"><?php echo e(__('pages.sells')); ?> <?php echo e(__('pages.quantity')); ?></th>
                                    <th width="15%"><?php echo e(__('pages.current_stock_quantity')); ?></th>
                                    <th width="15%"><?php echo e(__('pages.current_stock_value')); ?> <sub>(<?php echo e(__('pages.apx')); ?>)</sub></th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $total_purchase_qty = 0;
                                $total_sell_qty = 0;
                                $total_current_stock_qty = 0;
                                $total_current_stock_amount = 0;
                            ?>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                    <?php
                                        $current_stock_qty = $product->purchaseProducts->sum('quantity') - $product->sellProducts->sum('quantity');
                                    ?>
                                <?php else: ?>
                                    <?php
                                        $current_stock_qty =  productAvailableTransactionStockQty($product->id)
                                    ?>
                                <?php endif; ?>


                                <tr class="<?php if($current_stock_qty < 1 ): ?> bg-danger text-white <?php elseif($current_stock_qty < 20): ?> bg-warning text-white <?php else: ?>  <?php endif; ?>">
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($product->title); ?> | <?php echo e($product->sku); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                            <?php echo e($product->purchaseProducts->sum('quantity')); ?>

                                        <?php else: ?>
                                            <?php echo e($product->purchaseProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity')); ?>

                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                            <?php echo e($product->sellProducts->sum('quantity')); ?>

                                        <?php else: ?>
                                            <?php echo e($product->sellProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity')); ?>

                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php echo e($current_stock_qty); ?>

                                    </td>
                                    <td>
                                        <?php
                                            $product_tax = $product->sell_price * $product->tax->value / 100;
                                            $current_stock_amount = $current_stock_qty * ($product->sell_price + $product_tax);
                                        ?>

                                        <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($current_stock_amount,2)); ?>

                                    </td>
                                </tr>



                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                    <?php
                                        $total_purchase_qty += $product->purchaseProducts->sum('quantity');
                                        $total_sell_qty += $product->sellProducts->sum('quantity');
                                    ?>
                                <?php else: ?>
                                    <?php
                                        $total_purchase_qty += $product->purchaseProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity');
                                        $total_sell_qty += $product->sellProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity');
                                    ?>
                                <?php endif; ?>


                                <?php
                                   $total_current_stock_qty += $current_stock_qty;
                                   $total_current_stock_amount += $current_stock_amount;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="2" class="text-right pr-3"><b>Total: </b></td>
                                    <td><b><?php echo e($total_purchase_qty); ?></b></td>


                                    <td><b><?php echo e($total_sell_qty); ?></b></td>


                                    <td><b><?php echo e($total_current_stock_qty); ?></b></td>
                                    <td><b><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($total_current_stock_amount,2)); ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/report/stock/index.blade.php ENDPATH**/ ?>