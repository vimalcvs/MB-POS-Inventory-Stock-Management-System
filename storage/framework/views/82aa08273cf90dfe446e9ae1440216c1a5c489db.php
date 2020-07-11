<?php $__env->startSection('title'); ?> <?php echo e(__('pages.sells')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header">
                        <div class="row margin-b-m15">
                            <div class="col-md-12 text-right">
                                <form action="<?php echo e(route('sell-filter')); ?>" method="get">
                                    <div class="row p-0">
                                        <div class="col-md-2 pr-0">
                                            <div class="form-group text-left">
                                               <input type="text" name="invoice_id" value="<?php echo e(Request::get('invoice_id')); ?>" class="form-control" placeholder="<?php echo e(__('pages.invoice_id')); ?>">
                                            </div>
                                        </div>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                            <div class="col-md-2 pr-0">
                                                <div class="form-group text-left">
                                                    <select name="branch_id" class="form-control select2">
                                                        <option value=""><?php echo e(__('pages.all_branch')); ?></option>
                                                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($branch->id); ?>" <?php echo e(Request::get('branch_id') == $branch->id ? 'selected' : ''); ?>><?php echo e($branch->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <input type="hidden" name="branch_id" value="<?php echo e(auth()->user()->employee->branch_id); ?>">
                                        <?php endif; ?>


                                        <div class="col-md-2 pr-0">
                                            <div class="form-group text-left">
                                                <select name="customer_id" class="form-control select2">
                                                    <option value=""><?php echo e(__('pages.all_customer')); ?></option>
                                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($customer->id); ?>" <?php echo e(Request::get('customer_id') == $customer->id ? 'selected' : ''); ?>><?php echo e($customer->name); ?>, <?php echo e($customer->phone); ?> </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 pr-0">
                                            <div class="form-group text-left">
                                                <input type="text" name="start_date" value="<?php echo e(Request::get('start_date')); ?>" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.start_date')); ?>" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-2 pl-0">
                                            <div class="form-group text-left">
                                                <input type="text" name="end_date" value="<?php echo e(Request::get('end_date')); ?>" data-date-format="yyyy-mm-dd" class="datepicker form-control" placeholder="<?php echo e(__('pages.end_date')); ?>" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button class="btn btn-secondary btn-block"><?php echo e(__('pages.search')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered text-center" style="font-size: 12px" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.invoice_id')); ?></th>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                        <th><?php echo e(__('pages.branch')); ?></th>
                                    <?php endif; ?>
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
                                <?php $__currentLoopData = $sells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($sell->invoice_id); ?></td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                        <td><?php echo e($sell->branch->title); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e($sell->customer->name); ?></td>
                                        <td><?php echo e($sell->sell_date->format(get_option('app_date_format'))); ?></td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->sub_total, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->discount, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->grand_total_price, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->paid_amount, 2)); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($sell->due_amount, 2)); ?> </td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="<?php echo e(route('sell.edit', [$sell->id])); ?>" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                <a href="<?php echo e(route('sell.show', [$sell->id])); ?>" class="mr-2"><i class="fa fa-eye"></i> </a>
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="<?php echo e(route('sell.destroy',$sell->id)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php echo e($sells->links()); ?>

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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/sell/index.blade.php ENDPATH**/ ?>