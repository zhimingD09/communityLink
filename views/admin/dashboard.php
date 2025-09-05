<?php require APPROOT . '/views/inc/header.php'; ?>

<h1 class="mb-4">Admin Dashboard</h1>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="dashboard-card">
            <h3>Volunteers</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['volunteers'])) : ?>
                            <tr>
                                <td colspan="4" class="text-center">No volunteers found</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach($data['volunteers'] as $volunteer) : ?>
                                <tr>
                                    <td><?php echo $volunteer->name; ?></td>
                                    <td><?php echo $volunteer->email; ?></td>
                                    <td>
                                        <?php if($volunteer->status == 'hired') : ?>
                                            <span class="badge badge-success">Hired</span>
                                        <?php else : ?>
                                            <span class="badge badge-secondary">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo URLROOT; ?>/admin/viewVolunteer/<?php echo $volunteer->id; ?>" class="btn btn-sm btn-info">View</a>
                                        
                                        <?php if($volunteer->status == 'inactive') : ?>
                                            <form class="d-inline" action="<?php echo URLROOT; ?>/admin/updateVolunteerStatus" method="post">
                                                <input type="hidden" name="id" value="<?php echo $volunteer->id; ?>">
                                                <input type="hidden" name="status" value="hired">
                                                <button type="submit" class="btn btn-sm btn-success">Hire</button>
                                            </form>
                                        <?php else : ?>
                                            <form class="d-inline" action="<?php echo URLROOT; ?>/admin/updateVolunteerStatus" method="post">
                                                <input type="hidden" name="id" value="<?php echo $volunteer->id; ?>">
                                                <input type="hidden" name="status" value="inactive">
                                                <button type="submit" class="btn btn-sm btn-warning">Set Inactive</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="dashboard-card">
            <h3>Organizations</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['organizations'])) : ?>
                            <tr>
                                <td colspan="4" class="text-center">No organizations found</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach($data['organizations'] as $organization) : ?>
                                <tr>
                                    <td><?php echo $organization->name; ?></td>
                                    <td><?php echo $organization->email; ?></td>
                                    <td>
                                        <span class="badge badge-success">Active</span>
                                    </td>
                                    <td>
                                        <a href="<?php echo URLROOT; ?>/admin/viewOrganization/<?php echo $organization->id; ?>" class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="dashboard-card">
            <h3>Events</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($data['events'])) : ?>
                            <tr>
                                <td colspan="6" class="text-center">No events found</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach($data['events'] as $event) : ?>
                                <tr>
                                    <td><?php echo $event->title; ?></td>
                                    <td><?php echo date('M j, Y, g:i a', strtotime($event->event_date)); ?></td>
                                    <td><?php echo $event->location; ?></td>
                                    <td>
                                        <?php if($event->status == 'upcoming') : ?>
                                            <span class="badge badge-primary">Upcoming</span>
                                        <?php elseif($event->status == 'ongoing') : ?>
                                            <span class="badge badge-warning">Ongoing</span>
                                        <?php else : ?>
                                            <span class="badge badge-secondary">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $event->organizer_name; ?></td>
                                    <td>
                                        <a href="<?php echo URLROOT; ?>/admin/viewEvent/<?php echo $event->id; ?>" class="btn btn-sm btn-info">View</a>
                                        <a href="<?php echo URLROOT; ?>/admin/deleteEvent/<?php echo $event->id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>