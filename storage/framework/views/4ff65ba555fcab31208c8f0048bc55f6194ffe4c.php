<?php $__env->startSection('title'); ?> Settings <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        <?php echo $__env->make('backend.settings.partial.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body pt-5">
                        <form action="<?php echo e(route('save-application-setting')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data"  data-parsley-validate>
                            <?php echo csrf_field(); ?>

                            <div class="row justify-content-center pt-5">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="product_sku_prefix"><?php echo e(__('pages.product')); ?></label>
                                        <input name="product_sku_prefix" value="<?php echo e(get_option('product_sku_prefix')); ?>" type="text" class="form-control" placeholder="Product SKU Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="product_sku_prefix"><?php echo e(__('pages.purchase_invoice')); ?></label>
                                        <input name="purchase_invoice_prefix" value="<?php echo e(get_option('purchase_invoice_prefix')); ?>" type="text" class="form-control" placeholder="Purchase Invoice Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="product_sku_prefix"><?php echo e(__('pages.sell_invoice')); ?></label>
                                        <input name="sell_invoice_prefix" value="<?php echo e(get_option('sell_invoice_prefix')); ?>" type="text" class="form-control" placeholder="Sell Invoice Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="requisition_id_prefix"><?php echo e(__('pages.requisition_id')); ?></label>
                                        <input name="requisition_id_prefix" value="<?php echo e(get_option('requisition_id_prefix')); ?>" type="text" class="form-control" placeholder="Requisition ID Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="expense_id_prefix"><?php echo e(__('pages.expense_id')); ?></label>
                                        <input name="expense_id_prefix" value="<?php echo e(get_option('expense_id_prefix')); ?>" type="text" class="form-control" placeholder="Expense ID Prefix" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="invoice_length">Invoice Min Length</label>
                                        <input name="invoice_length" value="<?php echo e(get_option('invoice_length')); ?>" type="number" step="1" min="1" max="9" class="form-control" placeholder="Ex. 6" required>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Save & Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/settings/prefix.blade.php ENDPATH**/ ?>