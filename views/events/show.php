<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container event-detail-container">
    <div class="row mb-3">
        <div class="col-md-8">
            <a href="<?php echo URLROOT; ?>/events" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Events</a>
        </div>
        <?php if(isLoggedIn() && (isAdmin() || (isOrganization() && $data['event']->user_id == $_SESSION['user_id']))) : ?>
            <div class="col-md-4 text-right">
                <a href="<?php echo URLROOT; ?>/events/edit/<?php echo $data['event']->id; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                <form class="d-inline" action="<?php echo URLROOT; ?>/events/delete/<?php echo $data['event']->id; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="event-detail-card">
                <h1 class="event-title"><?php echo $data['event']->title; ?></h1>
                <div class="event-meta">
                    <p><i class="fas fa-calendar-alt"></i> <?php echo date('F j, Y, g:i a', strtotime($data['event']->event_date)); ?></p>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $data['event']->location; ?></p>
                    <p><i class="fas fa-user"></i> Organized by: <?php echo $data['event']->organizer_name; ?></p>
                </div>
                <div class="event-image-container mb-4">
                    <?php if(!empty($data['event']->image)) : ?>
                        <img src="<?php echo URLROOT; ?>/public/img/events/<?php echo $data['event']->image; ?>" alt="<?php echo $data['event']->title; ?>" class="img-fluid event-detail-image">
                    <?php else : ?>
                        <img src="<?php echo URLROOT; ?>/public/img/no-event-image.jpg" alt="Default Event Image" class="img-fluid event-detail-image">
                    <?php endif; ?>
                </div>
                <div class="event-description">
                    <h4>Description</h4>
                    <p><?php echo nl2br($data['event']->description); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="event-sidebar">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Event Details</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Status:</strong> 
                            <?php if($data['event']->status == 'upcoming') : ?>
                                <span class="badge badge-primary">Upcoming</span>
                            <?php elseif($data['event']->status == 'ongoing') : ?>
                                <span class="badge badge-warning">Ongoing</span>
                            <?php else : ?>
                                <span class="badge badge-secondary">Completed</span>
                            <?php endif; ?>
                        </p>
                        <p><strong>Capacity:</strong> <?php echo $data['event']->capacity; ?> volunteers</p>
                        <p><strong>Registered:</strong> <?php echo $data['registered_count']; ?> volunteers</p>
                        <p><strong>Available Spots:</strong> <?php echo max(0, $data['event']->capacity - $data['registered_count']); ?></p>
                        
                        <?php if(isLoggedIn() && isVolunteer() && isHired()) : ?>
                            <?php if(!$data['is_registered'] && $data['event']->status == 'upcoming' && $data['registered_count'] < $data['event']->capacity) : ?>
                                <a href="<?php echo URLROOT; ?>/events/register/<?php echo $data['event']->id; ?>" class="btn btn-success btn-block">Register for Event</a>
                            <?php elseif($data['is_registered']) : ?>
                                <div class="alert alert-success">You are registered for this event!</div>
                                <form action="<?php echo URLROOT; ?>/events/unregister/<?php echo $data['event']->id; ?>" method="post">
                                    <button type="submit" class="btn btn-warning btn-block">Cancel Registration</button>
                                </form>
                            <?php elseif($data['registered_count'] >= $data['event']->capacity) : ?>
                                <div class="alert alert-warning">This event is at full capacity.</div>
                            <?php elseif($data['event']->status != 'upcoming') : ?>
                                <div class="alert alert-info">Registration is closed for this event.</div>
                            <?php endif; ?>
                        <?php elseif(!isLoggedIn()) : ?>
                            <div class="alert alert-info">Please <a href="<?php echo URLROOT; ?>/login">login</a> to register for this event.</div>
                        <?php elseif(isLoggedIn() && isVolunteer() && !isHired()) : ?>
                            <div class="alert alert-warning">Your volunteer account is not yet approved. Please contact the administrator.</div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if(isLoggedIn() && (isAdmin() || (isOrganization() && $data['event']->user_id == $_SESSION['user_id']))) : ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Registered Volunteers</h4>
                        </div>
                        <div class="card-body">
                            <?php if(empty($data['registered_volunteers'])) : ?>
                                <p>No volunteers registered yet.</p>
                            <?php else : ?>
                                <ul class="list-group">
                                    <?php foreach($data['registered_volunteers'] as $volunteer) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <?php echo $volunteer->name; ?>
                                                <small class="d-block text-muted"><?php echo $volunteer->email; ?></small>
                                            </div>
                                            <a href="<?php echo URLROOT; ?>/volunteers/profile/<?php echo $volunteer->user_id; ?>" class="btn btn-sm btn-info">View</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>