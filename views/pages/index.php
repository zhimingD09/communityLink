<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="jumbotron text-center">
    <h1 class="display-4"><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
    <?php if(!isLoggedIn()) : ?>
        <div class="mt-4">
            <a href="<?php echo URLROOT; ?>/volunteers/register" class="btn btn-primary btn-lg mr-2">Sign Up as Volunteer</a>
            <a href="<?php echo URLROOT; ?>/organizations/register" class="btn btn-success btn-lg">Sign Up as Organization</a>
        </div>
    <?php endif; ?>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <h2 class="text-center mb-4">Upcoming Events</h2>
    </div>
    
    <?php if(empty($data['upcomingEvents'])) : ?>
        <div class="col-md-12">
            <p class="text-center">No upcoming events at the moment.</p>
        </div>
    <?php else : ?>
        <?php foreach($data['upcomingEvents'] as $event) : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if(!empty($event->image)) : ?>
                        <img src="<?php echo URLROOT . '/' . $event->image; ?>" class="card-img-top" alt="<?php echo $event->title; ?>">
                    <?php else : ?>
                        <img src="<?php echo URLROOT; ?>/img/no-image.jpg" class="card-img-top" alt="No Image Available">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $event->title; ?></h5>
                        <p class="card-text"><?php echo substr($event->description, 0, 100); ?>...</p>
                        <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt"></i> <?php echo $event->location; ?></small></p>
                        <p class="card-text"><small class="text-muted"><i class="fas fa-calendar-alt"></i> <?php echo date('F j, Y, g:i a', strtotime($event->event_date)); ?></small></p>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo URLROOT; ?>/events/show/<?php echo $event->id; ?>" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-12">
        <h2 class="text-center mb-4">Past Events</h2>
    </div>
    
    <?php if(empty($data['pastEvents'])) : ?>
        <div class="col-md-12">
            <p class="text-center">No past events to display.</p>
        </div>
    <?php else : ?>
        <?php foreach($data['pastEvents'] as $event) : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if(!empty($event->image)) : ?>
                        <img src="<?php echo URLROOT . '/' . $event->image; ?>" class="card-img-top" alt="<?php echo $event->title; ?>">
                    <?php else : ?>
                        <img src="<?php echo URLROOT; ?>/img/no-image.jpg" class="card-img-top" alt="No Image Available">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $event->title; ?></h5>
                        <p class="card-text"><?php echo substr($event->description, 0, 100); ?>...</p>
                        <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt"></i> <?php echo $event->location; ?></small></p>
                        <p class="card-text"><small class="text-muted"><i class="fas fa-calendar-alt"></i> <?php echo date('F j, Y, g:i a', strtotime($event->event_date)); ?></small></p>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo URLROOT; ?>/events/show/<?php echo $event->id; ?>" class="btn btn-secondary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>