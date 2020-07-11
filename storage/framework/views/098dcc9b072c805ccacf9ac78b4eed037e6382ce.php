<?php $__env->startSection('title'); ?> <?php echo e(__('pages.purchase')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.purchase_details')); ?></h6>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a href="<?php echo e(route('purchase.edit', [$purchase->id])); ?>" class="btn btn-primary rounded-0"><i class="fa fa-pencil-alt"></i> <?php echo e(__('pages.edit')); ?> </a>
                            <a href="<?php echo e(url('export/purchase/print-invoice/id='.$purchase->id.'/type=pdf')); ?>" class="btn btn-secondary rounded-0"><i class="fa fa-file mr-2"></i> <?php echo e(__('pages.pdf')); ?> </a>
                            <a href="<?php echo e(url('export/purchase/print-invoice/id='.$purchase->id.'/type=print')); ?>" target="_blank" class="btn btn-warning rounded-0"><i class="fa fa-print mr-2"></i> <?php echo e(__('pages.print')); ?> </a>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr class="bg-primary text-white text-center">
                                            <th colspan="2"><?php echo e(__('pages.summary')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e(__('pages.invoice_id')); ?></td>
                                            <td><?php echo e($purchase->invoice_id); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.branch')); ?></td>
                                            <td><?php echo e($purchase->branch->title); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.total_amount')); ?></td>
                                            <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->total_amount, 2)); ?> </td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.paid_amount')); ?></td>
                                            <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->paid_amount, 2)); ?> </td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.due_amount')); ?></td>
                                            <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->due_amount, 2)); ?> </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr class="bg-warning text-white text-center">
                                        <th colspan="2"><?php echo e(__('pages.supplier')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo e(__('pages.company_name')); ?></td>
                                            <td><?php echo e($purchase->supplier->company_name); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.contact_person')); ?></td>
                                            <td><?php echo e($purchase->supplier->contact_person); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.phone_number')); ?></td>
                                            <td><?php echo e($purchase->supplier->phone); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.email')); ?></td>
                                            <td><?php echo e($purchase->supplier->email); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.address')); ?></td>
                                            <td><?php echo e($purchase->supplier->address); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.product')); ?></th>
                                    <th><?php echo e(__('pages.unit_price')); ?></th>
                                    <th><?php echo e(__('pages.quantity')); ?></th>
                                    <th><?php echo e(__('pages.total_price')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $purchase->purchaseProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $purchase_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td width="3%"><?php echo e($key+1); ?></td>
                                            <td><?php echo e($purchase_product->product->title); ?></td>
                                            <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase_product->purchase_price, 2)); ?> </td>
                                            <td> <?php echo e($purchase_product->quantity); ?> </td>
                                            <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase_product->total_price, 2)); ?> </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td colspan="4" class="text-right pr-5">
                                                <strong><?php echo e(__('pages.total_amount')); ?>: </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->total_amount, 2)); ?>

                                                </strong>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" class="text-right pr-5">
                                                <strong><?php echo e(__('pages.paid_amount')); ?>: </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->paid_amount, 2)); ?>

                                                </strong>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" class="text-right pr-5">
                                                <strong><?php echo e(__('pages.due_amount')); ?>: </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($purchase->due_amount, 2)); ?>

                                                </strong>
                                            </td>
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/purchase/show.blade.php ENDPATH**/ ?>