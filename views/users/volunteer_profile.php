<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container profile-container">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-sidebar">
                <div class="profile-image mb-3">
                    <?php if(!empty($data['volunteer']->profile_image)) : ?>
                        <img src="<?php echo URLROOT; ?>/public/img/volunteers/<?php echo $data['volunteer']->profile_image; ?>" alt="Profile Image" class="img-fluid rounded-circle">
                    <?php else : ?>
                        <img src="<?php echo URLROOT; ?>/public/img/no-profile.jpg" alt="Default Profile" class="img-fluid rounded-circle">
                    <?php endif; ?>
                </div>
                <h3 class="profile-name"><?php echo $data['volunteer']->name; ?></h3>
                <p class="profile-email"><?php echo $data['volunteer']->email; ?></p>
                <div class="profile-status mb-3">
                    <?php if($data['volunteer']->status == 'hired') : ?>
                        <span class="badge badge-success">Hired</span>
                    <?php else : ?>
                        <span class="badge badge-secondary">Inactive</span>
                    <?php endif; ?>
                </div>
                <?php if(isLoggedIn() && $_SESSION['user_id'] == $data['volunteer']->user_id) : ?>
                    <a href="<?php echo URLROOT; ?>/volunteers/edit" class="btn btn-primary btn-block">Edit Profile</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="profile-content">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Personal Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Phone:</strong> <?php echo !empty($data['volunteer']->phone) ? $data['volunteer']->phone : 'Not provided'; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Skills:</strong> <?php echo !empty($data['volunteer']->skills) ? $data['volunteer']->skills : 'Not provided'; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Bio:</strong></p>
                                <p><?php echo !empty($data['volunteer']->bio) ? $data['volunteer']->bio : 'No bio provided.'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h4>Registered Events</h4>
                    </div>
                    <div class="card-body">
                        <?php if(empty($data['events'])) : ?>
                            <p>No events registered yet.</p>
                        <?php else : ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data['events'] as $event) : ?>
                                            <tr>
                                                <td><?php echo $event->title; ?></td>
                                                <td><?php echo date('M j, Y, g:i a', strtotime($event->event_date)); ?></td>
                                                <td>
                                                    <?php if($event->status == 'upcoming') : ?>
                                                        <span class="badge badge-primary">Upcoming</span>
                                                    <?php elseif($event->status == 'ongoing') : ?>
                                                        <span class="badge badge-warning">Ongoing</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-secondary">Completed</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo URLROOT; ?>/events/show/<?php echo $event->id; ?>" class="btn btn-sm btn-info">View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>