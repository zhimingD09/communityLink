<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container profile-container">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-sidebar">
                <div class="profile-image mb-3">
                    <?php if(!empty($data['organization']->logo)) : ?>
                        <img src="<?php echo URLROOT; ?>/public/img/organizations/<?php echo $data['organization']->logo; ?>" alt="Organization Logo" class="img-fluid">
                    <?php else : ?>
                        <img src="<?php echo URLROOT; ?>/public/img/no-logo.jpg" alt="Default Logo" class="img-fluid">
                    <?php endif; ?>
                </div>
                <h3 class="profile-name"><?php echo $data['organization']->name; ?></h3>
                <p class="profile-email"><?php echo $data['organization']->email; ?></p>
                <?php if(isLoggedIn() && $_SESSION['user_id'] == $data['organization']->user_id) : ?>
                    <a href="<?php echo URLROOT; ?>/organizations/edit" class="btn btn-primary btn-block">Edit Profile</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="profile-content">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Organization Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Phone:</strong> <?php echo !empty($data['organization']->phone) ? $data['organization']->phone : 'Not provided'; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Website:</strong> 
                                    <?php if(!empty($data['organization']->website)) : ?>
                                        <a href="<?php echo $data['organization']->website; ?>" target="_blank"><?php echo $data['organization']->website; ?></a>
                                    <?php else : ?>
                                        Not provided
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Address:</strong> <?php echo !empty($data['organization']->address) ? $data['organization']->address : 'Not provided'; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Description:</strong></p>
                                <p><?php echo !empty($data['organization']->description) ? $data['organization']->description : 'No description provided.'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h4>Organized Events</h4>
                    </div>
                    <div class="card-body">
                        <?php if(empty($data['events'])) : ?>
                            <p>No events organized yet.</p>
                        <?php else : ?>
                            <div class="row">
                                <?php foreach($data['events'] as $event) : ?>
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="card-img-top event-image-container">
                                                <?php if(!empty($event->image)) : ?>
                                                    <img src="<?php echo URLROOT; ?>/public/img/events/<?php echo $event->image; ?>" alt="<?php echo $event->title; ?>" class="img-fluid event-image">
                                                <?php else : ?>
                                                    <img src="<?php echo URLROOT; ?>/public/img/no-event-image.jpg" alt="Default Event Image" class="img-fluid event-image">
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $event->title; ?></h5>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar-alt"></i> <?php echo date('M j, Y, g:i a', strtotime($event->event_date)); ?>
                                                    </small>
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        <i class="fas fa-map-marker-alt"></i> <?php echo $event->location; ?>
                                                    </small>
                                                </p>
                                                <a href="<?php echo URLROOT; ?>/events/show/<?php echo $event->id; ?>" class="btn btn-info btn-sm">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>