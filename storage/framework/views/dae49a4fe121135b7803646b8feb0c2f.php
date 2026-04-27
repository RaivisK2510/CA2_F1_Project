<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">F1 Drivers</h1>
            <p class="text-muted">Complete list of Formula 1 drivers and their career statistics</p>
        </div>
        <a href="<?php echo e(route('f1.dashboard')); ?>" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <form method="GET" action="<?php echo e(route('f1.drivers')); ?>" class="row g-3 mb-4 align-items-center">
        <div class="col-md-6">
            <div class="input-group">
                <input
                    type="search"
                    name="q"
                    value="<?php echo e($filters['q'] ?? ''); ?>"
                    class="form-control"
                    placeholder="Search drivers, code or nationality..."
                    aria-label="Search drivers">
                <button class="btn btn-outline-secondary" type="submit" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-6 text-md-end">
            <div class="d-inline-flex align-items-center">
                <label for="sort" class="me-2 mb-0 text-muted">Sort by</label>

                <select id="sort" name="sort" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="name" <?php echo e(( $filters['sort'] ?? 'name') === 'name' ? 'selected' : ''); ?>>Name</option>
                    <option value="wins" <?php echo e(( $filters['sort'] ?? '') === 'wins' ? 'selected' : ''); ?>>Wins</option>
                    <option value="points" <?php echo e(( $filters['sort'] ?? '') === 'points' ? 'selected' : ''); ?>>Points</option>
                    <option value="championships" <?php echo e(( $filters['sort'] ?? '') === 'championships' ? 'selected' : ''); ?>>Championships</option>
                    <option value="number" <?php echo e(( $filters['sort'] ?? '') === 'number' ? 'selected' : ''); ?>>Car Number</option>
                </select>

                <select id="dir" name="dir" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="asc" <?php echo e(( $filters['dir'] ?? 'asc') === 'asc' ? 'selected' : ''); ?>>Asc</option>
                    <option value="desc" <?php echo e(( $filters['dir'] ?? '') === 'desc' ? 'selected' : ''); ?>>Desc</option>
                </select>

                <button class="btn btn-outline-secondary btn-sm" type="submit">Apply</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-shadow">
                    <a href="<?php echo e(route('f1.driver.show', $driver)); ?>" class="text-decoration-none">
                        <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                            <h5 class="card-title mb-0 text-white fw-bold"><?php echo e($driver->full_name); ?></h5>
                            <small class="text-white-50">#<?php echo e($driver->driver_number); ?> | <?php echo e($driver->nationality); ?></small>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-warning">Championships</div>
                                    <div class="fw-bold"><?php echo e($driver->world_championships); ?></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-danger">Wins</div>
                                    <div class="fw-bold"><?php echo e($driver->wins); ?></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-success">Podiums</div>
                                    <div class="fw-bold"><?php echo e($driver->podiums); ?></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-primary">Points</div>
                                    <div class="fw-bold"><?php echo e($driver->career_points); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-muted small">
                            Born: <?php echo e(optional($driver->date_of_birth)->format('M j, Y') ?? 'Unknown birth'); ?> | Debut: <?php echo e(optional($driver->debut_year)->format('Y') ?? 'Unknown'); ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-person-x fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No drivers found</h4>
                    <p class="text-muted">There are currently no drivers in the database.</p>
                </div>
            </div>
        <?php endif; ?>
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
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.55);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 0;
    pointer-events: none;
}
.container.py-5 {
    position: relative;
    z-index: 1;
}
.driver-header-hover:hover {
    background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 0, 0, 0.6);
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/leo/Code/Server Side/CA2_F1_Project/resources/views/f1/drivers.blade.php ENDPATH**/ ?>