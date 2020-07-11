<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Requisition</title>
    <?php echo $__env->make('backend.pdf.layouts.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body >
<?php echo $__env->make('backend.pdf.layouts.invoice-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<main>

    <div>
        <table class="table" width="100%" style="border: none">
            <tr>
                <td style="border: none">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="2"><?php echo e(__('pages.requisition_form')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td  style="text-align: left"><?php echo e(__('pages.branch')); ?></td>
                            <td  style="text-align: left"><?php echo e($requisition->requisitionFrom->title); ?></td>
                        </tr>

                        <tr>
                            <td style="text-align: left"><?php echo e(__('pages.phone_number')); ?></td>
                            <td style="text-align: left"><?php echo e($requisition->requisitionFrom->phone); ?></td>
                        </tr>

                        <tr>
                            <td  style="text-align: left"><?php echo e(__('pages.address')); ?></td>
                            <td  style="text-align: left"><?php echo e($requisition->requisitionFrom->address); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td style="border: none">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="2"><?php echo e(__('pages.requisition_to')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td  style="text-align: left"><?php echo e(__('pages.branch')); ?></td>
                            <td  style="text-align: left"><?php echo e($requisition->requisitionTo->title); ?></td>
                        </tr>

                        <tr>
                            <td  style="text-align: left"><?php echo e(__('pages.phone_number')); ?></td>
                            <td  style="text-align: left"><?php echo e($requisition->requisitionTo->phone); ?></td>
                        </tr>

                        <tr>
                            <td style="text-align: left"><?php echo e(__('pages.address')); ?></td>
                            <td style="text-align: left"><?php echo e($requisition->requisitionTo->address); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td style="border: none">
                    <table class="table" width="100%" cellspacing="0">
                        <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="2"><?php echo e(__('pages.requisition_summary')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td  style="text-align: left"><?php echo e(__('pages.requisition_id')); ?></td>
                            <td  style="text-align: left"><?php echo e($requisition->requisition_id); ?></td>
                        </tr>

                        <?php if($requisition->status == 2 ): ?>
                            <tr>
                                <td style="text-align: left"><?php echo e(__('pages.transfer_date')); ?></td>
                                <td style="text-align: left"><?php echo e($requisition->complete_date->format(get_option('app_date_format'))); ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td style="text-align: left"><?php echo e(__('pages.created_date')); ?></td>
                                <td style="text-align: left"><?php echo e($requisition->requisition_date->format(get_option('app_date_format'))); ?></td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td  style="text-align: left"><?php echo e(__('pages.status')); ?></td>
                            <td class="p-0" style="text-align: left">
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
                </td>
            </tr>

        </table>
    </div>


    <div class="table-responsive">
        <table class="table" width="100%" cellspacing="0">
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
                    <td colspan="2" class="text-right pr-3">
                       <b> <?php echo e(__('pages.total')); ?>:</b>
                    </td>
                    <td>
                      <b> <?php echo e($requisition->requisitionProducts->sum('quantity')); ?></b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



</main>
<?php echo $__env->make('backend.pdf.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/pdf/requisition/invoice.blade.php ENDPATH**/ ?>