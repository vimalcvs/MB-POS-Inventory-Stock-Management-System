<?php $__env->startSection('title'); ?> <?php echo e(__('pages.requisition')); ?>  <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if($requisition->status == 0 && $requisition->requisition_from != auth()->user()->employee->branch_id): ?>
        <div id="app">
            <show-requisition :requisition="<?php echo e($requisition); ?>"></show-requisition>
        </div>
    <?php else: ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 rounded-0">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.requisition_details')); ?></h6>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <?php if($requisition->requisition_from == auth()->user()->employee->branch_id && $requisition->status == 0): ?>
                                    <a href="<?php echo e(route('requisition.edit', [$requisition->id])); ?>" class="btn btn-primary rounded-0"><i class="fa fa-pencil-alt"></i> Edit </a>
                                <?php endif; ?>
                                <a href="<?php echo e(url('/export/requisition/print-invoice/id='.$requisition->id.'/type={print}')); ?>" target="_blank" class="btn btn-warning rounded-0"><i class="fa fa-print"></i> Print </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr class="bg-secondary text-white text-center">
                                                <th colspan="2"><?php echo e(__('pages.requisition_form')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?php echo e(__('pages.branch')); ?></td>
                                            <td><?php echo e($requisition->requisitionFrom->title); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.phone_number')); ?></td>
                                            <td><?php echo e($requisition->requisitionFrom->phone); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.address')); ?></td>
                                            <td><?php echo e($requisition->requisitionFrom->address); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                        <tr class="bg-secondary text-white text-center">
                                            <th colspan="2"><?php echo e(__('pages.requisition_to')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?php echo e(__('pages.branch')); ?></td>
                                            <td><?php echo e($requisition->requisitionTo->title); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.phone_number')); ?></td>
                                            <td><?php echo e($requisition->requisitionTo->phone); ?></td>
                                        </tr>

                                        <tr>
                                            <td><?php echo e(__('pages.address')); ?></td>
                                            <td><?php echo e($requisition->requisitionTo->address); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                        <tr class="bg-secondary text-white text-center">
                                            <th colspan="2"><?php echo e(__('pages.requisition_summary')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?php echo e(__('pages.requisition_id')); ?></td>
                                            <td><?php echo e($requisition->requisition_id); ?></td>
                                        </tr>

                                        <?php if($requisition->status == 2 ): ?>
                                            <tr>
                                                <td><?php echo e(__('pages.transfer_date')); ?></td>
                                                <td><?php echo e($requisition->complete_date->format(get_option('app_date_format'))); ?></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr>
                                                <td><?php echo e(__('pages.created_date')); ?></td>
                                                <td><?php echo e($requisition->requisition_date->format(get_option('app_date_format'))); ?></td>
                                            </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <td>Status</td>
                                            <td class="p-0">
                                                <?php if($requisition->status == 0): ?>
                                                    <label class="btn btn-warning btn-sm btn-block m-0"><b><?php echo e(__('pages.pending')); ?></b></label>
                                                <?php elseif($requisition->status == 1): ?>
                                                    <label class="btn btn-info btn-sm btn-block m-0"><b><?php echo e(__('pages.delivered')); ?></b></label>
                                                <?php elseif($requisition->status == 2): ?>
                                                    <label class="btn btn-success btn-sm btn-block m-0"><b><?php echo e(__('pages.complete')); ?></b></label>
                                                <?php elseif($requisition->status == 3): ?>
                                                    <label class="btn btn-danger btn-sm btn-block m-0"><b><?php echo e(__('pages.rejected')); ?></b></label>
                                                <?php else: ?>
                                                    <label class="btn btn-danger btn-sm btn-block m-0"><b><?php echo e(__('pages.canceled')); ?></b></label>
                                                <?php endif; ?>
                                            </td>
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
                                        <th><?php echo e(__('pages.product')); ?></th>
                                        <th><?php echo e(__('pages.quantity')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $requisition->requisitionProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $requisition_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td width="3%"><?php echo e($key+1); ?></td>
                                            <td><?php echo e($requisition_product->product->title); ?></td>
                                            <td> <?php echo e($requisition_product->quantity); ?> </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="2" class="text-right pr-5">
                                            <strong><?php echo e(__('pages.total')); ?>:</strong>
                                        </td>

                                        <td>
                                            <strong><?php echo e($requisition->requisitionProducts->sum('quantity')); ?></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <?php if($requisition->requisition_from == auth()->user()->employee->branch_id && $requisition->status == 1): ?>
                                    <a href="<?php echo e(route('requisition-received', [$requisition->id])); ?>" class="btn btn-primary rounded-0 btn-block" onclick="return confirm('Are you sure. you want to receive this requisition ? ')"> Received </a>
                                <?php endif; ?>

                                <?php if($requisition->requisition_from == auth()->user()->employee->branch_id && $requisition->status < 2): ?>
                                    <a href="<?php echo e(route('requisition-canceled', [$requisition->id])); ?>" class="btn btn-danger rounded-0 btn-block" onclick="return confirm('Are you sure. you want to cancel this requisition ?')"> Cancel </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('public/backend/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/requisition/show.blade.php ENDPATH**/ ?>