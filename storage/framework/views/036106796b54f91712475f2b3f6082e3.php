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
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 0;
    pointer-events: none;
}
.container.py-5 {
    position: relative;
    z-index: 1;
}
</style>
<div class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <?php if($driver->profile_image): ?>
                <img src="<?php echo e($driver->profile_image); ?>" alt="<?php echo e($driver->full_name); ?>" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;" onerror="this.parentElement.style.display='none'">
            <?php endif; ?>
            <div>
                <h1 class="display-5 fw-bold mb-2"><?php echo e($driver->full_name); ?></h1>
                <p class="text-muted">Complete driver profile and career statistics</p>
            </div>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <?php if(auth()->guard()->check()): ?>
                <button class="btn btn-warning favorite-btn"
                        id="favorite-btn-<?php echo e($driver->id); ?>"
                        data-model="driver"
                        data-id="<?php echo e($driver->id); ?>"
                        data-favorited="<?php echo e(Auth::user()->hasFavorited($driver) ? 'true' : 'false'); ?>"
                        onclick="toggleFavorite('driver', <?php echo e($driver->id); ?>)">
                    <i class="bi bi-star<?php echo e(Auth::user()->hasFavorited($driver) ? '-fill' : ''); ?>"></i>
                    <?php echo e(Auth::user()->hasFavorited($driver) ? 'Favorited' : 'Favorite'); ?>

                </button>
            <?php endif; ?>
            <a href="<?php echo e(route('f1.drivers')); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Drivers
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 60px; height: 60px;">
                            <?php echo e($driver->code); ?>

                        </div>
                        <div>
                            <h5 class="card-title mb-0"><?php echo e($driver->full_name); ?></h5>
                            <small>#<?php echo e($driver->driver_number); ?> | <?php echo e($driver->nationality); ?></small>
                            <?php if($driver->team): ?>
                                <br><small><?php echo e($driver->team->name); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-3 col-md-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-warning small">Championships</div>
                                <div class="fw-bold"><?php echo e($driver->world_championships); ?></div>
                            </div>
                        </div>
                        <div class="col-3 col-md-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-danger small">Wins</div>
                                <div class="fw-bold"><?php echo e($driver->wins); ?></div>
                            </div>
                        </div>
                        <div class="col-3 col-md-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-success small">Podiums</div>
                                <div class="fw-bold"><?php echo e($driver->podiums); ?></div>
                            </div>
                        </div>
                        <div class="col-3 col-md-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-primary small">Points</div>
                                <div class="fw-bold"><?php echo e($driver->career_points); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-3">
                        <h6 class="fw-bold mb-2">Driver Details</h6>
                        <div class="row g-2 text-sm">
                            <div class="col-6">
                                <div class="text-muted">Date of Birth</div>
                                <div class="fw-semibold"><?php echo e(optional($driver->date_of_birth)->format('M d, Y') ?? 'Unknown'); ?></div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted">Place of Birth</div>
                                <div class="fw-semibold"><?php echo e($driver->place_of_birth ?? 'Unknown'); ?></div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted">Debut Year</div>
                                <div class="fw-semibold"><?php echo e(optional($driver->debut_year)->format('Y') ?? 'Unknown'); ?></div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted">Status</div>
                                <div class="fw-semibold"><?php echo e($driver->is_active ? 'Active' : 'Retired'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Race Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="display-4 fw-bold text-primary"><?php echo e($stats['total_races']); ?></div>
                        <div class="text-muted">Total Races</div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-warning"><?php echo e($stats['wins']); ?></div>
                                <small class="text-muted">Wins</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-success"><?php echo e($stats['podiums']); ?></div>
                                <small class="text-muted">Podiums</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-primary"><?php echo e($stats['points']); ?></div>
                                <small class="text-muted">Points</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-info"><?php echo e($stats['fastest_laps']); ?></div>
                                <small class="text-muted">Fastest Laps</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Race Results -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">Race Results</h5>
        </div>
        <div class="card-body">
            <?php if($driver->raceResults->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Race</th>
                                <th>Season</th>
                                <th>Position</th>
                                <th>Team</th>
                                <th>Points</th>
                                <th>Fastest Lap</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $driver->raceResults->sortByDesc('race.race_date'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(route('f1.races')); ?>" class="text-decoration-none text-white">
                                            <?php echo e($result->race->name); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e(optional($result->race->season)->year ?? 'Unknown'); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($result->position == 1 ? 'warning' : ($result->position <= 3 ? 'success' : 'secondary')); ?>">
                                            <?php echo e($result->position_text); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e(optional($result->team)->name ?? 'Unknown'); ?></td>
                                    <td><?php echo e($result->points); ?></td>
                                    <td>
                                        <?php if($result->fastest_lap): ?>
                                            <span class="badge bg-info">Yes</span>
                                        <?php else: ?>
                                            <span class="text-muted">No</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-flag fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No Race Results</h4>
                    <p class="text-muted">This driver hasn't participated in any races yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if($driver->bio): ?>
    <!-- Biography -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-info text-white">
            <h5 class="card-title mb-0">Biography</h5>
        </div>
        <div class="card-body">
            <p><?php echo e($driver->bio); ?></p>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<script>
    function toggleFavorite(model, id) {
        const btn = document.getElementById(`favorite-btn-${id}`);

        // Prevent multiple rapid clicks
        if (btn.disabled) return;
        btn.disabled = true;

        fetch(`/favorites/${model}/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const icon = btn.querySelector('i');
                const isFavorited = data.is_favorited;

                // Update button appearance
                if (isFavorited) {
                    icon.className = 'bi bi-star-fill';
                    btn.textContent = '';
                    btn.appendChild(icon);
                    btn.appendChild(document.createTextNode(' Favorited'));
                } else {
                    icon.className = 'bi bi-star';
                    btn.textContent = '';
                    btn.appendChild(icon);
                    btn.appendChild(document.createTextNode(' Favorite'));
                }
            } else {
                alert('Error: ' + (data.message || 'Failed to update favorite'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update favorite. Please try again.');
        })
        .finally(() => {
            btn.disabled = false;
        });
    }
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/leo/Code/Server Side/CA2_F1_Project/resources/views/f1/driver.blade.php ENDPATH**/ ?>