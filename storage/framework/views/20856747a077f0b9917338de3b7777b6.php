<?php $__env->startSection('content'); ?>
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
.container.py-5 {
    position: relative;
    z-index: 1;
}
</style>
<div class="container py-5">
    <!-- User Profile Header -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                    <h3 class="card-title mb-0 text-white fw-bold">
                        <i class="bi bi-person-circle"></i> My Profile
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="text-muted small">Name</label>
                                <h5 class="fw-bold"><?php echo e($user->name); ?></h5>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Email</label>
                                <h5 class="fw-bold"><?php echo e($user->email); ?></h5>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Account Type</label>
                                <h5 class="fw-bold">
                                    <?php if($user->is_admin): ?>
                                        <span class="badge bg-danger">Administrator</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">User</span>
                                    <?php endif; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <div class="display-4 fw-bold text-primary"><?php echo e($user->favorites()->count()); ?></div>
                                <div class="text-muted">Total Favorites</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Favorites by Category -->
    <?php
        $drivers = $user->favorites()->where('favoritable_type', 'App\Models\Driver')->with('favoritable')->get();
        $teams = $user->favorites()->where('favoritable_type', 'App\Models\Team')->with('favoritable')->get();
        $circuits = $user->favorites()->where('favoritable_type', 'App\Models\Circuit')->with('favoritable')->get();
        $seasons = $user->favorites()->where('favoritable_type', 'App\Models\Season')->with('favoritable')->get();
        $races = $user->favorites()->where('favoritable_type', 'App\Models\Race')->with('favoritable')->get();
    ?>

    <?php if($user->favorites()->count() === 0): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm text-center py-5">
                    <div class="card-body">
                        <i class="bi bi-star fs-1 text-muted"></i>
                        <h4 class="mt-3 text-muted">No Favorites Yet</h4>
                        <p class="text-muted mb-3">Start adding your favorite drivers, teams, circuits, seasons, and races!</p>
                        <div class="btn-group" role="group">
                            <a href="<?php echo e(route('f1.drivers')); ?>" class="btn btn-outline-primary">
                                <i class="bi bi-people"></i> Browse Drivers
                            </a>
                            <a href="<?php echo e(route('f1.teams')); ?>" class="btn btn-outline-primary">
                                <i class="bi bi-building"></i> Browse Teams
                            </a>
                            <a href="<?php echo e(route('f1.circuits')); ?>" class="btn btn-outline-primary">
                                <i class="bi bi-geo"></i> Browse Circuits
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Drivers -->
        <?php if($drivers->count() > 0): ?>
            <div class="row mb-5">
                <div class="col-md-12">
                    <h4 class="fw-bold mb-4">
                        <i class="bi bi-person-badge"></i> Favorite Drivers (<?php echo e($drivers->count()); ?>)
                    </h4>
                    <div class="row g-4">
                        <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $driver = $favorite->favoritable ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-2" style="width: 50px; height: 50px;">
                                                    <?php echo e($driver->code); ?>

                                                </div>
                                                <div>
                                                    <h6 class="card-title mb-0"><?php echo e($driver->full_name); ?></h6>
                                                    <small>#<?php echo e($driver->driver_number); ?></small>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-light remove-favorite" data-model="driver" data-id="<?php echo e($driver->id); ?>" title="Remove from favorites">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-warning"><?php echo e($driver->wins); ?></div>
                                                    <small class="text-muted">Wins</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-success"><?php echo e($driver->podiums); ?></div>
                                                    <small class="text-muted">Podiums</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <a href="<?php echo e(route('f1.driver.show', $driver)); ?>" class="btn btn-sm btn-primary w-100">
                                            <i class="bi bi-eye"></i> View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Teams -->
        <?php if($teams->count() > 0): ?>
            <div class="row mb-5">
                <div class="col-md-12">
                    <h4 class="fw-bold mb-4">
                        <i class="bi bi-building"></i> Favorite Teams (<?php echo e($teams->count()); ?>)
                    </h4>
                    <div class="row g-4">
                        <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $team = $favorite->favoritable ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-white text-primary rounded d-flex align-items-center justify-content-center fw-bold me-2" style="width: 50px; height: 50px;">
                                                    <?php echo e($team->code); ?>

                                                </div>
                                                <div>
                                                    <h6 class="card-title mb-0"><?php echo e($team->name); ?></h6>
                                                    <small><?php echo e($team->country); ?></small>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-light remove-favorite" data-model="team" data-id="<?php echo e($team->id); ?>" title="Remove from favorites">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-warning"><?php echo e($team->race_wins); ?></div>
                                                    <small class="text-muted">Wins</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-success"><?php echo e($team->world_championships); ?></div>
                                                    <small class="text-muted">Championships</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <a href="<?php echo e(route('f1.team.show', $team)); ?>" class="btn btn-sm btn-primary w-100">
                                            <i class="bi bi-eye"></i> View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Circuits -->
        <?php if($circuits->count() > 0): ?>
            <div class="row mb-5">
                <div class="col-md-12">
                    <h4 class="fw-bold mb-4">
                        <i class="bi bi-geo"></i> Favorite Circuits (<?php echo e($circuits->count()); ?>)
                    </h4>
                    <div class="row g-4">
                        <?php $__currentLoopData = $circuits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $circuit = $favorite->favoritable ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success text-white rounded d-flex align-items-center justify-content-center fw-bold me-2" style="width: 50px; height: 50px;">
                                                    <?php echo e(substr($circuit->name, 0, 3)); ?>

                                                </div>
                                                <div>
                                                    <h6 class="card-title mb-0"><?php echo e($circuit->name); ?></h6>
                                                    <small><?php echo e($circuit->city); ?>, <?php echo e($circuit->country); ?></small>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-light remove-favorite" data-model="circuit" data-id="<?php echo e($circuit->id); ?>" title="Remove from favorites">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-info"><?php echo e($circuit->length_km); ?></div>
                                                    <small class="text-muted">km</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-danger"><?php echo e($circuit->corners); ?></div>
                                                    <small class="text-muted">Corners</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <a href="<?php echo e(route('f1.circuit.show', $circuit)); ?>" class="btn btn-sm btn-primary w-100">
                                            <i class="bi bi-eye"></i> View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Seasons -->
        <?php if($seasons->count() > 0): ?>
            <div class="row mb-5">
                <div class="col-md-12">
                    <h4 class="fw-bold mb-4">
                        <i class="bi bi-calendar"></i> Favorite Seasons (<?php echo e($seasons->count()); ?>)
                    </h4>
                    <div class="row g-4">
                        <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $season = $favorite->favoritable ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-dark text-white rounded d-flex align-items-center justify-content-center fw-bold me-2" style="width: 50px; height: 50px;">
                                                    <?php echo e($season->year); ?>

                                                </div>
                                                <div>
                                                    <h6 class="card-title mb-0"><?php echo e($season->year); ?> Season</h6>
                                                    <small>
                                                        <?php if($season->is_active): ?>
                                                            <span class="badge bg-success">Active</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-secondary">Completed</span>
                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-dark remove-favorite" data-model="season" data-id="<?php echo e($season->id); ?>" title="Remove from favorites">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-primary"><?php echo e($season->total_races); ?></div>
                                                    <small class="text-muted">Total Races</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-success"><?php echo e($season->completed_races); ?></div>
                                                    <small class="text-muted">Completed</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <a href="<?php echo e(route('f1.season.show', $season)); ?>" class="btn btn-sm btn-primary w-100">
                                            <i class="bi bi-eye"></i> View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Races -->
        <?php if($races->count() > 0): ?>
            <div class="row mb-5">
                <div class="col-md-12">
                    <h4 class="fw-bold mb-4">
                        <i class="bi bi-flag"></i> Favorite Races (<?php echo e($races->count()); ?>)
                    </h4>
                    <div class="row g-4">
                        <?php $__currentLoopData = $races; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $race = $favorite->favoritable ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-white rounded d-flex align-items-center justify-content-center fw-bold me-2" style="width: 50px; height: 50px;">
                                                    R<?php echo e($race->round_number); ?>

                                                </div>
                                                <div>
                                                    <h6 class="card-title mb-0"><?php echo e($race->name); ?></h6>
                                                    <small><?php echo e(optional($race->circuit)->name ?? 'Unknown'); ?></small>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-light remove-favorite" data-model="race" data-id="<?php echo e($race->id); ?>" title="Remove from favorites">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-primary"><?php echo e($race->race_date ? $race->race_date->format('M d') : 'TBD'); ?></div>
                                                    <small class="text-muted">Date</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <div class="fw-bold text-info"><?php echo e($race->season ? $race->season->year : 'Unknown'); ?></div>
                                                    <small class="text-muted">Season</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <a href="<?php echo e(route('f1.race.show', $race)); ?>" class="btn btn-sm btn-primary w-100">
                                            <i class="bi bi-eye"></i> View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Back to Dashboard -->
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <a href="<?php echo e(route('f1.dashboard')); ?>" class="btn btn-secondary">
                <i class="bi bi-house"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.remove-favorite').forEach(button => {
        button.addEventListener('click', function() {
            const model = this.dataset.model;
            const id = this.dataset.id;

            if (confirm('Are you sure you want to remove this from favorites?')) {
                toggleFavorite(model, id);
            }
        });
    });

    function toggleFavorite(model, id) {
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
                location.reload();
            } else {
                alert('Error: ' + (data.message || 'Failed to update favorite'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update favorite. Please try again.');
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/leo/Code/Server Side/CA2_F1_Project/resources/views/profile.blade.php ENDPATH**/ ?>