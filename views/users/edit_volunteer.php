<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="form-container">
                <h2>Edit Volunteer Profile</h2>
                <form action="<?php echo URLROOT; ?>/volunteers/edit" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" readonly>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        <small class="form-text text-muted">Email cannot be changed</small>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
                        <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="skills">Skills</label>
                        <input type="text" name="skills" class="form-control <?php echo (!empty($data['skills_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['skills']; ?>">
                        <span class="invalid-feedback"><?php echo $data['skills_err']; ?></span>
                        <small class="form-text text-muted">Separate skills with commas</small>
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea name="bio" class="form-control <?php echo (!empty($data['bio_err'])) ? 'is-invalid' : ''; ?>" rows="5"><?php echo $data['bio']; ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['bio_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <?php if(!empty($data['profile_image'])) : ?>
                            <div class="mb-2">
                                <img src="<?php echo URLROOT; ?>/public/img/volunteers/<?php echo $data['profile_image']; ?>" alt="Current Profile Image" class="img-thumbnail" style="max-width: 200px;">
                                <p>Current profile image</p>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="profile_image" class="form-control-file <?php echo (!empty($data['profile_image_err'])) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $data['profile_image_err']; ?></span>
                        <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, gif (Max size: 2MB)</small>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update Profile" class="btn btn-success">
                        <a href="<?php echo URLROOT; ?>/volunteers/profile/<?php echo $_SESSION['user_id']; ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>