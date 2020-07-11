<?php $__env->startSection('title'); ?> <?php echo e(__('pages.expense')); ?> <?php $__env->stopSection(); ?>
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
                                <?php echo $__env->make('backend.expense.filter-from', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo e(route('expense.create')); ?>" class="btn btn-secondary btn-block"><i class="fa fa-plus mr-2"></i> <?php echo e(__('pages.new_expense')); ?></a>
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
                                        <th width="10%"><?php echo e(__('pages.expense_id')); ?></th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                            <th width="15%"><?php echo e(__('pages.branch')); ?></th>
                                        <?php endif; ?>
                                        <th ><?php echo e(__('pages.expense_date')); ?></th>
                                        <th width="15%"><?php echo e(__('pages.expense_category')); ?></th>

                                        <th><?php echo e(__('pages.amount')); ?></th>
                                        <th width="8%"><?php echo e(__('pages.action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($expense->expense_id); ?></td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                                            <td> <?php echo e($expense->branch->title); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e($expense->expense_date->format(get_option('app_date_format'))); ?></td>

                                        <td > <?php echo e($expense->expenseCategory ? $expense->expenseCategory->name : '--'); ?> </td>
                                        <td> <?php echo e(get_option('app_currency')); ?><?php echo e(number_format($expense->amount, 2)); ?> </td>

                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="<?php echo e(route('expense.edit', [$expense->id])); ?>" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                <a href="javascript:void(0)" class="mr-2 show-expense-details" data-expense-id="<?php echo e($expense->id); ?>"><i class="fa fa-eye"></i> </a>
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="<?php echo e(route('expense.destroy',$expense->id)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="drawer d-none shadow right expense-details-dwawer w-25" id="expenseDetails<?php echo e($expense->id); ?>">
                                        <button class="btn btn-primary btn-close drawer-close-btn-for-expense" >x</button>
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.expense')); ?></h6>
                                            </div>
                                            <div class="card-body pt-4">
                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.expense_id')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"><?php echo e($expense->expense_id); ?></div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.amount')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"><b><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($expense->amount, 2)); ?></b></div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.expense_date')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"><?php echo e($expense->expense_date->format(get_option('app_date_format'))); ?></div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.category')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"><?php echo e($expense->expenseCategory ? $expense->expenseCategory->name : '--'); ?></div>
                                                </div>

                                                <div class="row border-bottom">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.branch')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"><?php echo e($expense->branch->title); ?></div>
                                                </div>



                                                <div class="row border-bottom p-2">
                                                    <div class="col-4 p-1 text-right"><?php echo e(__('pages.note')); ?>:</div>
                                                    <div class="col-8 p-1 pl-5"> <?php echo e($expense->note); ?></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php echo e($expenses->links()); ?>

                        </div>


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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/expense/index.blade.php ENDPATH**/ ?>