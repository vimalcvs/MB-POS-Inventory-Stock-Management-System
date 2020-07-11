<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sells Report</title>
    <?php echo $__env->make('backend.pdf.layouts.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body >
<?php echo $__env->make('backend.pdf.layouts.report-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<main>
    <div id="details" class="clearfix">
        <div id="client"class="mt-10">
            <h2 class="name">Sells Statistics</h2>
        </div>
    </div>


    <table class="table" width="100%" cellspacing="0">
            <thead>
                <tr class="bg-secondary text-white">
                    <th scope="col">#</th>
                    <th scope="col"><?php echo e(__('pages.data_title')); ?></th>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                        <th><?php echo e(__('pages.branch')); ?></th>
                    <?php endif; ?>
                    <th scope="col"><?php echo e(__('pages.total_amount')); ?></th>
                </tr>
            </thead>
            <tbody>
                `<?php
                    $grand_total_amount = 0;
                ?>
                <?php for($d=0; $d < count($sell_info); $d++): ?>
                    <tr>
                        <th scope="row"><?php echo e($d + 1); ?></th>
                        <td>
                            <?php if(Request::get('year')): ?><?php echo e(Request::get('year')); ?> ,<?php endif; ?>
                                <?php if(Request::get('search_type') != 'year'): ?>
                                    <?php echo e(\Carbon\Carbon::parse($sell_info[$d]['sell_date'])->format(get_option('app_date_format'))); ?>

                                <?php else: ?>
                                    <?php echo e($sell_info[$d]['sell_date']); ?>

                                <?php endif; ?>
                        </td>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                            <td>
                                <?php if(Request::get('branch_id')): ?>
                                    <?php echo e(\App\Models\Branch::findOrFail(Request::get('branch_id'))->title); ?>

                                <?php else: ?>
                                    <?php echo e(__('pages.all_branch')); ?>

                                <?php endif; ?>
                            </td>
                        <?php endif; ?>

                        <td><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($sell_info[$d]['total_sell_amount'], 2)); ?></td>
                        <?php
                            $grand_total_amount += $sell_info[$d]['total_sell_amount'];
                        ?>
                    </tr>
                <?php endfor; ?>
                <tr>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_to_all_branch')): ?>
                        <td colspan="3"><strong><?php echo e(__('pages.grand_total')); ?></strong></td>
                     <?php else: ?>
                        <td colspan="2"><strong><?php echo e(__('pages.grand_total')); ?></strong></td>
                    <?php endif; ?>
                    <td><strong><?php echo e(get_option('app_currency')); ?> <?php echo e(number_format($grand_total_amount, 2)); ?></strong></td>
                </tr>
            </tbody>
        </table>


</main>
<?php echo $__env->make('backend.pdf.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH E:\server\MAMP\htdocs\pos\mbpos\resources\views/backend/pdf/reports/sells/statistics.blade.php ENDPATH**/ ?>