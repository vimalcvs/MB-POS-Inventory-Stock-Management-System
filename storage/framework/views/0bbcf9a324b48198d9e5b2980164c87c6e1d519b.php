<?php $__env->startSection('title'); ?> <?php echo e(__('pages.product')); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 align-items-center justify-content-between">
                        <div class="row">
                            <div class="col-md-10 col-12">
                                <form action="<?php echo e(route('product-filter')); ?>" method="get">
                                    <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="text" name="search_key" value="<?php echo e(Request::get('search_key')); ?>"  class="form-control" placeholder="<?php echo e(__('pages.product_search_kye')); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <select name="category_id" class="form-control select2">
                                                <option value=""> <?php echo e(__('pages.all_category')); ?></option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" <?php echo e(Request::get('category_id') ==  $category->id ? 'selected' : ''); ?>><?php echo e($category->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                           <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('pages.search')); ?></button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="col-md-2 cl-12">
                                <div class="float-right">
                                    <a href="<?php echo e(route('product.create')); ?>" class="btn btn-secondary btn-block rounded-0"><i class="fa fa-plus"></i> <?php echo e(__('pages.create_product')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body mt-3">

                        <div class="row products pt-5" >
                            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-md-3 p-2">
                                    <div class="card">
                                        <div class="box">
                                            <div class="img">
                                                <a href="<?php echo e(route('product.show', [$product->id])); ?>">
                                                    <img src="<?php echo e(asset($product->thumbnail ? $product->thumbnail : 'backend/img/blank-thumbnail.jpg')); ?>">
                                                </a>
                                            </div>
                                            <h2>
                                                <?php echo e($product->title); ?><br>
                                                <span><?php echo e(__('pages.sku')); ?>: <?php echo e($product->sku); ?></span>
                                            </h2>
                                            <p>
                                                <span class="text-primary"> <?php echo e(__('pages.purchase')); ?> : <?php echo e(get_option('app_currency')); ?><?php echo e($product->purchase_price); ?>,</span>
                                                <span class="text-warning"> <?php echo e(__('pages.sell')); ?>: <?php echo e(get_option('app_currency')); ?><?php echo e($product->sell_price); ?></span>
                                                <br>
                                                <span class="text-success">
                                                    <?php echo e(__('pages.stock_quantity')); ?>: <?php echo e(productAvailableTransactionStockQty($product->id)); ?>

                                                </span>
                                            </p>
                                            <span>
                                        <ul>
                                            <li><a href="<?php echo e(route('product.edit', [$product->id])); ?>"><i class="fa fa-edit text-primary" aria-hidden="true"></i></a></li>
                                            <li><a href="<?php echo e(route('product.show', [$product->id])); ?>"><i class="fa fa-eye text-secondary" aria-hidden="true"></i></a></li>
                                            <li><a href="javascript:void(0)" class="download-bar-code" data-id="<?php echo e($product->id); ?>"><i class="fa fa-barcode text-secondary" aria-hidden="true"></i></a></li>
                                            <li><a href="javascript:void(0);" onclick="$(this).confirmDelete($('#delete-<?php echo e($key); ?>'))"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></li>
                                            <form action="<?php echo e(route('product.destroy',$product->id)); ?>" method="post" id="delete-<?php echo e($key); ?>"> <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?> </form>
                                        </ul>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-md-12 py-5 text-center">
                                    <h1 class="text-warning py-5">No product found</h1>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <?php echo e($products->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->



    <!-- Modal -->
    <div class="modal fade mt-5" id="barCodeQty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Barcode Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="productBarCode" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="number" name="quantity" value="1" min="1" max="500" class="form-control" placeholder="Input Barcode Quantity" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Download</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="baseURL" value="<?php echo e(url('/')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('/backend/js/custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mbpos-1.3\resources\views/backend/product/index.blade.php ENDPATH**/ ?>