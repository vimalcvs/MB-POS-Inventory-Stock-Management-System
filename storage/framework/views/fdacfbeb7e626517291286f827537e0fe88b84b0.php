<?php $__env->startSection('title'); ?> Bank Statement <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .select2-container .select2-selection--single {
            height: 25px;
            outline: 0px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 25px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            margin-top: -7px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Balance Sheet</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="3%"><?php echo e(__('pages.sl')); ?></th>
                                    <th width="8%"><?php echo e(__('pages.date')); ?></th>
                                    <th width="20%"><?php echo e(__('pages.supplier')); ?> / <?php echo e(__('pages.customer')); ?></th>
                                    <th width="30%"><?php echo e(__('pages.description')); ?></th>
                                    <th width="8%">Debit</th>
                                    <th width="8%">Credit</th>
                                    <th>Balance (<?php echo e(get_option('app_currency')); ?>)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $balance_sheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td class="align-middle"><?php echo e($balance->transaction_date); ?></td>
                                        <td class="align-middle">

                                        </td>
                                        <td class="align-middle">  <?php echo e($balance->description); ?> </td>
                                        <td class="align-middle">  <?php echo e($balance->amount < 0 ? number_format(($balance->amount - $balance->amount) - $balance->amount, 2) : ''); ?> </td>
                                        <td class="align-middle">  <?php echo e($balance->amount > 0 ? number_format($balance->amount, 2) : ''); ?> </td>
                                        <td class="align-middle">  <?php echo e($balance->balance); ?> </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php $__env->stopSection(); ?>



<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/balance-sheet/index.blade.php ENDPATH**/ ?>