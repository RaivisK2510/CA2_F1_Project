<?php $__env->startSection('content'); ?>
<style>
body {
    background: url('/img/sitebg.gif') no-repeat center center fixed !important;
    background-size: cover !important;
    position: relative;
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
.container.py-5 {
    position: relative;
    z-index: 1;
}
</style>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">F1 Seasons</h1>
            <p class="text-muted">Explore Formula 1 seasons, champions, and race statistics</p>
        </div>
        <a href="<?php echo e(route('f1.dashboard')); ?>" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <form method="GET" action="<?php echo e(route('f1.seasons')); ?>" class="row g-3 mb-4 align-items-center">
        <div class="col-md-6">
            <div class="input-group">
                <input
                    type="search"
                    name="q"
                    value="<?php echo e($filters['q'] ?? ''); ?>"
                    class="form-control"
                    placeholder="Search seasons by year, champion or description..."
                    aria-label="Search seasons">
                <button class="btn btn-outline-secondary" type="submit" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-6 text-md-end">
            <div class="d-inline-flex align-items-center">
                <label for="sort" class="me-2 mb-0 text-muted">Sort by</label>

                <select id="sort" name="sort" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="year" <?php echo e(( $filters['sort'] ?? 'year') === 'year' ? 'selected' : ''); ?>>Year</option>
                    <option value="races" <?php echo e(( $filters['sort'] ?? '') === 'races' ? 'selected' : ''); ?>>Total Races</option>
                    <option value="completed" <?php echo e(( $filters['sort'] ?? '') === 'completed' ? 'selected' : ''); ?>>Completed Races</option>
                    <option value="active" <?php echo e(( $filters['sort'] ?? '') === 'active' ? 'selected' : ''); ?>>Active</option>
                </select>

                <select id="dir" name="dir" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="asc" <?php echo e(( $filters['dir'] ?? 'desc') === 'asc' ? 'selected' : ''); ?>>Asc</option>
                    <option value="desc" <?php echo e(( $filters['dir'] ?? 'desc') === 'desc' ? 'selected' : ''); ?>>Desc</option>
                </select>

                <button class="btn btn-outline-secondary btn-sm" type="submit">Apply</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-shadow">
                    <a href="<?php echo e(route('f1.season.show', $season)); ?>" class="text-decoration-none">
                        <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 text-white fw-bold"><?php echo e($season->year); ?></h5>
                                <?php if($season->is_active): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Completed</span>
                                <?php endif; ?>
                            </div>
                            <?php if($season->description): ?>
                                <small class="text-white-50"><?php echo e($season->description); ?></small>
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-primary">Total Races</div>
                                    <div class="fw-bold"><?php echo e($season->total_races); ?></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-success">Completed</div>
                                    <div class="fw-bold"><?php echo e($season->completed_races); ?></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-info">Progress</div>
                                    <div class="progress mt-1" style="height: 6px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo e($season->completion_percentage); ?>%" aria-valuenow="<?php echo e($season->completion_percentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="fw-bold small mt-1"><?php echo e($season->completion_percentage); ?>%</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-2">Champions</h6>
                            <div class="row g-2 text-sm">
                                <?php if($season->championDriver): ?>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="text-muted small">Driver Champion</div>
                                                <div class="fw-semibold"><?php echo e($season->championDriver->full_name); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($season->championTeam): ?>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="text-muted small">Team Champion</div>
                                                <div class="fw-semibold"><?php echo e($season->championTeam->name); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="text-muted small">Season Dates</div>
                                            <div class="fw-semibold">
                                                <?php echo e(optional($season->start_date)->format('M d, Y') ?? 'TBA'); ?>

                                                -
                                                <?php echo e(optional($season->end_date)->format('M d, Y') ?? 'TBA'); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No seasons found</h4>
                    <p class="text-muted">There are currently no seasons in the database.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.driver-header-hover:hover, .team-header-hover:hover, .season-header-hover:hover {
    background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 0, 0, 0.6);
}
.driver-header-hover:hover .bg-white.text-primary,
.team-header-hover:hover .bg-white.text-primary,
.season-header-hover:hover .bg-white {
    background: white !important;
    color: #ff0000 !important;
}

.hover-shadow:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/leo/Code/Server Side/CA2_F1_Project/resources/views/f1/seasons.blade.php ENDPATH**/ ?>