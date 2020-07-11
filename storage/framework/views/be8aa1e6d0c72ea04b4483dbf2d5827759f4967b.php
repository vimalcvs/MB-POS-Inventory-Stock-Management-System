<?php $__env->startSection('title'); ?> <?php echo e(__('pages.language')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('pages.language')); ?></h6>
                        <a href="<?php echo e(route('language.create')); ?>" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-plus"></i> <?php echo e(__('pages.add_language')); ?></a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="3%"><?php echo e(__('pages.sl')); ?></th>
                                    <th width="10%"><?php echo e(__('pages.flag')); ?></th>
                                    <th><?php echo e(__('pages.country')); ?></th>
                                    <th><?php echo e(__('pages.iso_code')); ?></th>
                                    <th width="15%"><?php echo e(__('pages.content')); ?></th>
                                    <th width="8%"><?php echo e(__('pages.action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td width="3%"><?php echo e($key + 1); ?></td>
                                            <td><img src="<?php echo e(asset($language->flag)); ?>" class="h-30"></td>
                                            <td><?php echo e($language->language); ?></td>
                                            <td width="10%"><?php echo e($language->iso_code); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('translate', $language->id)); ?>" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i> <?php echo e(__('pages.translate')); ?></a>
                                            </td>
                                            <td class="font-14">
                                                <?php if($language->iso_code != 'en'): ?>
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                        <a href="<?php echo e(route('language.edit', [$language->id])); ?>" class="mr-2"><i class="fa fa-edit text-warning"></i> </a>
                                                        <a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>')) " class=""><i class="fa fa-trash text-danger"></i></a>
                                                        <form action="<?php echo e(route('language.destroy',$language->id)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                                                    </div>
                                                <?php else: ?>
                                                   --
                                                <?php endif; ?>
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


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/language/index.blade.php ENDPATH**/ ?>