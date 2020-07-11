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
                            <div class="col-md-8 text-right">
                                <?php echo $__env->make('backend.payment.customer.filter-from', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php if($errors->any()): ?>
                                        <div class="alert alert-danger">
                                            <ul>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($error); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
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
                                        <th><?php echo e(__('pages.sl')); ?></th>
                                        <th><?php echo e(__('pages.invoice_id')); ?></th>
                                        <th><?php echo e(__('pages.customer')); ?></th>
                                        <th><?php echo e(__('pages.sell_date')); ?></th>
                                        <th><?php echo e(__('pages.sub_total')); ?></th>
                                        <th><?php echo e(__('pages.discount')); ?></th>
                                        <th><?php echo e(__('pages.grand_total')); ?></th>
                                        <th><?php echo e(__('pages.paid_amount')); ?></th>
                                        <th><?php echo e(__('pages.due_amount')); ?></th>
                                        <th width="8%"><?php echo e(__('pages.action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $due_sells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($sell->invoice_id); ?></td>
                                        <td><?php echo e($sell->customer->name); ?></td>
                                        <td><?php echo e($sell->sell_date->format(get_option('app_date_format'))); ?></td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->sub_total, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->discount, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->grand_total_price, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->paid_amount, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->due_amount, 2)); ?> </td>

                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm mr-2 show-payment-details-for-customer" data-sell-id="<?php echo e($sell->id); ?>" data-due-amount="<?php echo e($sell->due_amount); ?>">Pay Now </a>
                                            </div>
                                        </td>
                                    </tr>


                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo e($due_sells->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


    <div class="drawer d-none shadow right payment-details-drawer w-500"id="paymentDrawer">
        <button class="btn btn-primary btn-close drawer-close-btn-for-customer" >x</button>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.payment')); ?></h6>
            </div>
            <div class="card-body pt-4">
                <form action="<?php echo e(route('payment-from-customer.store')); ?>" method="post" data-parsley-validate>
                    <?php echo csrf_field(); ?>

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="row">
                               <input type="hidden" name="sell_id" id="sell_id">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="payment_date"><?php echo e(__('pages.payment_date')); ?> <span class="text-danger">*</span></label>
                                        <input name="payment_date" value="<?php echo e(old('payment_date') ? old('payment_date') : \Carbon\Carbon::now()->format('Y-m-d')); ?>" id="payment_date" type="text" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.date')); ?>" required autocomplete="off">
                                        <?php if($errors->has('payment_date')): ?>
                                            <div class="error"><?php echo e($errors->first('payment_date')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="amount"><?php echo e(__('pages.amount')); ?> <span class="text-danger">*</span></label>
                                        <input type="number" name="amount" id="amount" step=".1" min="0"  placeholder="<?php echo e(__('pages.amount')); ?>" class="form-control" aria-describedby="emailHelp" required>
                                        <?php if($errors->has('amount')): ?>
                                            <div class="error"><?php echo e($errors->first('amount')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note"><?php echo e(__('pages.note')); ?></label>
                                        <textarea name="note" class="form-control"><?php echo e(old('note')); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('pages.save')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('/backend/js/custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/payment/customer/index.blade.php ENDPATH**/ ?>