<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="form-container">
                <h2>Create New Event</h2>
                <p>Fill out the form below to create a new event</p>
                <form action="<?php echo URLROOT; ?>/events/add" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Event Title</label>
                        <input type="text" name="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" rows="5"><?php echo $data['description']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control <?php echo (!empty($data['location_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['location']; ?>">
                        <span class="invalid-feedback"><?php echo $data['location_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="event_date">Event Date & Time</label>
                        <input type="datetime-local" name="event_date" class="form-control <?php echo (!empty($data['event_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['event_date']; ?>">
                        <span class="invalid-feedback"><?php echo $data['event_date_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacity (Number of Volunteers Needed)</label>
                        <input type="number" name="capacity" class="form-control <?php echo (!empty($data['capacity_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['capacity']; ?>" min="1">
                        <span class="invalid-feedback"><?php echo $data['capacity_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control <?php echo (!empty($data['status_err'])) ? 'is-invalid' : ''; ?>">
                            <option value="upcoming" <?php echo ($data['status'] == 'upcoming') ? 'selected' : ''; ?>>Upcoming</option>
                            <option value="ongoing" <?php echo ($data['status'] == 'ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                            <option value="completed" <?php echo ($data['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['status_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="image">Event Image</label>
                        <input type="file" name="image" class="form-control-file <?php echo (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $data['image_err']; ?></span>
                        <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, gif (Max size: 2MB)</small>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Create Event" class="btn btn-success">
                        <a href="<?php echo URLROOT; ?>/events" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>