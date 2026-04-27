<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Races</h4>
                    <div>
                        <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-light">
                            <i class="bi bi-arrow-left"></i> Back to Admin
                        </a>
                        <a href="<?php echo e(route('admin.f1.races.create')); ?>" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add Race
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="d-none d-sm-table-cell">Circuit</th>
                                    <th class="d-none d-sm-table-cell">Season</th>
                                    <th class="d-none d-md-table-cell">Date</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $races; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $race): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span><?php echo e($race->name); ?></span>
                                                <small class="d-sm-none text-muted"><?php echo e(optional($race->circuit)->name ?? 'Unknown'); ?> | <?php echo e(optional($race->season)->year ?? 'Unknown'); ?></small>
                                            </div>
                                        </td>
                                        <td class="d-none d-sm-table-cell"><?php echo e(optional($race->circuit)->name ?? 'Unknown'); ?></td>
                                        <td class="d-none d-sm-table-cell"><?php echo e(optional($race->season)->year ?? 'Unknown'); ?></td>
                                        <td class="d-none d-md-table-cell"><?php echo e(optional($race->race_date)->format('M d, Y')); ?></td>
                                        <td><?php echo e($race->status); ?></td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="<?php echo e(route('admin.f1.races.edit', $race)); ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="<?php echo e(route('admin.f1.races.destroy', $race)); ?>" method="POST" style="display: inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this race?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No races found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        <?php echo e($races->links('vendor.pagination.bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
body {
    background: url('/img/sitebg.gif') no-repeat center center fixed !important;
    background-size: cover !important;
}
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 0;
    background: rgba(0, 0, 0, 0.5);
    pointer-events: none;
}
.container {
    position: relative;
    z-index: 1;
}
.card {
    background: rgba(255, 255, 255, 0.95);
    border: none;
}
.card-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}
.list-group-item {
    background: transparent;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/leo/Code/Server Side/CA2_F1_Project/resources/views/admin/f1/races/index.blade.php ENDPATH**/ ?>