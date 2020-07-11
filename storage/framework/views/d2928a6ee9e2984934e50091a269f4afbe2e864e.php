<?php $__env->startSection('title'); ?> <?php echo e(__('pages.payment')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header">
                        <div class="row margin-b-m15">
                            <div class="col-md-10 text-right">
                                <?php echo $__env->make('backend.payment.supplier.filter-from', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <a href="<?php echo e(route('payment-to-supplier.create')); ?>" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> <?php echo e(__('pages.new_payment')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="3%"><?php echo e(__('pages.sl')); ?></th>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                        <th width="20%"><?php echo e(__('pages.branch')); ?></th>
                                    <?php endif; ?>
                                    <th width="20%"><?php echo e(__('pages.supplier')); ?></th>
                                    <th ><?php echo e(__('pages.date')); ?></th>
                                    <th><?php echo e(__('pages.amount')); ?></th>
                                    <th width="8%"><?php echo e(__('pages.action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                            <td> <?php echo e($payment->branch->title); ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="<?php echo e(route('supplier.show', [$payment->supplier_id])); ?>" target="_blank">
                                                <?php echo e($payment->supplier ? $payment->supplier->company_name : '--'); ?>

                                            </a>
                                        </td>
                                        <td><?php echo e($payment->payment_date->format(get_option('app_date_format'))); ?></td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($payment->amount, 2)); ?> </td>

                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="<?php echo e(route('payment-to-supplier.edit', [$payment->id])); ?>" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                <a href="javascript:void(0)" class="mr-2 show-payment-details" data-payment-id="<?php echo e($payment->id); ?>"><i class="fa fa-eye"></i> </a>
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="<?php echo e(route('payment-to-supplier.destroy',$payment->id)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="drawer d-none shadow right payment-details-drawer w-500" id="paymentDetails<?php echo e($payment->id); ?>">
                                        <button class="btn btn-primary btn-close drawer-close-btn" >x</button>
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.payment')); ?></h6>
                                            </div>
                                            <div class="card-body pt-4">

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                                    <div class="row border-bottom">
                                                        <div class="col-4 p-1 text-right"><?php echo e(__('pages.branch')); ?>:</div>
                                                        <div class="col-8 p-1 pl-5"><?php echo e($payment->branch->title); ?></div>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.supplier')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"><?php echo e($payment->supplier ? $payment->supplier->company_name : '--'); ?></div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.amount')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"><b><?php echo e(get_option('app_currency')); ?><?php echo e(number_format($payment->amount, 2)); ?></b></div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.payment_date')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"><?php echo e($payment->payment_date->format(get_option('app_date_format'))); ?></div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.note')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"><?php echo e($payment->note); ?></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($payments->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('/backend/js/custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/payment/supplier/index.blade.php ENDPATH**/ ?>