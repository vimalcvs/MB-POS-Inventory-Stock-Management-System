<?php $__env->startSection('title'); ?> <?php echo e(__('pages.supplier')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.suppliers')); ?></h6>
                        <a href="<?php echo e(route('supplier.create')); ?>" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-plus"></i> <?php echo e(__('pages.create_supplier')); ?></a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th><?php echo e(__('pages.sl')); ?></th>
                                    <th><?php echo e(__('pages.company_name')); ?></th>
                                    <th><?php echo e(__('pages.contact_person')); ?></th>
                                    <th><?php echo e(__('pages.phone_number')); ?></th>
                                    <th><?php echo e(__('pages.email')); ?></th>
                                    <th><?php echo e(__('pages.address')); ?></th>
                                    <th width="8%"><?php echo e(__('pages.action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($supplier->company_name); ?></td>
                                        <td><?php echo e($supplier->contact_person); ?></td>
                                        <td><?php echo e($supplier->phone); ?></td>
                                        <td><?php echo e($supplier->email); ?></td>
                                        <td><?php echo e($supplier->address); ?></td>
                                        <td class="font-14">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="<?php echo e(route('supplier.edit', [$supplier->id])); ?>" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                <a href="<?php echo e(route('supplier.show', [$supplier->id])); ?>" class="mr-2"><i class="fa fa-eye text-primary"></i> </a>
                                                <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                <form action="<?php echo e(route('supplier.destroy',$supplier->id)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                                            </div>
                                        </td>
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
    <!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\server\MAMP\htdocs\pos\package\resources\views/backend/supplier/index.blade.php ENDPATH**/ ?>