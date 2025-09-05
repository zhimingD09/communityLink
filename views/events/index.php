<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container events-container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Events</h1>
        </div>
        <?php if(isLoggedIn() && (isAdmin() || isOrganization())) : ?>
            <div class="col-md-4 text-right">
                <a href="<?php echo URLROOT; ?>/events/add" class="btn btn-primary"><i class="fas fa-plus"></i> Create Event</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="eventTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="past-tab" data-toggle="tab" href="#past" role="tab" aria-controls="past" aria-selected="false">Past Events</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="eventTabsContent">
        <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
            <?php if(empty($data['upcoming_events'])) : ?>
                <div class="alert alert-info">No upcoming events found.</div>
            <?php else : ?>
                <div class="row">
                    <?php foreach($data['upcoming_events'] as $event) : ?>
                        <div class="col-md-4 mb-4">
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
                                    <p class="card-text">
                                        <?php echo substr($event->description, 0, 100); ?>...
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a href="<?php echo URLROOT; ?>/events/show/<?php echo $event->id; ?>" class="btn btn-info btn-sm">View Details</a>
                                    <?php if(isLoggedIn() && isVolunteer() && isHired()) : ?>
                                        <?php if(!$event->is_registered) : ?>
                                            <a href="<?php echo URLROOT; ?>/events/register/<?php echo $event->id; ?>" class="btn btn-success btn-sm">Register</a>
                                        <?php else : ?>
                                            <button class="btn btn-secondary btn-sm" disabled>Registered</button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
            <?php if(empty($data['past_events'])) : ?>
                <div class="alert alert-info">No past events found.</div>
            <?php else : ?>
                <div class="row">
                    <?php foreach($data['past_events'] as $event) : ?>
                        <div class="col-md-4 mb-4">
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
                                    <p class="card-text">
                                        <?php echo substr($event->description, 0, 100); ?>...
                                    </p>
                                </div>
                                <div class="card-footer">
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

<?php require APPROOT . '/views/inc/footer.php'; ?>