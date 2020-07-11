<?php $__env->startSection('title'); ?> <?php echo e(__('pages.sells')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.sell_details')); ?></h6>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="<?php echo e(route('sell.edit', [$sell->id])); ?>" class="btn btn-primary rounded-0"><i class="fa fa-pencil-alt"></i> <?php echo e(__('pages.edit')); ?> </a>
                            <a href="<?php echo e(url('export/sell/invoice/id='.encrypt($sell->id).'/type=1')); ?>" class="btn btn-secondary rounded-0"><i class="fa fa-download"></i> <?php echo e(__('pages.pdf')); ?> </a>
                            <a href="<?php echo e(url('export/sell/invoice/id='.encrypt($sell->id).'/type=2')); ?>" target="_blank" class="btn btn-warning rounded-0"><i class="fa fa-print"></i> <?php echo e(__('pages.print_invoice')); ?> </a>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr class="bg-secondary text-white text-center">
                                        <th colspan="2"><?php echo e(__('pages.customer')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo e(__('pages.full_name')); ?></td>
                                        <td><?php echo e($sell->customer->name); ?></td>
                                    </tr>

                                    <tr>
                                        <td><?php echo e(__('pages.phone_number')); ?></td>
                                        <td><?php echo e($sell->customer->phone); ?></td>
                                    </tr>

                                    <tr>
                                        <td><?php echo e(__('pages.email')); ?></td>
                                        <td><?php echo e($sell->customer->email); ?></td>
                                    </tr>

                                    <tr>
                                        <td><?php echo e(__('pages.address')); ?></td>
                                        <td><?php echo e($sell->customer->address); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr class="bg-primary text-white text-center">
                                        <th colspan="2"><?php echo e(__('pages.sell_details')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr width="50px">
                                            <td><?php echo e(__('pages.invoice_id')); ?></td>
                                            <td><?php echo e($sell->invoice_id); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.branch')); ?></td>
                                            <td><?php echo e($sell->branch->title); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.sell_date')); ?></td>
                                            <td>
                                                <?php echo e($sell->sell_date->format(get_option('app_date_format'))); ?> <?php echo e(\Carbon\Carbon::parse($sell->created_at)->format('h:i:A')); ?>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.sold_by')); ?></td>
                                            <td><?php echo e($sell->user->name); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr class="bg-secondary text-white text-center">
                                        <th colspan="2"><?php echo e(__('pages.sell_summary')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr width="50px">


                                    <tr>
                                        <td><?php echo e(__('pages.sub_total')); ?></td>
                                        <td><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->sub_total, 2)); ?></td>
                                    </tr>

                                    <tr>
                                        <td><?php echo e(__('pages.discount')); ?></td>
                                        <td><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->discount, 2)); ?></td>
                                    </tr>

                                    <tr>
                                        <td><?php echo e(__('pages.grand_total')); ?></td>
                                        <td><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->grand_total_price, 2)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('pages.paid_amount')); ?></td>
                                        <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->paid_amount, 2)); ?></strong></td>
                                    </tr>

                                    <tr>
                                        <td><?php echo e(__('pages.due_amount')); ?></td>
                                        <td class="text-danger"><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->due_amount, 2)); ?></td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.product_title')); ?></th>
                                    <th><?php echo e(__('pages.unit_price')); ?></th>
                                    <th><?php echo e(__('pages.tax')); ?></th>
                                    <th><?php echo e(__('pages.quantity')); ?></th>
                                    <th><?php echo e(__('pages.total_trice')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $sell->sellProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sell_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td width="3%"><?php echo e($key+1); ?></td>
                                        <td>
                                            <?php echo e($sell_product->product->title); ?>

                                        </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell_product->sell_price, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell_product->tax_amount, 2)); ?> </td>
                                        <td> <?php echo e($sell_product->quantity); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell_product->total_price, 2)); ?> </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="5" class="text-right pr-3">
                                            <?php echo e(__('pages.sub_total')); ?>:
                                        </td>
                                        <td>
                                            <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->sub_total,2)); ?>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5" class="text-right pr-3">
                                            <?php echo e(__('pages.discount')); ?>:
                                        </td>
                                        <td>
                                            <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->discount,2)); ?>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5" class="text-right pr-3">
                                            <?php echo e(__('pages.grand_total')); ?>:
                                        </td>
                                        <td>
                                            <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->grand_total_price,2)); ?>

                                        </td>
                                    </tr>

                                <tr>
                                    <td colspan="5" class="text-right pr-3">
                                        <strong> <?php echo e(__('pages.paid_amount')); ?>:</strong>
                                    </td>
                                    <td><strong><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->paid_amount, 2)); ?></strong></td>
                                </tr>


                                <tr>
                                    <td colspan="5" class="text-right pr-3">
                                        <?php echo e(__('pages.due_amount')); ?>:
                                    </td>
                                    <td class="text-danger">
                                        <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->due_amount,2)); ?>

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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/sell/show.blade.php ENDPATH**/ ?>